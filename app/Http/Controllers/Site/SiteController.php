<?php

namespace App\Http\Controllers\Site;

use App\Banner;
use App\Page;
use App\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\ProductCategory;
use App\Order;
use App\OrderDetail;

use App\Post;
use Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use CategoryHelper;

class SiteController extends Controller
{

    public function search(Request $request) {

        $search_value = isset($request['search_value']) ? $request['search_value'] : '';

        return redirect()->route('site.search-result', array('keyword' => $search_value));
    }


    public function searchPage($keyword) {


        $products = Product::where('title', 'like', '%' . $keyword . '%')->orderby('id', 'asc')->paginate(16);

        $cat_list = CategoryHelper::get_all_category_by_order();

        $banners = Banner::where('location', 1)->get();

        if (isset($banners[0])){
            $banner = $banners[0];
        } else {
            $banner = Banner::find('location', 1);
        }

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        return view('site.search_page', compact('keyword', 'products', 'banner', 'total_quantity', 'total', 'setting', 'cat_list'));
    }


    public function __construct()
    {
        //$this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $cat_list = CategoryHelper::get_all_category_by_order();

                $banners = Banner::where('location', 1)->get();

                if (isset($banners[0])){
                    $banner = $banners[0];
                } else {
                    $banner = Banner::find('location', 1);
                }

                $banners2 = Banner::where('location', 2)->get();

                if (isset($banners2[0])){
                    $banner2 = $banners2[0];
                } else {
                    $banner2 = Banner::find('location', 1);
                }

                        $products = Product::orderby('id', 'asc')->paginate(16);

                        $total_quantity = \Cart::getTotalQuantity();
                        $sub_total = \Cart::getSubTotal();
                        $total = \Cart::getTotal();

                        $settings = DB::table('settings')->get();
                        $setting = array();

                        foreach ($settings as $item) {
                            $setting[$item->name] = $item->value;
                        }

        return view('site.home', compact('products', 'banner', 'banner2', 'total_quantity', 'total', 'setting', 'cat_list'));
    }

    public function showCategory($id)
    {
        $cat_list = CategoryHelper::get_all_category_by_order();

        $category = ProductCategory::findOrFail($id);

        $products = DB::table('products')->where('cat_id', $id)->paginate(10);

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        return view('site.category.category', compact('setting', 'category', 'products', 'total_quantity', 'sub_total', 'total', 'cat_list'));
    }


    public function showProduct($id)
    {
        $product = Product::findOrFail($id);

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        return view('site.product.product', compact('product', 'setting', 'total_quantity', 'sub_total', 'total'));
    }

    public function showPage($id)
    {
        $page = Page::findOrFail($id);

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        return view('site.page.page', compact('page', 'setting', 'total_quantity', 'sub_total', 'total'));
    }

    public function showCart()
    {
        $items = array();

        \Cart::getContent()->each(function($item) use (&$items)
        {
            $product = Product::findOrFail($item->id);
            $item->image = $product->image;
            $items[] = $item;
        });

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        return view('site.cart.checkout', compact('items', 'total_quantity', 'sub_total', 'total', 'setting'));
    }


    public function checkout() {

        $items = array();

        \Cart::getContent()->each(function($item) use (&$items)
        {
            $product = Product::findOrFail($item->id);
            $item->image = $product->image;
            $items[] = $item;
        });

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        return view('site.checkout.checkout', compact('items', 'total_quantity', 'sub_total', 'total', 'setting'));
    }

    public function completed() {

        $items = array();

        \Cart::getContent()->each(function($item) use (&$items)
        {
            $product = Product::findOrFail($item->id);
            $item->image = $product->image;
            $items[] = $item;
        });

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        return view('site.checkout.completed', compact('items', 'total_quantity', 'sub_total', 'total', 'setting'));
    }



    public function checkout_submit(Request $request)
    {

        // Validate the form data
        $this->validate($request, [
            'phone'   => 'required',
            'address' => 'required',
            'description' => 'required'
        ]);

        if (Auth::check()) {

            // Insert order to database

            $items = array();

            \Cart::getContent()->each(function($item) use (&$items)
            {
                $items[] = $item;
            });

            $price = \Cart::getTotal();

            $order = new Order();
            $order->user_id = Auth::id();
            $order->status = 1;
            $order->address = $request['address'];
            $order->phone = $request['phone'];
            $order->description = $request['description'];
            $order->price = $price;

            if ($order->save()){

                if ($items) {
                    foreach ($items as $item) {
                        $order_detail = new OrderDetail();
                        $order_detail->order_id = $order->id;
                        $order_detail->product_id = $item->id;
                        $order_detail->quanlity = $item->quantity;
                        $order_detail->price = $item->price;
                        $order_detail->description = $item->name;
                        $order_detail->save();
                    }
                }


                \Cart::clear();
            }

            return redirect()->route('completed');
        } else {
            // if unsuccessful, then redirect back to the login with the form data
            return redirect()->back()->withInput($request->only('phone', 'address', 'description'));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('phone', 'address', 'description'));
    }



    public function contact()
    {
        return view('site.contact.contact', array());
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required',
            ]);

        $title = $request['title'];
        $body = $request['body'];

        $post = Post::create($request->only('title', 'body'));

        return redirect()->route('posts.index')
            ->with('flash_message', 'Article,
             '. $post->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view ('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
            'body'=>'required',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect()->route('posts.show', 
            $post->id)->with('flash_message', 
            'Article, '. $post->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('flash_message',
             'Article successfully deleted');
    }


    public function newsletter(Request $request) {

        $newsletter = new Newsletter();

        $this->validate($request, [
            'email'=>'required|email|unique:newsletters,email',
        ]);

        $input = $request->only(['email']);

        $newsletter->email = $input['email'];
        $newsletter->save();

        return redirect()->route('site.thank_newsletter')
            ->with('flash_message',
                'Subscriber successfully');

    }

    public function thankNewsletter() {

        \Cart::getContent()->each(function($item) use (&$items)
        {
            $product = Product::findOrFail($item->id);
            $item->image = $product->image;
            $items[] = $item;
        });

        $banner = Banner::findOrFail(1);

        $total_quantity = \Cart::getTotalQuantity();
        $sub_total = \Cart::getSubTotal();
        $total = \Cart::getTotal();

        $settings = DB::table('settings')->get();
        $setting = array();

        foreach ($settings as $item) {
            $setting[$item->name] = $item->value;
        }

        return view('site.thank_you', compact('total_quantity', 'total', 'banner', 'setting'));
    }


}
