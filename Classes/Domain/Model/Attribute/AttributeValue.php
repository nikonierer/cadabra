<?php
namespace Abra\Cadabra\Domain\Model\Attribute;

    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2015 Marcel Wieser <typo3dev@marcel-wieser.de>
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
 * Value
 */
class AttributeValue extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Contains the value
     *
     * @var string
     */
    protected $value;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer>
     */
    protected $priceInfluencer;

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
        $this->priceInfluencer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer>
     */
    public function getPriceInfluencer()
    {
        return $this->priceInfluencer;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer> $priceInfluencer
     */
    public function setPriceInfluencer($priceInfluencer)
    {
        $this->priceInfluencer = $priceInfluencer;
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer $priceInfluencer
     */
    public function addPriceInfluencer($priceInfluencer)
    {
        $this->priceInfluencer->attach($priceInfluencer);
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer $priceInfluencer
     */
    public function removePriceInfluencer($priceInfluencer)
    {
        $this->priceInfluencer->detach($priceInfluencer);
    }

}