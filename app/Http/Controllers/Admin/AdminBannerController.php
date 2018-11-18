<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\BannerImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use File;
use Auth;

class AdminBannerController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $banners = Banner::orderby('id', 'asc')->paginate(10);

        $user = Auth::user();

        return view('admin.banner.show', compact('banners', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $option_location = array();
        $option_location[0] = 'None';
        $option_location[1] = 'Slider';
        $option_location[2] = 'Center page';

        $user = Auth::user();

        return view('admin.banner.create', compact('option_location', 'user'));
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

        $banner->location = $request->input('location') ? $request->input('location') : 0;

        Banner::where('location', $banner->location)
            ->update(['location' => 0]);

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
        $user = Auth::user();
        $banner = Banner::findOrFail($id);

        $option_location = array();
        $option_location[0] = 'None';
        $option_location[1] = 'Slider';
        $option_location[2] = 'Center page';

        return view('admin.banner.edit', compact('banner', 'option_location', 'user'));
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

        $banner->location = $request->input('location') ? $request->input('location') : 0;

        Banner::where('location', $banner->location)
            ->update(['location' => 0]);

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
