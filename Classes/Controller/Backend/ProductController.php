<?php
namespace Abra\Cadabra\Controller\Backend;

    /***************************************************************
     *  Copyright notice
     *  (c) 2016 Marcel Wieser <typo3dev@marcel-wieser.de>
     *
     *  All rights reserved
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

/**
 * ProductController
 *
 * @property \TYPO3\CMS\Backend\View\BackendTemplateView $view
 */
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Backend Template Container
     *
     * @var \TYPO3\CMS\Backend\View\BackendTemplateView
     */
    protected $defaultViewObjectName = \TYPO3\CMS\Backend\View\BackendTemplateView::class;

    /**
     * Contains the current page identifier
     *
     * @var integer
     */
    protected $pageUid;

    /**
     * @var \Abra\Cadabra\Domain\Repository\ProductRepository
     * @inject
     */
    protected $productRepository;

    /**
     * @var \Abra\Cadabra\Domain\Repository\ArticleRepository
     * @inject
     */
    protected $articleRepository;

    /**
     * @var \Abra\Cadabra\Domain\Repository\PageRepository
     * @inject
     */
    protected $pageRepository;

    /**
     * @var \Abra\Cadabra\Service\ArticleHashingService
     * @inject
     */
    protected $articleHashingService;

    /**
     * @var \Abra\Cadabra\Factory\ArticleFactory
     * @inject
     */
    protected $articleFactory;

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder
     * @inject
     */
    protected $uriBuilder;

    /**
     * Initialize action
     *
     * @return void
     */
    public function initializeAction()
    {
        $this->pageUid = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id');
        parent::initializeAction();
    }

    /**
     * Create doc header drop down
     *
     * @return void
     */
    protected function createMenu()
    {
        $this->uriBuilder->setRequest($this->request);

        $menu = $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->makeMenu();
        $menu->setIdentifier('cadabra');

        $actions = [
            ['action' => 'index', 'label' => 'listProducts'],
            ['action' => 'listArticles', 'label' => 'listArticles']
        ];

        foreach ($actions as $action) {
            $item = $menu->makeMenuItem()
                ->setTitle($this->getLanguageService()->sL('LLL:EXT:cadabra/Resources/Private/Language/locallang_be.xlf:module.' . $action['label']))
                ->setHref($this->uriBuilder->reset()->uriFor($action['action'], [], 'Backend\Product'))
                ->setActive($this->request->getControllerActionName() === $action['action']);

            $menu->addMenuItem($item);
        }

        $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);
        $pageInfo = \TYPO3\CMS\Backend\Utility\BackendUtility::readPageAccess($this->pageUid, '');
        $this->view->getModuleTemplate()->getDocHeaderComponent()->setMetaInformation($pageInfo);
    }

    /**
     * Initialize view
     *
     * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view
     */
    protected function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view)
    {
        /** @var \TYPO3\CMS\Backend\View\BackendTemplateView $view */
        parent::initializeView($view);

        $view->getModuleTemplate()->getDocHeaderComponent()->setMetaInformation([]);
        $pageRenderer = $this->view->getModuleTemplate()->getPageRenderer();
        $pageRenderer->loadRequireJsModule('TYPO3/CMS/Backend/ClickMenu');

        $this->createMenu();
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $pages = $this->pageRepository->findPagesContainingRecordType('tx_cadabra_domain_model_product');
        $products = $this->productRepository->findAll();

        $this->view->assign('products', $products);
        $this->view->assign('pages', $pages);
    }

    /**
     * @return void
     */
    public function listArticlesAction()
    {
        $articles = $this->articleRepository->findByPid($this->pageUid);
        $pages = $this->pageRepository->findPagesContainingRecordType('tx_cadabra_domain_model_article');

        $this->view->assign('articles', $articles);
        $this->view->assign('pages', $pages);
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\Product $product
     * @return void
     */
    public function generateArticlesAction($product)
    {
        $articles = $this->articleFactory->generateArticlesFromProduct($product, true);

        $this->redirect('listArticles');
    }

    /**
     * Wrapper method for $GLOBALS['LANG']
     *
     * @return \TYPO3\CMS\Lang\LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}