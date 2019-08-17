<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
	    return Inertia::render('Dashboard', [
		    'user' => User::first()->get(),
	    ]);
    }
}
