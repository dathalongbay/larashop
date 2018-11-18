<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use File;

use CategoryHelper;

use Illuminate\Support\Facades\DB;

use Auth;

class AdminProductController extends Controller
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
        //
        $user = Auth::user();
        $products = Product::orderby('id', 'asc')->paginate(10);

        return view('admin.product.show', compact('user', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $all_parents = CategoryHelper::get_all_category_by_order();

        $option_parent = array();
        $option_parent[0] = 'None';

        if ($all_parents) {
            foreach ($all_parents as $parent) {
                $option_parent[$parent->id] = str_repeat('-', $parent->level).' '.$parent->title;
            }
        }

        return view('admin.product.create', compact('user', 'option_parent'));
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

        $product = new Product();
        $product->title = $request['title'];
        $product->desc = $request['desc'] ? $request['desc'] : '';
        $product->price = $request['price'] ? $request['price'] : 0;
        $product->image = $request['image'] ? $request['image'] : '';
        $product->cat_id = $request['parent_id'] ? $request['parent_id'] : 0;

        $product->save();

        if ($request->photos) {
            foreach ($request->photos as $photo) {

                $folder = 'upload/product/'.$product->id;

                $url = $photo->move($folder,$photo->getClientOriginalName());

                $product_photo = new ProductPhoto();

                $product_photo->title = $photo->getClientOriginalName();

                $product_photo->product_id = $product->id;

                $product_photo->url = $url;

                $product_photo->save();

            }
        }

        if ($request->input('close', 0) == 1) {
            return redirect()->route('product.index',
                $product->id)->with('flash_message',
                'Product '. $product->title.' updated');
        }

        return redirect()->route('product.edit',
            $product->id)->with('flash_message',
            'Product '. $product->title.' updated');
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
        return redirect()->route('product.index')
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
        $product = Product::findOrFail($id);

        $all_parents = CategoryHelper::get_all_category_by_order();

        $option_parent = array();
        $option_parent[0] = 'None';

        if ($all_parents) {
            foreach ($all_parents as $parent) {
                $option_parent[$parent->id] = str_repeat('-', $parent->level).' '.$parent->title;
            }
        }

        return view('admin.product.edit', compact('product', 'option_parent'));
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

        $product = Product::findOrFail($id);
        $product->title = $request->input('title');
        $product->desc = $request->input('desc') ? $request->input('desc') : '';
        $product->price = $request->input('price') ? $request->input('price') : 0;
        $product->image = $request->input('image');
        $product->cat_id = $request->input('parent_id') ? $request->input('parent_id') : 0;
        $product->save();

       if($request->photos) {
           foreach ($request->photos as $photo) {

               $folder = 'upload/product/'.$product->id;

               $url = $photo->move($folder,$photo->getClientOriginalName());

               $product_photo = new ProductPhoto();

               $product_photo->title = $photo->getClientOriginalName();

               $product_photo->product_id = $product->id;

               $product_photo->url = $url;

               $product_photo->save();

           }
       }

       if ($request->photo_id) {
           foreach ($request->photo_id as $photo_id) {

               $photo = ProductPhoto::findOrFail($photo_id);

               File::delete(public_path().'/'.$photo->url);

               $photo->delete();
           }
       }

       if ($request->input('close', 0) == 1) {
           return redirect()->route('product.index',
               $product->id)->with('flash_message',
               'Product '. $product->title.' updated');
       }

        return redirect()->route('product.edit',
            $product->id)->with('flash_message',
            'Product '. $product->title.' updated');
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
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')
            ->with('flash_message',
                'Product deleted!');
    }
}
