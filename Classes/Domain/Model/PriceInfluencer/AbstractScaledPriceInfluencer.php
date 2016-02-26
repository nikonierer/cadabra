<?php
namespace Abra\Cadabra\Domain\Model\PriceInfluencer ;

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
 * AbstractScaledPriceInfluencer
 */
class AbstractScaledPriceInfluencer extends AbstractPriceInfluencer
{
    /**
     * @var boolean
     */
    protected $singleArticlePriceInfluence;

    /**
     * @var integer
     */
    protected $minimumQuantity;

    /**
     * @return boolean
     */
    public function getSingleArticlePriceInfluence()
    {
        return $this->singleArticlePriceInfluence;
    }

    /**
     * @return boolean
     */
    public function isSingleArticlePriceInfluence()
    {
        return $this->singleArticlePriceInfluence;
    }

    /**
     * @param boolean $singleArticlePriceInfluence
     */
    public function setSingleArticlePriceInfluence($singleArticlePriceInfluence)
    {
        $this->singleArticlePriceInfluence = $singleArticlePriceInfluence;
    }

    /**
     * @return integer
     */
    public function getMinimumQuantity()
    {
        return $this->minimumQuantity;
    }

    /**
     * @param integer $minimumQuantity
     */
    public function setMinimumQuantity($minimumQuantity)
    {
        $this->minimumQuantity = $minimumQuantity;
    }


}