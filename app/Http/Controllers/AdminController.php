<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;

use App\Admin;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function profile() {
        $user = Auth::user();

        return view('admin.dashboard.profile', compact('user'));
    }


    public function profileUpdate(Request $request, $id)
    {
        $user = Admin::findOrFail($id);

        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:admins,email,'.$id,
            'password'=>'required|min:6|confirmed',
            'avatar' => 'required'
        ]);

        $input = $request->only(['name', 'email', 'password', 'avatar']);
        $user->fill($input)->save();

        return redirect()->route('admin.profile')
            ->with('flash_message',
                'User successfully edited.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        return view('admin.dashboard.dashboard', compact('user'));
    }
}