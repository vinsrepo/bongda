<?php

namespace App\Http\Controllers\APIs;

use App\Constants\PostConstant;
use App\Constants\Setting;
use App\Constants\UserSetting;
use App\Constants\PaginateSetting;
use App\Constants\StatusCode;
use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banks = Bank::orderBy('created_at', 'desc')->where('status', Setting::ACTIVE)->get();
        if (!$banks) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => __('system.no_data')
            ]);
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('system.list_data'),
            'data' => $banks
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bankDetail = Bank::find($id);
        if (!$bankDetail) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => __('system.no_data')
            ]);
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('system.list_data'),
            'data' => $bankDetail
        ]);
    }
}
