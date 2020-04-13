{if isset($product_name) && isset($img_url)}
    <img class="{if $YBC_PI_TRANSITION_EFFECT}{$YBC_PI_TRANSITION_EFFECT}{else}faded{/if} replace-2x img-responsive ybc_img_hover" src="{$img_url|replace:'home_default':'home_default2x'}" alt="{$product_name}" itemprop="image" title="{$product_name}" />
{/if}