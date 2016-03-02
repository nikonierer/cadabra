<?php
namespace Abra\Cadabra\Domain\Model\Information;

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
 * FileInformation
 */
class FileInformation extends AbstractInformation
{

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\FileReference>
     */
    protected $files;


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
        $this->files = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getFiles()
    {

        return $this->files;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     *
     */
    public function render()
    {
    }
}
