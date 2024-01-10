<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StampController extends Controller
{
    public function create()
    {
        return view('stamp');
    }
}
