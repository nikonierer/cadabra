<?php
namespace Abra\Cadabra\Service;


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
 * Frontend user service
 */
class FrontendUserService implements \TYPO3\CMS\Core\SingletonInterface
{

    /**
     *
     * @inject
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     */
    protected $frontendUserRepository;

    /**
     *
     * @inject
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository
     */
    protected $frontendUserGroupRepository;

    /**
     * @var array
     */
    protected $settings;

    /**
     *
     * @inject
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     *
     * @inject
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * Initializes object
     */
    public function initializeObject()
    {
        $configuration = $this->configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );

        $this->settings = $configuration['settings'];
    }

    /**
     * Generates an temporary frontend user if needed.
     * If user is logged in, the already persisted will be returned.
     *
     * @return \Abra\Cadabra\Domain\Model\FrontendUser
     */
    public function create()
    {
        $this->initializeObject();

        $user = $this->getFrontendUser();

        if ($user !== null) {
            return $user;
        }

        $user = $this->createTemporaryUser();
        $this->authenticateUser($user);

        return null;
    }

    /**
     * @return \Abra\Cadabra\Domain\Model\FrontendUser
     */
    protected function getFrontendUser()
    {
        $user = $this->getTsfeFeUser()->user;

        return $this->frontendUserRepository->findByIdentifier($user['uid']);
    }

    /**
     * @return \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
     */
    protected function getTsfeFeUser()
    {
        return $GLOBALS['TSFE']->fe_user;
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\FrontendUser $user
     *
     * @return void
     */
    protected function authenticateUser($user)
    {

        /**
         * @TODO: Refactoring needed?!
         */
        $this->getTsfeFeUser()->checkPid = '';
        $this->getTsfeFeUser()->forceSetCookie = TRUE;
        $info = $this->getTsfeFeUser()->getAuthInfoArray();
        $feUser = $this->getTsfeFeUser()->fetchUserRecord($info['db_user'], $user->getUsername());
        $this->getTsfeFeUser()->createUserSession($feUser);
        $this->getTsfeFeUser()->user = $this->getTsfeFeUser()->fetchUserSession();
        $this->getTsfeFeUser()->setAndSaveSessionData('temporaryUser', true);

        \TYPO3\CMS\Core\Utility\HttpUtility::redirect(\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REQUEST_URI'));
    }

    /**
     * Generates new temporary user
     *
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     *
     * @return \Abra\Cadabra\Domain\Model\FrontendUser
     */
    protected function createTemporaryUser()
    {
        $username = $this->createUniqueUserName();

        $user = new \Abra\Cadabra\Domain\Model\FrontendUser();
        $user->setUsername($username);
        $user->setPassword(sha1(time()));

        $userGroupId = $this->settings['frontendUser']['temporaryFrontendUserGroupId'];

        /** @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $userGroup */
        $userGroup = $this->frontendUserGroupRepository->findByIdentifier($userGroupId);

        $user->addUsergroup($userGroup);
        $user->setTemporaryUser(true);

        $this->frontendUserRepository->add($user);

        $this->persistenceManager->persistAll();

        return $user;
    }

    /**
     * Creates unique username
     *
     * @return string
     */
    protected function createUniqueUserName()
    {
        $hash = md5(time());

        $username = $this->frontendUserRepository->findByUsername($hash)->getFirst();

        if ($username !== null) {
            $this->createUniqueUserName();
        }

        return $hash;
    }
}
