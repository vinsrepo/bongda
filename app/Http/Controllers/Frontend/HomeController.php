<?php

namespace App\Http\Controllers\Frontend;

// use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Models\Body;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = '';

        return view('frontend.pages.home.index', compact('data'));
    }
}
