<?php

namespace App\Http\Controllers;


use App\Person;
use App\PersonInfo;
use App\Compaign;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = PersonInfo::orderBy('id', 'desc')->paginate(10);
        $compaigns=Compaign::orderBy('id')->paginate(4);

        return view('home', compact('people','compaigns'));
    }
}
