# Prestashop-Module-Image-Rollover
A Prestashop 1.7.x Module to rollover image on hover.

Tested on 1.7.6.4 only.

Add `{hook h='productImageHover' id_product = $product.id_product}` below the first `<img>` tag in _templates/catalog/_partials/miniatures/product.tpl_ (line 35).

Quick fixes based on [PrestashopAddon.com's](http://prestashopaddon.com/download/prestashop-modules/free-product-image-rollover-module-for-prestashop/) ybc_productimagehover.
Thanks to them.