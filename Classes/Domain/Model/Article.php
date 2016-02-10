<?php
namespace Shop\Cadabra\Domain\Model;

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
 * Article
 */
class Article extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \Shop\Cadabra\Domain\Model\Product
     */
    protected $product;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var \Shop\Cadabra\Domain\Model\Information\AbstractInformation
     */
    protected $information;

    /**
     * @lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Shop\Cadabra\Domain\Model\ArticleFeature>
     */
    protected $features;

    /**
     * The constructor
     */
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * Initialize objects
     */
    public function initializeObject()
    {
        $this->features = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return Information\AbstractInformation
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param Information\AbstractInformation $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $features
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    }

}