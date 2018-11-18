<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'clearance']);
    }

    public function index() {

        $user = Auth::user();

        return view('admin.dashboard.dashboard', compact('user'));
    }
}
