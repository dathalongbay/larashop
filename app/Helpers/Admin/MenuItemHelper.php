<?php
namespace App\Helpers\Admin;

use Illuminate\Support\Facades\DB;

class MenuItemHelper {

    public static function get_all_menus($id) {

        $menus = DB::table('menu_items')->where('menu', $id)->get();

        return $menus;
    }

    public static function get_child_menus_by_root($root_id = 0) {

        $menus = DB::table('menu_items')->get();

        $menus_order = array();

        $exclude_array_id = array();

        self::recursive_menus($menus,$root_id,$menus_order, $exclude_array_id);

        return $menus_order;
    }

    public static function get_all_menus_by_order($menu_id = 0,$exclude_id = 0) {

        $menus = self::get_all_menus($menu_id)->all();

        $menus_order = array();

        $exclude_array_id = array();

        self::recursive_menus($menus,0,$menus_order, $exclude_array_id);

        if ($exclude_id) {
            $exclude_array = array();
            $exclude_array_id = array();

            self::recursive_menus($menus,$exclude_id,$exclude_array, $exclude_array_id);

            if ($menus_order) {
                foreach ($menus_order as $k => $menus_order_item) {
                    if(in_array($menus_order_item->id, $exclude_array_id)) {
                        $exclude_array[] = $menus_order_item->id;
                        unset($menus_order[$k]);
                    }
                }
            }
        }

        return $menus_order;
    }

    public static function recursive_menus($oriMenus, $parents = 0, &$orderedMenus, &$exclude_array_id){
        if(count($oriMenus)>0){
            foreach ($oriMenus as $key => $menu){
                if($menu->parent_id == $parents){
                    $orderedMenus[] = $menu;
                    $exclude_array_id[] = $menu->id;
                    $newParents = $menu->id;
                    unset($oriMenus[$key]);
                    self::recursive_menus($oriMenus, $newParents, $orderedMenus, $exclude_array_id);
                }
            }
        }
    }


}