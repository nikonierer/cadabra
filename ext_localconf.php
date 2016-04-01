<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Abra.' . $_EXTKEY,
    'Product',
    array(
        'Product' => 'list, show',
    ),
    // non-cacheable actions
    array(
        'Product' => '',
    ),
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Abra.' . $_EXTKEY,
    'Article',
    array(
        'Article' => 'list, show',
    ),
    // non-cacheable actions
    array(
        'Article' => '',
    ),
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Abra.' . $_EXTKEY,
    'Basket',
    array(
        'Basket' => 'show, addArticle',
    ),
    // non-cacheable actions
    array(
        'Basket' => 'show, addArticle',
    ),
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
