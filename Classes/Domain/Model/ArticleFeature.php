<?php
namespace Shop\Cadabra\Domain\Model;

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
 * ArticleAttribute
 */
class ArticleFeature extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Contains the product
     *
     * @var \Shop\Cadabra\Domain\Model\Product
     */
    protected $product;

    /**
     * Contains the article
     *
     * @var \Shop\Cadabra\Domain\Model\Article
     */
    protected $article;

    /**
     * Contains the attribute
     *
     * @var \Shop\Cadabra\Domain\Model\Attribute\AbstractAttribute
     */
    protected $attribute;

    /**
     * Contains the attribute value
     *
     * @var \Shop\Cadabra\Domain\Model\Attribute\AttributeValue
     */
    protected $attributeValue;

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
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param Article $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return Attribute\AbstractAttribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param Attribute\AbstractAttribute $attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return Attribute\AttributeValue
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * @param Attribute\AttributeValue $attributeValue
     */
    public function setAttributeValue($attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }

}