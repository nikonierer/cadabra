mod.wizards.newContentElement.renderMode = tabs
mod.wizards.newContentElement.wizardItems.common {
    elements {
        cadabra_product {
            icon = ../typo3conf/ext/cadabra/Resources/Public/Icons/cadabra_product_list.gif
            title = LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_product
            description = LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_product.description
            tt_content_defValues {
                CType = cadabra_product
            }
        }
        cadabra_article {
            icon = ../typo3conf/ext/cadabra/Resources/Public/Icons/cadabra_article_list.gif
            title = LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_article
            description = LLL:EXT:cadabra/Resources/Private/Language/locallang_ce.xlf:cadabra_article.description
            tt_content_defValues {
                CType = cadabra_article
            }
        }
    }
    show = *
}


