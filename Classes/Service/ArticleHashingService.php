<?php
namespace Shop\Cadabra\Service;


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
 * Article Hashing Service
 */
class ArticleHashingService
{
    static protected $productModel = '\Shop\Cadabra\Domain\Model\Product';

    /**
     * @inject
     * @var \Shop\Cadabra\Domain\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * @inject
     * @var \Shop\Cadabra\Domain\Repository\ArticleRepository
     */
    protected $articleRepository;

    /**
     * @var \Shop\Cadabra\Domain\Model\Product
     */
    protected $product;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var array
     */
    protected $attributeCombinations;

    /**
     * Sets product to build articles from
     *
     * @param \Shop\Cadabra\Domain\Model\Product $product
     * @return void
     */
    public function setProduct($product) {
        $this->product = $product;
    }

    /**
     * Allows to set the product by identifier
     *
     * @param integer $identifier
     * @return void
     */
    public function setProductByIdentifier($identifier) {
        $this->product = $this->productRepository->findByIdentifier($identifier);
    }

    /**
     * @return array
     */
    public function generateArticles() {
        $this->checkProductProperty();
        $this->extractAttributes();

        $this->generateAllPossibleAttributeCombinations($this->attributes);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->attributes);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->attributeCombinations);

    }

    /**
     * Extracts attribute identifiers from product
     *
     * @return void
     */
    protected function extractAttributes() {
        $attributes = $this->product->getAttributes();
        $attributeArray = array();

        /** @var \Shop\Cadabra\Domain\Model\Attribute\AbstractAttribute $attribute */
        foreach ($attributes as $attribute) {
            $attributeArray[$attribute->getUid()] = array();

            /** @var \Shop\Cadabra\Domain\Model\Attribute\AttributeValue $value */
            foreach ($attribute->getValues() as $value) {
                $attributeArray[$attribute->getUid()][] = $value->getUid();
            }
            asort($attributeArray[$attribute->getUid()]);
        }
        ksort($attributeArray);

        $this->attributes = $attributeArray;
    }

    /**
     * @param array $arrays
     */
    protected function generateAllPossibleAttributeCombinations($arrays) {
        $result = array();

        //calculate expected size of result array...
        $size = (sizeof($arrays) > 0) ? 1 : 0;
        foreach ($arrays as $array) {
            $size = $size * sizeof($array);
        }

        for ($i = 0; $i < $size; $i++) {
            $result[$i] = array();

            foreach ($arrays as $key => $value) {
                $current = current($arrays[$key]);
                $result[$i][$key] = $current;
            }

            //set cursor on next element in the arrays, beginning with the last array
            $arrays = array_reverse($arrays, true);
            foreach ($arrays as $k => $v) {
                //if next returns true, then break
                if (next($arrays[$k])) {
                    break;
                } else {    //if next returns false, then reset and go on with previous array...
                    reset($arrays[$k]);
                }
            }
        }

        $this->attributeCombinations = $result;
    }

    /**
     * @throws \Shop\Cadabra\Exception
     * @return void
     */
    protected function checkProductProperty() {
        $obj = new self::$productModel;
        if (!$this->product instanceof $obj) {
            throw new \Shop\Cadabra\Exception('Property "product" must be an instance of '. self::$productModel .'.', 1455030395);
        }
    }
}