<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StationsController extends Controller
{
    public function index(Request $request) {
    	return Inertia::render('Stations', [
    		'stations' => Station::all()
	    ]);
    }
}
