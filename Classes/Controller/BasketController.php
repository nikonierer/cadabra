<?php
namespace Abra\Cadabra\Controller;

    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2016  Marcel Wieser <typo3dev@marcel-wieser.de>
     *
     *  All rights reserved
     *
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *
     *  This copyright notice MUST APPEAR in all copies of the script!
     *  Created by PhpStorm.
     ******************************************************************/

/**
 * Class BasketController
 * @package Abra\Cadabra\Controller
 */
class BasketController extends ActionController
{

    /**
     * @var string
     */
    protected static $mainBasketTypeName = 'Main';

    /**
     * @var \Abra\Cadabra\Domain\Repository\BasketRepository
     * @inject
     */
    protected $basketRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     * @inject
     */
    protected $persistenceManager;

    /**
     * @var \Abra\Cadabra\Domain\Model\Basket
     */
    protected $basket;

    /**
     * Initialize action
     */
    public function initializeAction()
    {


        parent::initializeAction();

        $basket = $this->basketRepository->findByFrontendUserAndType($this->frontendUser, self::$mainBasketTypeName);

        if(!$basket) {
            $basket = new \Abra\Cadabra\Domain\Model\Basket();
            $basket->setFrontendUser($this->frontendUser);
            $basket->setType(self::$mainBasketTypeName);

            $this->basketRepository->add($basket);
            $this->persistenceManager->persistAll();
        }

        $this->basket = $basket;
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\Article $article
     * @param integer $amount
     *
     * @return void
     */
    public function addArticleAction($article, $amount = 1)
    {
        $positions = $this->basket->getPositions();

        /** @var \Abra\Cadabra\Domain\Model\Ordering\BasketEntry $position */
        foreach($positions as $position) {
            if($position->getUid() === $article->getUid()) {

            }
        }

        $basketEntry = new \Abra\Cadabra\Domain\Model\Ordering\BasketEntry();
        $basketEntry->setArticle($article);
        $basketEntry->setAmount($amount);
        $basketEntry->setBasket($this->basket);

        $this->basket->addPosition($basketEntry);

        $this->basketRepository->update($this->basket);
        $this->persistenceManager->persistAll();

        $pageId = ($this->settings['basket']['basketPageId']) ? $this->settings['basket']['basketPageId'] : null;
        $this->redirect('show', 'Basket', 'cadabra', null, $pageId);
    }

    /**
     * @return void
     */
    public function showAction()
    {
        $this->view->assign('basket', $this->basket);
    }

    /**
     * @return void
     */
    public function widgetAction()
    {
        $this->view->assign('basket', $this->basket);
    }
}
