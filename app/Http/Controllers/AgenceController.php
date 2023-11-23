<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgenceController extends Controller
{
    public function AgenceDashboard()
    {
        return view("agence.agencedashboard");
    }
}
