<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

    /**
     * Registers a Backend Module
     */
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Abra.' . $_EXTKEY,
        'web',     // Make module a submodule of 'web'
        'productadministration',    // Submodule key
        '',                        // Position
        array(
            'Backend\Product' => 'index,listArticles,generateArticles'
        ),
        array(
            'access' => 'user,group',
            'icon' => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf',
        )
    );

}
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Abra.' . $_EXTKEY,
    'Article',
    'LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_article'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Abra.' . $_EXTKEY,
    'Product',
    'LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_product'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Abra.' . $_EXTKEY,
    'Basket',
    'LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_basket'
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Cadabra');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_product',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_product.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_product');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_article',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_article.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_article');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_articleattribute',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_articleattribute.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_articleattribute');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_attribute',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_attribute.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_attribute');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_price_influencer',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_price_influencer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_price_influencer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_attribute_value',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_attribute_value.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_attribute_value');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_information',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_information.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_information');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_information_group',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_information_group.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_information_group');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_fileinformation',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_fileinformation.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_fileinformation');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_pageinformation',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_pageinformation.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_pageinformation');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_textinformation',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_textinformation.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_textinformation');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_address',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_address');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_basket',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_basket.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_basket');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_shippinmethod',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_shippinmethod.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_shippinmethod');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_invoice',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_invoice.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_invoice');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_deliveryreciept',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_deliveryreciept.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_deliveryreciept');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_ordering',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_ordering.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_ordering');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_paymentmethod',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_paymentmethod.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_paymentmethod');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_orderablearticle',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_orderablearticle.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_orderablearticle');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_orderingposition',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_orderingposition.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_orderingposition');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_basketentry',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_basketentry.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_basketentry');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_category',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_category');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_page',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_page.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_page');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cadabra_domain_model_file',
    'EXT:cadabra/Resources/Private/Language/locallang_csh_tx_cadabra_domain_model_file.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cadabra_domain_model_file');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:cadabra/Configuration/TypoScript/PageTsConfig.ts">');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_article',
    'cadabra_article'
), 'CType', 'cadabra');

$GLOBALS['TCA']['tt_content']['types']['cadabra_article']['showitem'] =
    'CType;;cadabra_general-element-properties;1-1-1,
     --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
    --div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access,--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility; visibility,starttime, endtime';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_product',
    'cadabra_product'
), 'CType', 'cadabra');

$GLOBALS['TCA']['tt_content']['types']['cadabra_product']['showitem'] =
    'CType;;cadabra_general-element-properties;1-1-1,
     --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
    --div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access,--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility; visibility,starttime, endtime';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_basket',
    'cadabra_basket'
), 'CType', 'cadabra');

$GLOBALS['TCA']['tt_content']['types']['cadabra_basket']['showitem'] =
    'CType;;cadabra_general-element-properties;1-1-1,
     --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
    --div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access,--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility; visibility,starttime, endtime';
