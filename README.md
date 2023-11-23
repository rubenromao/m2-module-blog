# Rubenromao_BlogPosts module

Custom Magento v2.4.6-p3 Blog module to cover Magento 2 concepts and design patterns.

It covers the app structure, how routing & controllers work, how to extend core code,
dependency injection & interfaces, different design patterns and usages, ways to modify the page layout, and understand data management.

The module is not intended to be used in production.
It is a sample module to be used as a reference for Magento 2 development.

The module is based on the [Magento 2.4.6-p3](https://devdocs.magento.com/guides/v2.4/release-notes/bk-release-notes.html) version.

It provides the following functionality:
Custom database table to store blog posts.
Custom model to manage blog posts.
Custom Web API endpoints to create, update, delete, and get blog posts.
Custom admin grid to manage blog posts.
Custom admin form to create and edit blog posts.
Custom frontend page to create a blog post.
Custom frontend page to edit a blog post.
Custom frontend page to delete a blog post.
Custom frontend page to display blog posts.

## Installation details

To install use composer or copy files manually.
It is recommended to install the module in a development environment first.
The

### Install using composer

``` 
composer require rubenromao/blog
```

Run the following command to enable the module:

```
bin/magento module:enable Rubenromao_BlogPosts
```

You must run the following commands after the module installation using magento-cli
    
    ```
    bin/magento setup:upgrade
    bin/magento setup:di:compile
    bin/magento setup:static-content:deploy -f (optional if you are in developer mode)
    bin/magento cache:flush
    ```

For information about a module installation in Magento 2, see [Enable or disable modules](https://devdocs.magento.com/guides/v2.4/install-gde/install/cli/install-cli-subcommands-enable.html).

## Extensibility

The Rubenromao_BlogPosts module contains extensibility points that you can interact with.
Web API, Service contracts, plugins, events, and observers enable you to extend and customize the Magento application.
You can interact with the following extension points:

Extension developers can interact with the Rubenromao_BlogPosts module. For more information about the Magento extension mechanism, see [Magento plug-ins](https://devdocs.magento.com/guides/v2.4/extension-dev-guide/plugins.html).

[The Magento dependency injection mechanism](https://devdocs.magento.com/guides/v2.4/extension-dev-guide/depend-inj.html) enables you to override the functionality of the Rubenromao_BlogPosts module.

### Layouts

The module introduces layout handles in the `view/frontend/layout` directory.
You can extend these layouts in your custom modules and themes.

For more information about a layout in Magento 2, see the [Layout documentation](https://devdocs.magento.com/guides/v2.4/frontend-dev-guide/layouts/layout-overview.html).

### UI components

You can extend product and category updates using the UI components located in the `view/adminhtml/ui_component` directory.
Or you can extend the UI components located in the `view/base/ui_component` directory.

For information about a UI component in Magento 2, see [Overview of UI components](https://devdocs.magento.com/guides/v2.4/ui_comp_guide/bk-ui_comps.html).

## Additional information

The Rubenromao_BlogPosts module creates a new database table `rubenromao_blog_post` during the installation process.
This table stores blog posts.

For information about significant changes in patch releases, see [Release information](https://devdocs.magento.com/guides/v2.4/release-notes/bk-release-notes.html).
