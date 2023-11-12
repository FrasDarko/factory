<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    const RESULTS_PRE_PAGE = 5;

    private static $standardSelect = 'products.id, products.sku, products.name, products.description, products.published, products.price, contract_lists.price as contractPrice, listPrice, group_concat(categories.id) as categories';

    private static function mainQuery($userId) {
        return DB::table('products')
            ->leftJoin('product_categories', 'products.id', '=', 'product_categories.productId')
            ->leftJoin('categories', 'product_categories.categoryId', '=', 'categories.id')

            // TODO fix the next line to avoid SQL injection
            ->leftJoin(DB::raw('(SELECT MIN(product_price_lists.price) as listPrice,products_id FROM `user_price_lists` left join price_lists on price_lists.id=user_price_lists.price_list_id inner join product_price_lists on product_price_lists.price_list_id=price_lists.id WHERE users_id=' . $userId . ' group by product_price_lists.products_id order by listPrice asc) as product_price_lists'), 'products.id', '=', 'product_price_lists.products_id')

            // TODO fix the next line to avoid SQL injection
            ->leftJoin(DB::raw('(select * from contract_lists where users_id=' . $userId . ') as contract_lists'), 'products.id', '=', 'contract_lists.products_id')

            ->groupBy('products.id')
            ->groupBy('contract_lists.price')
            ->groupBy('listPrice');
    }

    public function index($userId, $page = 1) {
        $products = self::mainQuery($userId)
                    ->select(DB::raw(self::$standardSelect))
                    ->skip(($page - 1) * self::RESULTS_PRE_PAGE)->take(self::RESULTS_PRE_PAGE)
                    ->get();

        if (!empty($products) && count($products) > 0) {
            return response()->json($products);
        } else {
            return response()->json(["message" => "not found"], 404);
        }
    }

    public function show($userId, $id) {
        $product = self::mainQuery($userId)
                    ->select(DB::raw(self::$standardSelect))
                    ->where('products.id', '=', $id)
                    ->first();

        if (!empty($product)) {
            /*if (!empty($product->categories))
                $product->categories = explode(',', $product->categories);*/

            return response()->json($product);
        } else {
            return response()->json(["message" => "not found"], 404);
        }
    }

    public function showByCategory($userId, $catId, $page = 1) {
        $products = self::mainQuery($userId)
                    ->select(DB::raw(self::$standardSelect))
                    ->where('categories.id', '=', $catId)
                    ->skip(($page - 1) * self::RESULTS_PRE_PAGE)->take(self::RESULTS_PRE_PAGE)
                    ->get();

        if (!empty($products) && count($products) > 0) {
            return response()->json($products);
        } else {
            return response()->json(["message" => "not found"], 404);
        }
    }
}
