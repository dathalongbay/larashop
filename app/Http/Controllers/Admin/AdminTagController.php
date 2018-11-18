<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Auth;

class AdminTagController extends Controller
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
        $tags = Tag::orderby('id', 'asc')->paginate(10);

        return view('admin.tag.show', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('admin.tag.create', array());
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

        $tag = new Tag();
        $tag->title = $request['title'];
        $tag->desc = $request['desc'] ? $request['desc'] : '';

        $tag->save();

        return redirect()->route('tag.index')
            ->with('flash_message', 'Tag,
             '. $tag->title.' created');
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

        return redirect()->route('tag.index')
            ->with('flash_message',
                'Tag added!');
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
        $tag = Tag::findOrFail($id);

        return view('admin.tag.edit', compact('tag'));
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

        $tag = Tag::findOrFail($id);
        $tag->title = $request->input('title');
        $tag->desc = $request->input('desc');
        $tag->save();

        return redirect()->route('tag.index',
            $tag->id)->with('flash_message',
            'Tag, '. $tag->title.' updated');
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
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tag.index')
            ->with('flash_message',
                'Tag deleted!');
    }
}
