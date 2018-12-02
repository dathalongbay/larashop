<?php

namespace App\Http\Controllers\Admin;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Auth;

class AdminMediaController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.media.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('admin.media.create', array());
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

        $media = new Media();
        $media->title = $request['title'];
        $media->except = $request['except'] ? $request['except'] : '';
        $media->body = $request['body'] ? $request['body'] : '';

        $media->save();

        return redirect()->route('media.index')
            ->with('flash_message', 'Article,
             '. $media->title.' created');
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

        return redirect()->route('media.index')
            ->with('flash_message',
                'Media added!');
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
        $media = Media::findOrFail($id);

        return view('admin.media.edit', compact('media'));
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

        $media = Media::findOrFail($id);
        $media->title = $request->input('title');
        $media->body = $request->input('body');
        $media->save();

        return redirect()->route('media.index',
            $media->id)->with('flash_message',
            'Article, '. $media->title.' updated');
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
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->route('media.index')
            ->with('flash_message',
                'Media deleted!');
    }
}
