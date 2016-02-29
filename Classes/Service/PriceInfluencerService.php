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
 * Price Influencer Service
 */
class PriceInfluencerService
{

    /**
     * Collects all price influencer from (in the mentioned order):
     * - article
     * - attribute
     * - attribute value
     *
     * @param \Abra\Cadabra\Domain\Model\Article $article
     * @return \SplObjectStorage
     */
    public static function collectPriceInfluencerFromArticle($article)
    {
        $priceInfluencer = new \SplObjectStorage();

        foreach ($article->getPriceInfluencer() as $articlePriceInfluencer) {
            $priceInfluencer->attach($articlePriceInfluencer);
        }

        /** @var \Abra\Cadabra\Domain\Model\ArticleFeature $feature */
        foreach ($article->getFeatures() as $feature) {
            foreach ($feature->getAttribute()->getPriceInfluencer() as $attributePriceInfluencer) {
                $priceInfluencer->attach($attributePriceInfluencer);
            }

            foreach ($feature->getAttributeValue()->getPriceInfluencer() as $attributeFeaturePriceInfluencer) {
                $priceInfluencer->attach($attributeFeaturePriceInfluencer);
            }
        }

        return $priceInfluencer;
    }

}
