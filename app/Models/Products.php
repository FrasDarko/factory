<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Categories;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ["name", "description", "sku", "price", "published"];

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

    public static function fetchPaginated($userId, $page, $perPage = 10) {
        return self::mainQuery($userId)
                    ->select(DB::raw(self::$standardSelect))
                    ->skip(($page - 1) * $perPage)->take($perPage)
                    ->get();
    }

    public static function fetchSingle($userId, $id) {
        return self::mainQuery($userId)
                    ->select(DB::raw(self::$standardSelect))
                    ->where('products.id', '=', $id)
                    ->first();
    }

    public static function fetchForCategoryPaginated($userId, $catId, $page, $perPage) {
        return self::mainQuery($userId)
                    ->select(DB::raw(self::$standardSelect))
                    ->where('categories.id', '=', $catId)
                    ->skip(($page - 1) * $perPage)->take($perPage)
                    ->get();
    }

    public function categories() {
        return $this->belongsToMany(Categories::class);
    }
}
