<?php
namespace Abra\Cadabra\Controller;

    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 18.02.2016  Michael <michael.blunck@phth.de>, PHTH
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
 * Class ArticleController
 * @package Abra\Cadabra\Controller
 */
class ArticleController extends ActionController
{
    /**
     * ArticleRepository
     *
     * @var \Abra\Cadabra\Domain\Repository\ArticleRepository
     * @inject
     */
    protected $articleRepository;

    /**
     * show
     *
     * @param \Abra\Cadabra\Domain\Model\Article $article
     */
    public function showAction(\Abra\Cadabra\Domain\Model\Article $article)
    {
        $this->view->assign('article', $article);
    }

    /**
     * list
     *
     * @return void
     */
    public function listAction()
    {
        $articles = $this->articleRepository->findAll();
        $this->view->assign('articles', $articles);
    }
}
