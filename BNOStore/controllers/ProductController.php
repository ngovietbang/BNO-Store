<?php
require_once('./models/class/Product.php');

class ProductController{
    //hien thi san pham
    public function HienThiSP(){
        $products = new Product();
        $product = $products->HienThiSP();
    }


}