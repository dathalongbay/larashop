<?php

namespace App\Http\Controllers\Admin;

use App\Newsletter;
use App\BannerImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use File;
use Auth;

class AdminNewsletterController extends Controller
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
        $newsletters = Newsletter::orderby('id', 'asc')->paginate(10);

        $user = Auth::user();

        return view('admin.newsletter.show', compact('newsletters', 'user'));
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
        $newsletter = Newsletter::findOrFail($id);

        return view('admin.newsletter.edit', compact('newsletter', 'user'));
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

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->email = $request->input('email');

        $newsletter->save();

        return redirect()->route('newsletter.index',
            $newsletter->id)->with('flash_message',
            'Newsletter '. $newsletter->title.' updated');
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
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        return redirect()->route('newsletter.index')
            ->with('flash_message',
                'Newsletter deleted!');
    }
}
