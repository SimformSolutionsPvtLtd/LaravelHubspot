<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    /**
     * This function is used to retun product form to create product in hubspot
     *
     * @return void
     */
    public function createProduct()
    {
        return view('product_create');
    }
}
