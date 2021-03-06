<?php
namespace Abra\Cadabra\Domain\Model;

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
 * Article
 */
class Article extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \Abra\Cadabra\Domain\Model\Product
     */
    protected $product;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\Information\AbstractInformation>
     */
    protected $information;

    /**
     * @lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\ArticleFeature>
     */
    protected $features;

    /**
     * @lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer>
     */
    protected $priceInfluencer;

    /**
     * @var boolean
     */
    protected $orderable;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @inject
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

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
        $configuration = $this->configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $this->settings = $configuration['settings'];

        $this->features = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->priceInfluencer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->information = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\Information\AbstractInformation>
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\Information\AbstractInformation> $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\Information\AbstractInformation $information
     */
    public function addInformation($information)
    {
        $this->information->attach($information);
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\Information\AbstractInformation $information
     */
    public function removeInformation($information)
    {
        $this->information->detach($information);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\ArticleFeature>
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\ArticleFeature> $features
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\ArticleFeature $feature
     */
    public function addFeature($feature)
    {
        $this->features->attach($feature);
    }

    /**
     * @param \Abra\Cadabra\Domain\Model\ArticleFeature $feature
     */
    public function removeFeature($feature)
    {
        $this->features->detach($feature);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer>
     */
    public function getPriceInfluencer()
    {
        return $this->priceInfluencer;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Abra\Cadabra\Domain\Model\PriceInfluencer\AbstractPriceInfluencer> $priceInfluencer
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

    /**
     * @return boolean
     */
    public function isOrderable()
    {
        return $this->orderable;
    }

    /**
     * @param boolean $orderable
     */
    public function setOrderable($orderable)
    {
        $this->orderable = $orderable;
    }

    /**
     * Returns price based on the base price and all related price influencer
     *
     * @return string
     */
    public function getNetPrice()
    {
        $basePrice =  $this->product->getBasePrice();
        $newPrice = $basePrice;
        $priceInfluencer = \Abra\Cadabra\Service\PriceInfluencerService::collectPriceInfluencerFromArticle($this);

        /** @var \Abra\Cadabra\Domain\Model\PriceInfluencer\PriceInfluencerInterface $influencer */
        foreach($priceInfluencer as $influencer) {
            $newPrice = $influencer->calculatePrice($newPrice);
        }

        return $this->numberFormat($newPrice);
    }

    /**
     * Returns price including tax
     *
     * @return string
     */
    public function getGrossPrice()
    {
        $netPrice = $this->getNetPrice() + (($this->getProduct()->getTaxRate() / 100) * $this->getNetPrice());

        return $this->numberFormat($netPrice);
    }

    /**
     * Format number based on TS settings
     *
     * @param float $price
     * @param integer $decimals
     *
     * @return string
     */
    protected function numberFormat($price, $decimals = 2)
    {
        return number_format(
            $price,
            $decimals,
            $this->settings['numbers']['decimalSeparator'],
            $this->settings['numbers']['thousandsSeparator']
        );
    }

}
