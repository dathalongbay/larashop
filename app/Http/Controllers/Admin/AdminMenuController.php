<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Auth;

class AdminMenuController extends Controller
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

        $menus = Menu::orderby('id', 'asc')->paginate(10);

        return view('admin.menus.show', compact('menus', 'user'));
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

        $option_location = array();
        $option_location[0] = 'None';
        $option_location[1] = 'Header';
        $option_location[2] = 'Footer';

        return view('admin.menus.create', compact('option_location', 'user'));
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

        $menu = new Menu();
        $menu->title = $request['title'];
        $menu->desc = $request['description'] ? $request['description'] : '';
        $menu->location = $request['location'] ? $request['location'] : 0;

        Menu::where('location', $menu->location)
            ->update(['location' => 0]);

        $menu->save();

        return redirect()->route('menus.index')
            ->with('flash_message', 'Article,
             '. $menu->title.' created');
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

        return redirect()->route('menu.index')
            ->with('flash_message',
                'Menu added!');
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
        $menu = Menu::findOrFail($id);

        $option_location = array();
        $option_location[0] = 'None';
        $option_location[1] = 'Header';
        $option_location[2] = 'Footer';

        $user = Auth::user();

        return view('admin.menus.edit', compact('menu', 'option_location', 'user'));
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

        $menu = Menu::findOrFail($id);
        $menu->title = $request->input('title');
        $menu->desc = $request->input('desc');
        $menu->location = $request->input('location') ? $request->input('location') : 0;

        Menu::where('location', $menu->location)
            ->update(['location' => 0]);

        $menu->save();

        return redirect()->route('menus.index',
            $menu->id)->with('flash_message',
            'Article, '. $menu->title.' updated');
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
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menus.index')
            ->with('flash_message',
                'Menu deleted!');
    }
}
