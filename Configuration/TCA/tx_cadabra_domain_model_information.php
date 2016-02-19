<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:tx_cadabra_domain_model_information',
        'label' => 'uid',
        'type'  => 'record_type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => '',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('cadabra') . 'Resources/Public/Icons/tx_cadabra_domain_model_information.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\Information\\FileInformation' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, items, hidden;;1, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\Information\\PageInformation' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, items, hidden;;1, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\Information\\TtContentInformation' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, items, hidden;;1, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\Information\\TextInformation' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, content, hidden;;1, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(

        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_cadabra_domain_model_information',
                'foreign_table_where' => 'AND tx_cadabra_domain_model_information.pid=###CURRENT_PID### AND tx_cadabra_domain_model_information.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'record_type' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.record_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.record_type.file',
                        'Abra\\Cadabra\\Domain\\Model\\Information\\FileInformation'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.record_type.page',
                        'Abra\\Cadabra\\Domain\\Model\\Information\\PageInformation'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.record_type.tt_content',
                        'Abra\\Cadabra\\Domain\\Model\\Information\\TtContentInformation'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.record_type.text',
                        'Abra\\Cadabra\\Domain\\Model\\Information\\TextInformation'
                    ),
                ),
                'default' => 'Abra\\Cadabra\\Domain\\Model\\Information\\TextInformation',
            ),
        ),
        'content' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.content',
            'config' => array(
                'type' => 'text',
                'cols' => '40',
                'rows' => '15'
            )
        ),
        'items' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.items',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'sys_file,pages,tt_content',
                'MM' => 'tx_cadabra_information_record_mm',
                'MM_opposite_field' => 'records',
                'MM_oppositeUsage' => array(
                    'sys_file' => array('tx_cadabra_information'),
                    'pages' => array('tx_cadabra_information'),
                    'tt_content' => array('tx_cadabra_information'),
                ),
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ),
        ),
        'products' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:information.products',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_cadabra_domain_model_product',
                'MM' => 'tx_cadabra_product_information_mm',
                'MM_opposite_field' => 'information',
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ),
        )
    ),
);