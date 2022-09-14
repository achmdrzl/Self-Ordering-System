<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:manager'])->only('cek');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // $locationData = Location::get('https://' . $request->ip()); // https or http according to your necessary.

        // return view('welcome', compact('locationData'));
        $location = Location::get();

        return view('employee.dashboard', compact('location'));
    }

    public function cek(){
        return view('employee.foodData');
    }
}
