<?php

namespace App\Http\Controllers\Frontend;

// use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Models\PlayerList;
use App\Models\ResultList;
use App\Models\TeamFootball;
use App\Models\ResultDetail;
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
        $data = [];
        $teamA = TeamFootball::find(1);
        $teamB = TeamFootball::find(2);
        $data['playerListA'] = PlayerList::where('team', $teamA->id)->get();
        $data['playerListB'] = PlayerList::where('team', $teamB->id)->get();
        $data['resultList'] = ResultList::all();
        $data['teamFootball'] = TeamFootball::all();
        $data['ResultDetail'] = ResultDetail::orderBy('id', 'desc')->where('match_id', 1)->get();

        return view('frontend.pages.home.index', compact('data', 'teamA', 'teamB'));
    }
}
