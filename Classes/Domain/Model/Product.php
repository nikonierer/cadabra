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
 * Product
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Contains the product title
     *
     * @var string
     */
    protected $title;

    /**
     * Contains a basic product description
     *
     * @var string
     */
    protected $description;

    /**
     * Contains relations to the product attributes
     *
     * @lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Attribute\AbstractAttribute>
     */
    protected $attributes;

    /**
     * Contains relations to further information
     *
     * @lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Information\AbstractInformation>
     */
    protected $information;

    /**
     * Contains relations to the categories
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Category>
     */
    protected $categories;

    /**
     * Contains the base price for the product
     *
     * @var double
     */
    protected $basePrice;

    /**
     * Contains the tax rate for the product
     *
     * @var double
     */
    protected $taxRate;

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
        $this->attributes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->information = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Attribute\AbstractAttribute>
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Attribute\AbstractAttribute> $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Information\AbstractInformation>
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Information\AbstractInformation> $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Category>
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Shop\Cadabra\Domain\Model\Category> $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return double
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @param double $basePrice
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return double
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param double $taxRate
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }


}