# Unwrap Images Grav Plugin

The **unwrap-images plugin** for [Grav](http://github.com/getgrav/grav) allows for removing the `<p>` ... `</p>` that markdown generates to surround `<img>` tags.

The plugin is draws on (and corrects) information I found posted [here](https://discourse.getgrav.org/t/page-specific-plugin-configuration/198).

# Installation

Download the `unwrap-images` folder and move/copy it to your `user/plugins` folder.

# Configuration

Copy the `user/plugins/unwrap-images/unwrap-images.yaml` into `user/config/plugins/unwrap-images.yaml` and make your modifications.

## Enabling/disabling globally or per-page

Default setting is:

```
enabled: true
process_content: false
```

thus disabling the plugin except in pages with frontmatter explicitly enabling it, like so:

```
unwrap_images:
    process_content: true
```

## Images wrapped in `<a>` tags

Images whose direct parents are `<a>` ... `</a>` will also be processed, if elligible (e.g., the `<a>` tags are themselves wrapped in `<p>` tags).

## Option to process only images with class

In `user/config/plugins/unwrap-images.yaml` (or in the plugin settings in Admin), there is the option to specify a (single) class.

If a class is specified, only `<img>` elements with that class will be processed.

If no class is specified, all `<img>` elements will be processed.