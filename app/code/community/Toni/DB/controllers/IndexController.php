<?php
class Toni_DB_IndexController extends Mage_Core_Controller_Front_Action
{
    public function  IndexAction() {

        /** @var Mage_Catalog_Model_Category $category */
        $category = Mage::getModel('catalog/category')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load(18);

        //$collection = $category->getProductCollection();

        //$collection = Mage::getResourceModel('catalog/product_collection');
        $collection = Mage::getModel('catalog/product')->getCollection();

        //var_dump(get_class($collection));

        //$collection->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes());
        $collection->addCategoryFilter($category)
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addUrlRewrite($category->getId());

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);


        //$setIds = $collection->getSetIds();
        //$collection->addIsFilterableFilter();
        $collection->load();

        foreach($collection as $product) {
            var_dump($product->debug());
        }

        //var_dump($collection);


    }
}