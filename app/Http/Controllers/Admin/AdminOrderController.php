<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use File;
use Auth;

class AdminOrderController extends Controller
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
        $orders = Order::orderby('id', 'asc')->paginate(10);

        $user = Auth::user();

        return view('admin.order.show', compact('orders', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();

        //
        return view('admin.order.create', compact('user'));
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

        $banner = new Banner();
        $banner->title = $request['title'];
        $banner->except = $request['except'] ? $request['except'] : '';
        $banner->body = $request['body'] ? $request['body'] : '';

        $banner->save();

        if ($request->photos) {
            foreach ($request->photos as $photo) {

                $folder = 'upload/banner/'.$banner->id;

                $url = $photo->move($folder,$photo->getClientOriginalName());

                $banner_image = new BannerImage();

                $banner_image->title = $photo->getClientOriginalName();

                $banner_image->banner_id = $banner->id;

                $banner_image->url = $url;

                $banner_image->save();

            }
        }

        return redirect()->route('banner.index')
            ->with('flash_message', 'Article,
             '. $banner->title.' created');
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

        return redirect()->route('banner.index')
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
        $order = Order::find($id);

        $products = $order->products;

        $user = Auth::user();

        return view('admin.order.edit', compact('order', 'products', 'user'));
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

        $banner = Banner::findOrFail($id);
        $banner->title = $request->input('title');
        $banner->body = $request->input('body');
        $banner->save();

        if($request->photos) {
            foreach ($request->photos as $photo) {

                $folder = 'upload/product/'.$banner->id;

                $url = $photo->move($folder,$photo->getClientOriginalName());

                $banner_image = new BannerImage();

                $banner_image->title = $photo->getClientOriginalName();

                $banner_image->banner_id = $banner->id;

                $banner_image->url = $url;

                $banner_image->save();

            }
        }

        if ($request->photo_id) {
            foreach ($request->photo_id as $photo_id) {

                $photo = BannerImage::findOrFail($photo_id);

                File::delete(public_path().'/'.$photo->url);

                $photo->delete();
            }
        }

        return redirect()->route('banner.index',
            $banner->id)->with('flash_message',
            'Article, '. $banner->title.' updated');
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
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('banner.index')
            ->with('flash_message',
                'Banner deleted!');
    }
}
