import json
import os
import sys

import requests


def add_meta_value(form_data, key, value):
    """Convert SEO values into Rank Math's expected form fields."""
    field = f"meta[{key}]"

    if isinstance(value, list):
        for item in value:
            form_data.append((f"{field}[]", str(item)))
    elif isinstance(value, bool):
        form_data.append((field, "1" if value else "0"))
    elif value is not None:
        form_data.append((field, str(value)))


def main():
    if len(sys.argv) != 2:
        raise SystemExit("Usage: publish_wordpress.py <page-json-file>")

    page_file = sys.argv[1]

    wp_url = os.environ["WP_URL"].rstrip("/")
    username = os.environ["WP_USERNAME"]
    app_password = os.environ["WP_APP_PASSWORD"]

    with open(page_file, "r", encoding="utf-8") as f:
        config = json.load(f)

    # SEO is handled separately through Rank Math.
    seo = config.pop("seo", None)

    # If an ID exists, update that page. Otherwise create a new page.
    page_id = config.pop("id", None)

    if page_id:
        endpoint = f"{wp_url}/wp-json/wp/v2/pages/{page_id}"
    else:
        endpoint = f"{wp_url}/wp-json/wp/v2/pages"

    # Create/update WordPress page + ACF.
    response = requests.post(
        endpoint,
        auth=(username, app_password),
        json=config,
        timeout=60,
    )

    if not response.ok:
        print("WordPress page request failed:")
        print(response.text)
        response.raise_for_status()

    result = response.json()
    page_id = result["id"]

    print(f"WordPress page ID: {page_id}")
    print(f"Status: {result['status']}")
    print(f"URL: {result.get('link', '')}")

    # Update Rank Math SEO if an SEO section exists.
    if seo:
        seo_key_map = {
            "title": "rank_math_title",
            "description": "rank_math_description",
            "focus_keyword": "rank_math_focus_keyword",
            "robots": "rank_math_robots",
            "canonical_url": "rank_math_canonical_url",
        }

        form_data = [
            ("objectType", "post"),
            ("objectID", str(page_id)),
        ]

        for friendly_key, value in seo.items():
            rank_math_key = seo_key_map.get(friendly_key, friendly_key)
            add_meta_value(form_data, rank_math_key, value)

        seo_response = requests.post(
            f"{wp_url}/wp-json/rankmath/v1/updateMeta",
            auth=(username, app_password),
            data=form_data,
            timeout=60,
        )

        if not seo_response.ok:
            print("Rank Math SEO request failed:")
            print(seo_response.text)
            seo_response.raise_for_status()

        print("Rank Math SEO updated successfully.")


if __name__ == "__main__":
    main()
