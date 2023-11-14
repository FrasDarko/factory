<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    const RESULTS_PER_PAGE = 5;

    public function index($userId, $page = 1) {
        $products = Products::fetchPaginated($userId, $page, self::RESULTS_PER_PAGE);

        if (!empty($products) && count($products) > 0) {
            return response()->json($products);
        } else {
            return response()->json(["message" => "not found"], 404);
        }
    }

    public function show($userId, $id) {
        $product = Products::fetchSingle($userId, $id);

        if (!empty($product)) {
            /*if (!empty($product->categories))
                $product->categories = explode(',', $product->categories);*/

            return response()->json($product);
        } else {
            return response()->json(["message" => "not found"], 404);
        }
    }

    public function showByCategory($userId, $catId, $page = 1) {
        $products = Products::fetchForCategoryPaginated($userId, $catId, $page, self::RESULTS_PER_PAGE);

        if (!empty($products) && count($products) > 0) {
            return response()->json($products);
        } else {
            return response()->json(["message" => "not found"], 404);
        }
    }
}
