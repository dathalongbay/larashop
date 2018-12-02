<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use App\ProductPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use File;

use CategoryHelper;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminProductCategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $cats = CategoryHelper::get_all_category_by_order();

        return view('admin.product-category.show', compact('cats', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $parents = CategoryHelper::get_all_category_by_order();

        $option_parent = array();
        $option_parent[0] = 'None';

        if ($parents) {
            foreach ($parents as $parent) {
                $option_parent[$parent->id] = str_repeat('-', $parent->level).' '.$parent->title;
            }
        }

        return view('admin.product-category.create', compact('parents', 'option_parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        /*$this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required',
        ]);*/

        $cat = new ProductCategory();
        $cat->title = $request['title'];
        $cat->desc = $request['desc'] ? $request['desc'] : '';
        $parent_id = $request['parent_id'] ? $request['parent_id'] : 0;

        $cat->image = $request['image'] ? $request['image'] : '';

        $cat->parent_id = $parent_id;

        if ($parent_id == 0) {
            $cat->level = 1;
        } else {
            $parent_cat = ProductCategory::findOrFail($cat->parent_id);
            $cat->level = $parent_cat->level + 1;
        }

        $cat->save();


        return redirect()->route('product-category.index')
            ->with('flash_message', 'Article,
             '. $cat->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //

        return redirect()->route('product-category.index')
            ->with('flash_message',
                'Role added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $cat = ProductCategory::findOrFail($id);

        $parents = CategoryHelper::get_all_category_by_order($cat->id);

        $except_parents = array();

        if ($parents) {
            foreach ($parents as $parent) {
                $except_parents[] = $parent->id;
            }
        }

        $all_parents = CategoryHelper::get_all_category_by_order();

        $option_parent = array();
        $option_parent[0] = 'None';

        if ($all_parents) {
            foreach ($all_parents as $parent) {

                if (!in_array($parent->id, $except_parents) && ($parent->id != $cat->id)) {
                    $option_parent[$parent->id] = str_repeat('-', $parent->level).' '.$parent->title;
                }

            }
        }

        $user = Auth::user();

        return view('admin.product-category.edit', compact('cat', 'parents', 'option_parent', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'title'=>'required|max:100',
            'body'=>'required',
        ]);*/

        $cat = ProductCategory::findOrFail($id);

        $old_cat = clone $cat;
        $cat->title = $request->input('title');
        $cat->desc = $request->input('desc');

        $parent_id = $request->input('parent_id') ? $request->input('parent_id') : 0;

        $cat->parent_id = $parent_id;
        $cat->image = $request->input('image');

        if ($parent_id == 0) {
            $cat->level = 1;
        } else {
            $parent_cat = ProductCategory::findOrFail($cat->parent_id);
            $cat->level = $parent_cat->level + 1;
        }

        $cat->save();

        // Change parent id update all child level
        if ($old_cat->parent_id != $parent_id) {
            $child_list = CategoryHelper::get_all_category_by_order($cat->id);
            $child_list_id = array();

            foreach ($child_list as $child_cat) {
                if ($child_cat->id != $cat->id) {
                    $child_list_id[] = '"'.$child_cat->id.'"';
                }
            }

            if ($child_list_id) {
                $child_list_str = implode(',', $child_list_id);

                if ($old_cat->level > $cat->level) {
                    $change_level = $old_cat->level - $cat->level;
                    DB::statement( "UPDATE product_categories SET level = level - $change_level WHERE id IN($child_list_str)" );
                } elseif ($old_cat->level < $cat->level) {
                    $change_level = $cat->level - $old_cat->level;
                    DB::statement( "UPDATE product_categories SET level = level + $change_level WHERE id IN($child_list_str)" );
                } else {

                }


            }

        }

        return redirect()->route('product-category.index',
            $cat->id)->with('flash_message',
            'Article, '. $cat->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $cat = ProductCategory::findOrFail($id);

        $child_first = DB::table('product_categories')->where('parent_id', $cat->id)->first();

        if (!$child_first) {
            DB::table('products')
                ->where('cat_id', $cat->id)
                ->update(['cat_id' => 0]);


            $cat->delete();

        } else {
            return redirect()->route('product-category.index')
                ->with('flash_message',
                    'Category is not empty! You can not delete this item');
        }


        return redirect()->route('product-category.index')
            ->with('flash_message',
                'Product Category deleted!');
    }
}
