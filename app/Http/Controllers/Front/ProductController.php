<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductsByCateID($cateID) {
        $perPage = 9;
        $cateName = Category::find($cateID)->name;
        $productList = Category::find($cateID)->products()->paginate($perPage);

        return view('product-list', compact('productList', 'cateName'));
    }

    public function getCateProductList() {

    }
}
