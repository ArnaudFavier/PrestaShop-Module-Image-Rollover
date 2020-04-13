# PrestaShop-Module-Image-Rollover
A PrestaShop 1.7.x Module to rollover image on hover.

## Information

Tested on 1.7.6.4 only.

_Zoom_ and _Fade_ animations updated only. Need improvements for the other animations.

## Install
Add `{hook h='productImageHover' id_product = $product.id_product}` below the first `<img>` tag in _templates/catalog/_partials/miniatures/product.tpl_ (line 35):

```php
<article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
    <div class="thumbnail-container">
      {block name='product_thumbnail'}
        {if $product.cover}
          <a href="{$product.url}" class="thumbnail product-thumbnail">
            <img
              src="{$product.cover.bySize.home_default.url|replace:'home_default':'home_default2x'}"
              alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
              data-full-size-image-url="{$product.cover.large.url}"
            />
            {hook h='productImageHover' id_product = $product.id_product}
          </a>
```

Then *Clear cache* in _Advanced Parameters_ > _Performances_.

## Credits
Quick fixes based on <a href="http://prestashopaddon.com/download/prestashop-modules/free-product-image-rollover-module-for-prestashop/" target="_blank">PrestashopAddon.com's</a> **ybc_productimagehover**.
Thanks to them.

## Contributing
1. Fork the repo
2. Create your feature branch: `git checkout -b new-feature`
3. Commit your changes: `git commit -am 'Add new feature'`
4. Push to the branch: `git push origin new-feature`
5. Submit a pull request
