<?php
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 4/30/2017
 * Time: 10:58 AM
 */

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class CartController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $items = [];

            \Cart::getContent()->each(function($item) use (&$items)
            {
                $items[] = $item;
            });

            return response(array(
                'success' => true,
                'data' => $items,
                'message' => 'cart get items success'
            ),200,[]);
        }
        else
        {
            return view('cart');
        }
    }


    public function update() {


        $id = request('id');
        $qty = request('quantity') ? request('quantity') : 1;

        $product = Product::findOrFail($id);

        $name = $product->title;
        $price = $product->price;

        \Cart::update($id, array(
            'quantity' => $qty, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
        ));

        $items = [];

        \Cart::getContent()->each(function($item) use (&$items)
        {
            $items[] = $item;
        });

        return response(array(
            'success' => true,
            'data' => $items,
            'total_quantity' => \Cart::getTotalQuantity(),
            'sub_total' => \Cart::getSubTotal(),
            'total' => \Cart::getTotal(),
            'message' => 'cart get items success'
        ),200,[]);

        exit;
    }


    public function add()
    {

        $id = request('id');
        $qty = request('quality') ? request('quality') : 1;

        $product = Product::findOrFail($id);

        $name = $product->title;
        $price = $product->price;

        \Cart::add($id, $name, $price, $qty, array());

        $items = [];

        \Cart::getContent()->each(function($item) use (&$items)
        {
            $items[] = $item;
        });

        return response(array(
            'success' => true,
            'data' => $items,
            'total_quantity' => \Cart::getTotalQuantity(),
            'sub_total' => \Cart::getSubTotal(),
            'total' => \Cart::getTotal(),
            'message' => 'cart get items success'
        ),200,[]);

        exit;
    }

    public function delete()
    {

        $id = request('id');
        \Cart::remove($id);

        return response(array(
            'success' => true,
            'data' => $id,
            'total_quantity' => \Cart::getTotalQuantity(),
            'sub_total' => \Cart::getSubTotal(),
            'total' => \Cart::getTotal(),
            'message' => "cart item {$id} removed."
        ),200,[]);
    }

    public function clear() {

        \Cart::clear();

        return redirect()->route('home');
    }

    public function details()
    {
        return response(array(
            'success' => true,
            'data' => array(
                'total_quantity' => \Cart::getTotalQuantity(),
                'sub_total' => \Cart::getSubTotal(),
                'total' => \Cart::getTotal(),
            ),
            'message' => "Get cart details success."
        ),200,[]);
    }
}