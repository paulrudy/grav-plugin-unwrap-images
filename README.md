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