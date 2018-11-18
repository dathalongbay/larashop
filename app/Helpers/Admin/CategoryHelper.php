<?php
namespace App\Helpers\Admin;

use Illuminate\Support\Facades\DB;

class CategoryHelper {

    public static function get_all_category() {

        $cats = DB::table('product_categories')->get();

        return $cats;
    }

    public static function get_all_category_by_order($root_id = 0,$exclude_id = 0) {

        $cats = self::get_all_category()->all();

        $cats_order = array();

        $exclude_array_id = array();

        self::recursive_category($cats,$root_id,$cats_order, $exclude_array_id);

        if ($exclude_id) {
            $exclude_array = array();

            self::recursive_category($cats,$exclude_id,$exclude_array, $exclude_array_id);

            if ($cats_order) {
                foreach ($cats_order as $k => $cats_order_item) {
                    if(in_array($cats_order_item->id, $exclude_array_id)) {
                        $exclude_array[] = $cats_order_item->id;
                        unset($cats_order[$k]);
                    }
                }
            }
        }

        return $cats_order;
    }

    public static function recursive_category($oriCategories, $parents = 0, &$orderedCategories, &$exclude_cat_id){
        if(count($oriCategories)>0){
            foreach ($oriCategories as $key => $category){
                if($category->parent_id == $parents){
                    $orderedCategories[] = $category;
                    $exclude_cat_id[] = $category->id;
                    $newParents = $category->id;
                    unset($oriCategories[$key]);
                    self::recursive_category($oriCategories, $newParents, $orderedCategories, $exclude_cat_id);
                }
            }
        }
    }


}