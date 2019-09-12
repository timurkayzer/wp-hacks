<?php
/**
 * Change currency symbol in Woocommerce
 */

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 100);

function change_existing_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'AED':
            $currency_symbol = ' AED';
            break;
    }
    return $currency_symbol;
}