<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function user()
    {
        return view("user.welcome");
    }

    public function admin()
    {
        return view("admin.index");
    }
}
