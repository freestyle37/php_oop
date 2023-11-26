<?php
require_once '../functions/common_functions.php';

class ShopProduct
{
  public $title = "Стандартный товар";
  public $price = 0;
}

$product1 = new ShopProduct();

echo $product1->title;

$product1->title = "Собачье сердце";

$product1->arbitraryAddition = "Дополнительный параметр";

vd($product1);