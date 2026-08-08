# PlayTVX Standalone Theme

## Local installation target

Deploy this directory as `wp-content/themes/playtvx-theme/`. It is a standalone classic WordPress theme used by both the English and French PlayTVX sites and requires ACF Pro for Flexible Content and Options.

## Required plugin

ACF Pro must remain active. If ACF is unavailable, WordPress can still load the theme but Flexible Content and global option fields are not rendered.

## Theme-owned configuration

- `inc/acf-fields.php`: versioned field definitions and Options page.
- `acf-json/`: future ACF UI exports.
- `template-parts/flexible/`: renderer for each allowed page section.
- `src/tailwind.css`: Tailwind source, brand tokens and the small set of component rules that require pseudo-elements.
- `assets/css/playtvx.css`: generated, minified production stylesheet.
