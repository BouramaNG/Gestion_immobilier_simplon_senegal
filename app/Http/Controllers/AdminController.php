<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function adminDashboard()
   {
      // dd('test');
    return view("admin.body");
   }
}
