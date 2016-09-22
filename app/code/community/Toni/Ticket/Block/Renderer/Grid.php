<?php
class Toni_Ticket_Block_Renderer_Grid extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $productId =  $row->getData($this->getColumn()->getIndex());
        $product = Mage::getModel('catalog/product')->load($productId);

        $value = '<img src="">';
        if($product->getImage()!= 'noselection')
        {
            $value='<img src="' . $product->getImageUrl() . '" width="100" height="100" />';
        }

        return $value;
    }
}