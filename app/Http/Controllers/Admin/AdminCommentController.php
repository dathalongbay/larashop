<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Auth;

class AdminCommentController extends Controller
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
        $comments = Comment::orderby('id', 'asc')->paginate(10);


        return view('admin.comment.show', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('admin.comment.create', array());
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

        $comment = new Comment();
        $comment->title = $request['title'];
        $comment->desc = $request['desc'] ? $request['desc'] : '';
        $comment->parent_id = 0;
        $comment->level = 0;

        $comment->save();

        return redirect()->route('comment.index')
            ->with('flash_message', 'Comment,
             '. $comment->title.' created');
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

        return redirect()->route('comment.index')
            ->with('flash_message',
                'Comment added!');
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
        $comment = Comment::findOrFail($id);

        return view('admin.comment.edit', compact('comment'));
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

        $comment = Comment::findOrFail($id);

        $comment->title = $request['title'];
        $comment->desc = $request['desc'] ? $request['desc'] : '';
        $comment->parent_id = 0;
        $comment->level = 0;
        $comment->save();

        return redirect()->route('comment.index',
            $comment->id)->with('flash_message',
            'Article, '. $comment->title.' updated');
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
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comment.index')
            ->with('flash_message',
                'Comment deleted!');
    }
}
