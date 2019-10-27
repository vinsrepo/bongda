<?php

namespace App\Http\Controllers\Frontend;

// use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Models\PlayerList;
use App\Models\ResultList;
use App\Models\TeamFootball;
use App\Models\ResultDetail;
use Illuminate\Http\Request;

class ResultDetailController extends Controller
{
    /**
     * Display a listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailMatch(Request $request)
    {
        $data = $note = '';
        // dd($request->all());
        if ($request->type == 1) {
            $type = 1;
            $note = 'Cầu thủ số '.$request->player_id.' ghi bàn';
        } elseif ($request->type == 2) {
            $type = 2;
            $note = 'Cầu thủ số '.$request->player_id.' bị thẻ vàng';
        } elseif ($request->type == 3) {
            $type = 3;
            $note = 'Cầu thủ số '.$request->player_id.' bị thẻ đỏ';
        }

        $input = [
            'action' => $type,
            'time_takes_place' => $request->time_live,
            'player_id' => $request->player_id,
            'match_id' => $request->match_id,
            'note' => $note,
        ];

        $data = new ResultDetail($input);
        $data->save();

        return $data;
    }
}
