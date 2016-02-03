<?php
namespace Shop\Cadabra\Domain\Model;

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
 * PriceInfluencer
 */
class PriceInfluencer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * The value influences the final price relative to the base price of the product
     */
    const INFLUENCER_TYPE_RELATIVE = 1;

    /**
     * The impact or discount influences the final price absolute
     */
    const INFLUENCER_TYPE_ABSOLUTE = 2;

    /**
     * Value must contain a formula which will be applied to the base price
     *
     * @WIP
     */
    const INFLUENCER_TYPE_FORMULA = 3;

    /**
     * Contains the type of the price influencer
     *
     * @var integer
     */
    protected $type;

    /**
     * Contains the influencer value
     *
     * @var double
     */
    protected $value;

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return double
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param double $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}