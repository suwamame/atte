<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stamp;
use App\Http\Controllers\AuthenticatedSessionController;


class StampController extends Controller
{
    public function create()
    {
        if (!auth()->check()) {
        return redirect('/login');
    }
        return view('stamp');
    }
}
