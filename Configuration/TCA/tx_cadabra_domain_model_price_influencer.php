<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:tx_cadabra_domain_model_price_influencer',
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
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('cadabra') . 'Resources/Public/Icons/tx_cadabra_domain_model_price_influencer.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\AbsolutePriceInfluencer' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, absolute_amount, discount, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\RelativePriceInfluencer' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, relative_amount, discount, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\OverwritePriceInfluencer' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, overwrite_price, discount, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\AbsoluteScaledPriceInfluencer' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, absolute_amount, discount, minimum_quantity, single_article_price_influence, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\RelativeScaledPriceInfluencer' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, relative_amount, discount, minimum_quantity, single_article_price_influence, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\OverwriteScaledPriceInfluencer' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, record_type, overwrite_amount, discount, minimum_quantity, single_article_price_influence, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
                'foreign_table' => 'tx_cadabra_domain_model_price_influencer',
                'foreign_table_where' => 'AND tx_cadabra_domain_model_price_influencer.pid=###CURRENT_PID### AND tx_cadabra_domain_model_price_influencer.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.record_type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.record_type.absolute',
                        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\AbsolutePriceInfluencer'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.record_type.relative',
                        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\RelativePriceInfluencer'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.record_type.overwrite',
                        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\OverwritePriceInfluencer'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.record_type.scaled_absolute',
                        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\AbsoluteScaledPriceInfluencer'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.record_type.scaled_relative',
                        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\RelativeScaledPriceInfluencer'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.record_type.scaled_overwrite',
                        'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\OverwriteScaledPriceInfluencer'
                    ),
                ),
                'default' => 'Abra\\Cadabra\\Domain\\Model\\PriceInfluencer\\RelativePriceInfluencer',
            ),
        ),
        'absolute_amount' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.absolute_amount',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            )
        ),
        'relative_amount' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.relative_amount',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            )
        ),
        'overwrite_price' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.overwrite_price',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            )
        ),
        'minimum_quantity' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.minimum_quantity',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'integer'
            )
        ),
        'discount' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.discount',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.discount.discount',
                        '1'
                    ),
                    array(
                        'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.discount.addition',
                        '0'
                    ),
                ),
            ),
        ),
        'single_article_price_influence' => array(
            'label' => 'LLL:EXT:cadabra/Resources/Private/Language/locallang_db.xlf:price_influencer.single_article_price_influence',
            'config' => array(
                'type' => 'check',
            ),
        ),
    ),
);