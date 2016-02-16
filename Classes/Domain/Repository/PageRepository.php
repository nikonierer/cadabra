<?php
namespace Shop\Cadabra\Domain\Repository;

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
 * The repository for pages
 */
class PageRepository implements \TYPO3\CMS\Core\SingletonInterface
{

    /**
     * Finds all pages which containing records from the specified table
     *
     * @param string $table
     * @return array
     */
    public function findPagesContainingRecordType($table)
    {
        $result = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'page.*, count(item.uid) as items', // fields
            'pages as page, '. $table .' as item', // table
            'page.uid = item.pid', // where
            'page.uid' // group by
        );

        return $result;
    }

    /**
     * Wrapper method for $GLOBALS['TYPO3_DB']
     *
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

}