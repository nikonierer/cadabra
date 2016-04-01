<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:tx_cadabra_domain_model_orderable_article',
        'label' => 'uid',
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
        'searchFields' => '',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('cadabra') . 'Resources/Public/Icons/tx_cadabra_domain_model_orderable_article.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
                'foreign_table' => 'tx_cadabra_domain_model_orderable_article',
                'foreign_table_where' => 'AND tx_cadabra_domain_model_orderable_article.pid=###CURRENT_PID### AND tx_cadabra_domain_model_orderable_article.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:orderable_article.record_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:orderable_article.record_type.basket_entry',
                        'Abra\\Cadabra\\Domain\\Model\\Ordering\\BasketEntry'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:orderable_article.record_type.ordering_position',
                        'Abra\\Cadabra\\Domain\\Model\\Ordering\\OrderingPosition'
                    ),
                ),
                'default' => 'Abra\\Cadabra\\Domain\\Model\\Ordering\\BasketEntry',
            ),
        ),

        'article' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:orderable_article.article',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_cadabra_domain_model_article',
                'foreign_field' => 'article',
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ),
        ),

        'basket' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:orderable_article.basket',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_cadabra_domain_model_basket',
                'foreign_field' => 'positions',
                'size' => 10,
                'autoSizeMax' => 50,
                'maxitems' => 9999,
            ),
        ),

        'amount' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:orderable_article.amount',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'integer'
            )
        ),

    ),
);