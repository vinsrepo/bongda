<?php

namespace App\Http\Controllers\APIs;

use App\Constants\NewsConstant;
use App\Constants\Setting;
use App\Constants\StatusCode;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit  = $request->input('limit') ? $request->input('limit') : Setting::DEFAULT_PAGINATE;
        $offset = $request->input('page') ? $request->input('page') * $limit : Setting::DEFAULT_OFFSET;

        $news = News::where('status', NewsConstant::ACTIVE)->offset($offset)->limit($limit)->get();

        return response()->json([
            'code'    => StatusCode::OK,
            'message' => __('messages.successful'),
            'data'    => [
                'news'  => NewsResource::collection($news),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        if ($news) {
            return response()->json([
                'code'    => StatusCode::OK,
                'message' => __('messages.successful'),
                'data'    => [
                    'news'  => new NewsResource($news, true)
                ],
            ]);
        }

        return response()->json([
            'code'    => StatusCode::NOT_FOUND,
            'message' => __('messages.news_not_found'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
