<?php
namespace Abra\Cadabra\Domain\Repository;

    /***************************************************************
     *  Copyright notice
     *  (c) 2016 Marcel Wieser <typo3dev@marcel-wieser.de>
     *
     *  All rights reserved
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

/**
 * The abstract repository
 */
class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Initialize Object
     */
    public function initializeObject()
    {
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');

        if(TYPO3_MODE === 'BE') {
            $id = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
            $querySettings->setStoragePageIds(array($id));
        } else {
            $querySettings->setRespectStoragePage(false);
        }

        $this->setDefaultQuerySettings($querySettings);
    }
}