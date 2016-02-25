<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
/*
$contentColumns = array(

);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $contentColumns);
*/

$GLOBALS['TCA']['tt_content']['palettes']['cadabra_general-element-properties'] = array(
    'showitem' => 'sys_language_uid, l18n_parent, colPos, sectionIndex'
);



