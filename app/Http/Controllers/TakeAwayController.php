<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class TakeAwayController extends Controller
{
    public function takeAway(){
        $categorys = DB::select('select id,name,position from categories order by position');

        //Array para almacenar los productos por categoría
        $productsByCategory = [];

        foreach ($categorys as $category) {
            // Consultar los productos asociados a la categoría actual
            $products = DB::select('select id,name,description,price,availability,image_url from products where availability = 1 and category_id = ?', [$category->id]);
            //Almacenar los alergenos asociados a los productos
            foreach ($products as $product) {
                $product->allergens = DB::select('
                SELECT allergens.name, allergens.img_url
                FROM allergens
                INNER JOIN products_allergens ON allergens.id = products_allergens.allergen_id
                WHERE products_allergens.product_id = ?
                ',
                [$product->id]);
            }

            // Almacenar los productos en el array asociativo
            $productsByCategory[$category->name] = $products;
        }


        return view('user-views.menu',
        ['productsByCategory' => $productsByCategory,
        'takeAway' => 1]);
    }
}
