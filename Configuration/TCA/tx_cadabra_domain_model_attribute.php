<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:tx_cadabra_domain_model_attribute',
        'label' => 'name',
        'type' => 'record_type',
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
        'searchFields' => 'name',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('cadabra') . 'Resources/Public/Icons/tx_cadabra_domain_model_attribute.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, name, attribute_values, information, products, price_influencer, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
                'foreign_table' => 'tx_cadabra_domain_model_attribute',
                'foreign_table_where' => 'AND tx_cadabra_domain_model_attribute.pid=###CURRENT_PID### AND tx_cadabra_domain_model_attribute.sys_language_uid IN (-1,0)',
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
        'name' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim'
            )
        ),
        'record_type' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.record_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.record_type.checkbox',
                        'Abra\\Cadabra\\Domain\\Model\\Attribute\\CheckBoxAttribute'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.record_type.radio',
                        'Abra\\Cadabra\\Domain\\Model\\Attribute\\RadioAttribute'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.record_type.select',
                        'Abra\\Cadabra\\Domain\\Model\\Attribute\\SelectAttribute'
                    ),
                ),
                'default' => 'Abra\\Cadabra\\Domain\\Model\\Attribute\\SelectAttribute',
            ),
        ),

        'attribute_values' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.attribute_values',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_cadabra_domain_model_attribute_value',
                'foreign_field' => 'attribute',
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ),
        ),
        'information' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.information',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_cadabra_domain_model_information',
                'MM' => 'tx_cadabra_information_record_mm',
                'MM_opposite_field' => 'records',
                'MM_match_fields' => array(
                    'tablenames' => 'tx_cadabra_domain_model_attribute',
                    'fieldname' => 'information',
                ),
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
                'wizards' => array(
                    '_VERTICAL' => 0,
                    'suggest' => array(
                        'type' => 'suggest',
                    ),
                    'edit' => array(
                       'type' => 'popup',
                        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.information.basedOn_edit',
                        'module' => array(
                            'name' => 'wizard_edit',
                        ),
                        'popup_onlyOpenIfSelected' => 1,
                        'icon' => 'edit2.gif',
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1'
                    ),
                    'add' => array(
                         'type' => 'script',
                        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.information.basedOn_add',
                        'icon' => 'add.gif',
                        'params' => array(
                            'table' => 'tx_cadabra_domain_model_information',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ),
                        'module' => array(
                            'name' => 'wizard_add'
                        )
                    ),
                )
            ),
        ),
        'products' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.products',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_cadabra_domain_model_product',
                'MM' => 'tx_cadabra_product_attribute_mm',
                'MM_opposite_field' => 'attributes',
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
                'wizards' => array(
                    '_VERTICAL' => 0,
                    'suggest' => array(
                        'type' => 'suggest'
                    ),
                    'edit' => array(
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.products.basedOn_edit',
                        'module' => array(
                            'name' => 'wizard_edit',
                        ),
                        'popup_onlyOpenIfSelected' => 1,
                        'icon' => 'edit2.gif',
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1'
                    ),
                    'add' => array(
                        'type' => 'script',
                        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.products.basedOn_add',
                        'icon' => 'add.gif',
                        'params' => array(
                            'table' => 'tx_cadabra_domain_model_product',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ),
                        'module' => array(
                            'name' => 'wizard_add'
                        )
                    )
                )
            ),
        ),
        'price_influencer' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:attribute.price_influencer',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_cadabra_domain_model_price_influencer',
                'MM' => 'tx_cadabra_price_influencer_record_mm',
                'MM_opposite_field' => 'records',
                'MM_match_fields' => array(
                    'tablenames' => 'tx_cadabra_domain_model_attribute',
                    'fieldname' => 'price_influencer',
                ),
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ),
        ),
    ),
);
