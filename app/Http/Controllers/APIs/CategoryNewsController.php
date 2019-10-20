<?php

namespace App\Http\Controllers\APIs;

use App\Constants\CategoryNewsConstant;
use App\Constants\NewsConstant;
use App\Constants\Setting;
use App\Constants\StatusCode;
use App\Http\Resources\CategoryNewsResource;
use App\Http\Resources\NewsResource;
use App\Models\CategoryNews;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = CategoryNews::where('status', CategoryNewsConstant::ACTIVE)->get();

        return response()->json([
            'code'    => StatusCode::OK,
            'message' => __('messages.register_successful'),
            'data'    => [
                'category'  => CategoryNewsResource::collection($category),
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
        //
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

    /**
     * Display a listing news of category.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function listNewsOfCategory(Request $request, $id)
    {
        $limit  = $request->input('limit') ? $request->input('limit') : Setting::DEFAULT_PAGINATE;
        $offset = $request->input('page') ? $request->input('page') * $limit : Setting::DEFAULT_OFFSET;
        $category = CategoryNews::find($id);
        if (!$category) {
            return response()->json([
                'code'    => StatusCode::NOT_FOUND,
                'message' => __('messages.category_news_not_found'),
            ]);
        }

        $news = News::where('status', NewsConstant::ACTIVE)
            ->where('category_id', $id)
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'code'    => StatusCode::OK,
            'message' => __('messages.successful'),
            'data'    => [
                'news'  => NewsResource::collection($news),
            ],
        ]);
    }
}
