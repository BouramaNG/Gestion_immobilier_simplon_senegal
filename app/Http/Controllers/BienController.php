<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BienController extends Controller
{
    public function AjoutBien()
    {
        return view("admin.ajoutbien");
    }

    public function ListeBien()
    {
return view("admin.listebien");
    }
}
