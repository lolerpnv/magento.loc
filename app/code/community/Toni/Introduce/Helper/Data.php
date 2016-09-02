<?php

class Toni_Introduce_Helper_Data extends Mage_Core_Helper_Data
{
    protected $WHO_AM_I = 'introduce';

    public function __construct(){
    }
    public function __call($name , $arguments){
        //echo "call: $name \n";
        //var_dump($arguments);
    }
    public function __set($name, $value){
        //echo "setter: $name => $value  \n";
    }

    public function __get($name){
        //echo "getter: $name  \n";
    }

}