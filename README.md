# PrestaShop-Module-Image-Rollover
A PrestaShop 1.7.x Module to rollover image on hover.

## Information

Tested on 1.7.6.4 only.

_Zoom_ and _Fade_ animations updated only. Need improvements for the other animations.

## Install
Add `{hook h='productImageHover' id_product = $product.id_product}` below the first `<img>` tag in _templates/catalog/_partials/miniatures/product.tpl_ (line 35).

## Credits
Quick fixes based on <a href="http://prestashopaddon.com/download/prestashop-modules/free-product-image-rollover-module-for-prestashop/" target="_blank">PrestashopAddon.com's</a> *ybc_productimagehover*.
Thanks to them.

## Contributing
1. Fork the repo
2. Create your feature branch: `git checkout -b new-feature`
3. Commit your changes: `git commit -am 'Add new feature'`
4. Push to the branch: `git push origin new-feature`
5. Submit a pull request
