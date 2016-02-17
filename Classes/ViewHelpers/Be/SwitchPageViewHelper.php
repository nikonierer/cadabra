<?php
namespace Abra\Cadabra\ViewHelpers\Be;


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
 * Switch Page ViewHelper
 */
class SwitchPageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{

    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Initialize arguments
     *
     * @return void
     * @api
     */
    public function initializeArguments()
    {
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
    }

    /**
     * Crafts a link to edit a database record or create a new one
     *
     * @param integer $pageId
     * @param string $returnUrl URL to return to
     * @return string The <a> tag
     * @see \TYPO3\CMS\Backend\Utility::editOnClick()
     */
    public function render($pageId, $returnUrl = '')
    {
        if($returnUrl == '') {
            $returnUrl = 'index.php?M=web_CadabraProductadministration&id=' . (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id')
                . '&moduleToken=' . \TYPO3\CMS\Core\FormProtection\FormProtectionFactory::get()->generateToken('moduleCall', 'web_CadabraProductadministration');
        }

        \TYPO3\CMS\Backend\Utility\BackendUtility::openPageTree((int)$pageId,false);
        \TYPO3\CMS\Backend\Utility\BackendUtility::setUpdateSignal('updatePageTree');

        $uri = \TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('web_CadabraProductadministration', [
            'id' => $pageId,
            'returnUrl' => $returnUrl
        ]);

        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}