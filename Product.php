<?php

class Product
{
    var $name;
    var $price;

    function setNewProduct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    function showAttributes()
    {
        echo '<br>';
        echo 'Product: ' . $this->name;
        echo '<br>';
        echo 'Price: ' . $this->price;
    }
}
