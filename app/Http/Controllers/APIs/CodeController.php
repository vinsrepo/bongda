<?php

namespace App\Http\Controllers\APIs;

use App\Constants\PostConstant;
use App\Constants\Setting;
use App\Constants\UserSetting;
use App\Constants\PaginateSetting;
use App\Constants\StatusCode;
use App\Models\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $codes = Code::orderBy('created_at', 'desc')->get();
        if (!$codes) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => "Không có dữ liệu của mã code"
            ]);
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => "Lấy dữ liệu thành công",
            'data' => $codes
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getCode(Request $request)
    {
        $code_id = $request->code_id;
        if (isset($code_id)) {
            $check_code = Code::where('code', $code_id)->first();
            if (isset($check_code)) {
                if ($check_code->status == UserSetting::ENABLE) {
                    // if (strtotime($check_code->time_expired) > time()) {
                        $check_code->status = UserSetting::DISABLE;
                        $check_code->phone = $request->phone;
                        $check_code->save();
                        return response()->json([
                            'code' => StatusCode::OK,
                            'message' => "Nhập mã code thành công",
                            'data' => $check_code
                        ]);
                    // } else {
                    //     $check_code->status = UserSetting::EXPIRED;
                    //     $check_code->phone = $request->phone;
                    //     $check_code->save();
                    //     return response()->json([
                    //         'code' => StatusCode::FORBIDDEN,
                    //         'message' => "Mã code này hết hạn",
                    //         'data' => $check_code
                    //     ]);
                    // }
                } else {
                    return response()->json([
                        'code' => StatusCode::FORBIDDEN,
                        'message' => "Mã code này đã được sử dụng",
                        'data' => $check_code
                    ]);
                }
            } else {
                return response()->json([
                    'code' => StatusCode::NOT_FOUND,
                    'message' => "Không tìm thấy mã code này",
                ]);
            }
        }
    }

    public static function listCodeStatus() {
        $codes = Code::orderBy('created_at', 'desc')->where('status', UserSetting::ENABLE)->get();
        if (!$codes) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => "Không có dữ liệu của mã code"
            ]);
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => "Lấy dữ liệu thành công",
            'data' => $codes
        ]);
    }

    public static function insertCodeByNumber(Request $request) {
        $num = $request->num;

        if (!$num) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => "Bạn phải nhập số lượng code muốn thêm"
            ]);
        }
        if ($num < 5) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => "Nhập tối thiểu 5 mã code"
            ]);
        } 
        if ($num > 50) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => "Nhập tối đa 50 mã code"
            ]);
        }
        $arrs = [];
        $arr = [];
        $date = date('Y-m-d H:i:s');
        $date_time_ex = date("Y-m-d H:i:s", strtotime("+1 week"));
        $code_new = Code::orderBy('id', 'desc')->first();
        $code = $code_new->code;
        
        for ($i = 1; $i <= $num; $i++) {
            $arr = [
                'code' => $code + $i,
                'status' => UserSetting::ENABLE,
                'time_expired' => $date_time_ex,
                'phone' => '0988741155',
                'args' => '',
                'created_at' => $date,
            ];
            $arrs[] = $arr;
        }
        $insertCode = \DB::table('activation_code')->insert($arrs);
        if ($insertCode != true) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => "Lỗi vui lòng thử lại sau"
            ]);
        }

        $codes = Code::orderBy('id', 'desc')->take($num)->get();

        return response()->json([
            'code' => StatusCode::OK,
            'message' => "Lấy dữ liệu thành công",
            'data' => $codes
        ]);
    }
}
