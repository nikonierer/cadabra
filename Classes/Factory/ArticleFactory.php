<?php
namespace Abra\Cadabra\Factory;


    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2016 Marcel Wieser <typo3dev@marcel-wieser.de>
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
     ***************************************************************/

/**
 * Article factory
 */
class ArticleFactory
{
    /**
     * @inject
     * @var \Abra\Cadabra\Domain\Repository\ArticleRepository
     */
    protected $articleRepository;

    /**
     * @inject
     * @var \Abra\Cadabra\Service\ArticleHashingService
     */
    protected $articleHashingService;

    /**
     * @inject
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * @inject
     * @var \Abra\Cadabra\Domain\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * Generates articles based on an product
     *
     * @param integer|\Abra\Cadabra\Domain\Model\Product $product
     * @param boolean $persist
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function generateArticlesFromProduct($product, $persist = false) {
        $hashes = $this->articleHashingService->generateHashes($product);

        return $this->generateArticlesFromHashes($hashes, $persist);
    }

    /**
     * Generate articles from an array of hashes
     *
     * @param array $hashes
     * @param boolean $persist
     * @return \SplObjectStorage
     */
    public function generateArticlesFromHashes($hashes, $persist = false) {
        $articles = new \SplObjectStorage();

        foreach($hashes as $hash) {
            $article = $this->articleHashingService->resolveHash($hash);
            $article->setPid(self::getCurrentPageId());
            $articles->attach($article);

            if($persist && $article->_isNew()) {
                $product = $article->getProduct();
                $product->addArticle($article);

                $this->productRepository->update($product);

                $this->articleRepository->add($article);
            }
        }

        if($persist) {
            $this->persistenceManager->persistAll();
        }

        return $articles;
    }

    /**
     * This method will either return an persisted article
     * from the database or generate a new, transient article object.
     *
     * @param integer $product
     * @param array $attributes
     * @return \Abra\Cadabra\Domain\Model\Article
     *
     * @throws \Abra\Cadabra\Exception
     */
    public function generateArticleFromParameters($product, $attributes) {
        $hash = $this->articleHashingService->createHash($product, $attributes);

        return $this->articleHashingService->resolveHash($hash);
    }

    /**
     * Returns current page identifier
     *
     * @return integer
     */
    protected static function getCurrentPageId() {
        return (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
    }
}