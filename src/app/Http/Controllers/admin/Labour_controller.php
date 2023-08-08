<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Labour_controller extends Controller
{
    public function index()
    {       
        return view('admin/labours',['user_role'=>1]);
    }
}
