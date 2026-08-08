import json
import os
import sys
import requests


def main():
    if len(sys.argv) != 2:
        raise SystemExit("Usage: publish_wordpress.py <page-json-file>")

    page_file = sys.argv[1]

    wp_url = os.environ["WP_URL"].rstrip("/")
    username = os.environ["WP_USERNAME"]
    app_password = os.environ["WP_APP_PASSWORD"]

    with open(page_file, "r", encoding="utf-8") as f:
        page = json.load(f)

    page_id = page.pop("id", None)

    if page_id:
        endpoint = f"{wp_url}/wp-json/wp/v2/pages/{page_id}"
    else:
        endpoint = f"{wp_url}/wp-json/wp/v2/pages"

    response = requests.post(
        endpoint,
        auth=(username, app_password),
        json=page,
        timeout=60,
    )

    if not response.ok:
        print(response.text)
        response.raise_for_status()

    result = response.json()

    print(f"WordPress page ID: {result['id']}")
    print(f"Status: {result['status']}")
    print(f"URL: {result.get('link', '')}")


if __name__ == "__main__":
    main()
