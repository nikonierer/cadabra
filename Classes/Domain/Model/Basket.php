<?php
namespace Abra\Cadabra\Domain\Model;


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
 * Basket
 */
class Basket extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var \Abra\Cadabra\Domain\Model\FrontendUser
     */
    protected $frontendUser;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\Ordering\OrderableArticle>
     */
    protected $positions;

    /**
     * Initialize objects
     */
    public function initializeObject()
    {
        $this->positions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \Abra\Cadabra\Domain\Model\FrontendUser
     */
    public function getFrontendUser()
    {
        return $this->frontendUser;
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\FrontendUser $frontendUser
     */
    public function setFrontendUser($frontendUser)
    {
        $this->frontendUser = $frontendUser;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\Ordering\OrderableArticle>
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\Ordering\OrderableArticle> $positions
     */
    public function setPositions($positions)
    {
        $this->positions = $positions;
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\Ordering\OrderableArticle $position
     */
    public function addPosition($position)
    {
        $this->positions->attach($position);
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\Ordering\OrderableArticle $position
     */
    public function removePosition($position)
    {
        $this->positions->detach($position);
    }

    /**
     * Returns the total amount of articles
     *
     * @return integer
     */
    public function getTotalAmount()
    {
        $totalAmount = 0;
        /** @var \Abra\Cadabra\Domain\Model\Ordering\BasketEntry $position */
        foreach($this->getPositions() as $position) {
            $totalAmount += $position->getAmount();
        }

        return $totalAmount;
    }

}