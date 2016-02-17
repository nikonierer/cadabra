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
 * Article Hashing Service
 */
class ArticleHashingService
{
    static protected $productModel = '\Abra\Cadabra\Domain\Model\Product';
    static protected $articleModel = '\Abra\Cadabra\Domain\Model\Article';
    static protected $attributeValue = '\Abra\Cadabra\Domain\Model\Attribute\AttributeValue';

    /**
     * @inject
     * @var \Abra\Cadabra\Domain\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * @inject
     * @var \Abra\Cadabra\Domain\Repository\ArticleRepository
     */
    protected $articleRepository;

    /**
     * @inject
     * @var \Abra\Cadabra\Domain\Repository\AttributeRepository
     */
    protected $attributeRepository;

    /**
     * @var \Abra\Cadabra\Domain\Model\Product
     */
    protected $product = null;

    /**
     * @var array
     */
    protected $attributes = array();

    /**
     * @var array
     */
    protected $attributeCombinations = array();

    /**
     * Generates hashes for all possible articles from a product
     *
     * This method will only generate a list of hashes.
     * Use the ArticleFactory to generate full blown article objects.
     *
     * @see \Abra\Cadabra\Factory\ArticleFactory::generateArticlesFromProduct()
     *
     * @param integer|\Abra\Cadabra\Domain\Model\Product $product
     * @return array
     */
    public function generateHashes($product) {
        $this->reset();
        $this->setProduct($product);

        $this->extractAttributes();
        $this->generateAllPossibleAttributeCombinations();

        $hashes = array();

        if(count($this->attributes) === 0) {
             $hashes[] = self::createHash($this->product->getUid(), array());
        } else {
            foreach ($this->attributeCombinations as $attributes) {
                $hashes[] = self::createHash($this->product->getUid(), $attributes);
            }
        }

        return $hashes;
    }

    /**
     * Creates JSON string as identifier for an article
     *
     * This method does not check if the hash is valid nor
     * if there's a persisted article available.
     *
     * Use the ArticleFactory to verify that an valid
     * article object can be build upon the given hash or
     * an persisted object can be fetched from the database.
     *
     * @see \Abra\Cadabra\Factory\ArticleFactory::createArticleFromParameters()
     *
     * @param integer $productIdentifier
     * @param array $attributes
     *
     * @return string
     */
    public static function createHash($productIdentifier, $attributes) {
        ksort($attributes);

        $articleIdentifier = array(
            'p' => $productIdentifier,
            'a' => $attributes
        );

        return json_encode($articleIdentifier);
    }

    /**
     * Returns an article object based on the hash identifier
     *
     * @param string $hash
     * @throws \Abra\Cadabra\Exception
     * @return \Abra\Cadabra\Domain\Model\Article
     */
    public function resolveHash($hash) {
        $this->reset();

        $article = $this->articleRepository->findByHash($hash);
        //Return persisted article if available
        if($article !== null) {
            return $article;
        }

        $json = json_decode($hash, true);

        $this->setProduct($json['p']);

        $features = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        foreach($json['a'] as $attribute => $attributeValue) {
            /**
             * @TODO: Use property mapper?!
             */
            $feature = new \Abra\Cadabra\Domain\Model\ArticleFeature();
            $feature->setProduct($this->product);

            /** @var \Abra\Cadabra\Domain\Model\Attribute\AbstractAttribute $attributeObject */
            $attributeObject = $this->attributeRepository->findByIdentifier($attribute);
            if($attributeObject === null) {
                throw new \Abra\Cadabra\Exception('Attribute with identifier '. $attribute .' is not available in the database.', 1455116486);
            }
            $feature->setAttribute($attributeObject);

            /** @var \Abra\Cadabra\Domain\Model\Attribute\AttributeValue $value */
            foreach ($attributeObject->getValues() as $value) {
                //Check if attribute value belongs to supplied attribute
                if($value->getUid() == $attributeValue) {
                    $feature->setAttributeValue($value);
                }
            }
            //No corresponding record found in attribute value list
            $obj = new self::$attributeValue;
            if (!$feature->getAttributeValue() instanceof $obj) {
                throw new \Abra\Cadabra\Exception(
                    'Attribute value with identifier '. $attributeValue .'does not belong to the attribute with identifier'. $attribute,
                    1455117095
                );
            }

            $features->attach($feature);
        }

        /**
         * @TODO: Use property mapper?!
         */
        $article = new \Abra\Cadabra\Domain\Model\Article();
        $article->setProduct($this->product);
        $article->setFeatures($features);
        $article->setHash($hash);

        return $article;
    }

    /**
     * Resets the service.
     *
     * This will avoid side effects
     * e.g. if you have to resolve a hash immediately
     * after you created hashes for a specific product
     *
     * @return void
     */
    public function reset() {
        $this->attributes = array();
        $this->attributeCombinations = array();
        $this->product = null;
    }

    /**
     * Sets property product based on object or identifier
     *
     * @param integer|\Abra\Cadabra\Domain\Model\Product $product
     * @throws \Abra\Cadabra\Exception
     */
    protected function setProduct($product) {
        $obj = new self::$productModel;
        if (!$product instanceof $obj && !is_integer($product)) {
            throw new \Abra\Cadabra\Exception('Property "product" must be an instance of '. self::$productModel .' or an integer.', 1455030395);
        } elseif(is_integer($product)) {
            $this->product = $this->productRepository->findByIdentifier($product);

            if(!$this->product instanceof $obj) {
                throw new \Abra\Cadabra\Exception('Product could not be fetched from database.', 1455102729);
            }
        } else {
            $this->product = $product;
        }
    }

    /**
     * Extracts attribute identifiers from product
     *
     * @return void
     */
    protected function extractAttributes() {
        $attributes = $this->product->getAttributes();
        $attributeArray = array();

        /** @var \Abra\Cadabra\Domain\Model\Attribute\AbstractAttribute $attribute */
        foreach ($attributes as $attribute) {
            $attributeArray[$attribute->getUid()] = array();

            /** @var \Abra\Cadabra\Domain\Model\Attribute\AttributeValue $value */
            foreach ($attribute->getValues() as $value) {
                $attributeArray[$attribute->getUid()][] = $value->getUid();
            }
            asort($attributeArray[$attribute->getUid()]);
        }
        ksort($attributeArray);

        $this->attributes = $attributeArray;
    }

    /**
     * Generates all possible combinations for related attributes of a product
     *
     * @param array $arrays
     */
    protected function generateAllPossibleAttributeCombinations($arrays = null) {
        if($arrays === null) {
            $arrays = $this->attributes;
        }

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

}