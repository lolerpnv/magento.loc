<?php
class Toni_DB_IndexController extends Mage_Core_Controller_Front_Action
{
    public function  IndexAction() {


       //var_dump(Mage::getSingleton('catalog/config')->getProductAttributes());
       //die;

        /** @var Mage_Catalog_Model_Category $category
         * @var Mage_Catalog_Model_Product $collection
         */
        /*$category = Mage::getModel('catalog/category')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load(16);*/
        $att = Mage::getSingleton('catalog/config')->getProductAttributes();


        $collection = Mage::getModel('catalog/product')->getCollection()
            //->addAttributeToSelect($att[1])
            //->addCategoryFilter($category)
            ->addAttributeToFilter('sir', array('eq' => 1))
            //->addMinimalPrice()

            ;





        $collection->load();

        foreach ($collection as $product) {
            var_dump($product->getData());
        }


        return;









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

        echo sizeof($collection);

        /*foreach($collection as $product) {
            var_dump($product->debug());
        }*/

        //var_dump($collection);


    }
}