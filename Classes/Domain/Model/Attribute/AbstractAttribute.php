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
 * AbstractAttribute
 */
class AbstractAttribute extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Contains the name of the attribute
     *
     * @var string
     */
    protected $name;

    /**
     * Contains relations to the values of the attribute
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\Attribute\AttributeValue>
     */
    protected $values;

    /**
     * Contains relations to further information
     *
     * @lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\Information\AbstractInformation>
     */
    protected $information;

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
        $this->values = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->priceInfluencer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->information = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\Attribute\AttributeValue>
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\Attribute\AttributeValue> $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\Information\AbstractInformation>
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\Information\AbstractInformation> $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer>
     */
    public function getPriceInfluencer()
    {
        return $this->priceInfluencer;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer>
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