<?php

namespace App\Http\Controllers\Frontend;

// use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Models\PlayerList;
use App\Models\ResultList;
use App\Models\TeamFootball;
use Illuminate\Http\Request;

class ResultDetailController extends Controller
{
    /**
     * Display a listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailMatch()
    {
        $data = [];
        dd($data);
        $teamA = TeamFootball::find(1);
        $teamB = TeamFootball::find(2);
        $data['playerListA'] = PlayerList::where('team', $teamA->id)->get();
        $data['playerListB'] = PlayerList::where('team', $teamB->id)->get();
        $data['resultList'] = ResultList::all();
        $data['teamFootball'] = TeamFootball::all();

        return view('frontend.pages.home.index', compact('data'));
    }
}