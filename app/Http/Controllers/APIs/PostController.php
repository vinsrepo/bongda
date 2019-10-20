<?php

namespace App\Http\Controllers\APIs;

use App\Constants\PostConstant;
use App\Constants\Setting;
use App\Constants\PaginateSetting;
use App\Constants\StatusCode;
use App\Http\Resources\PostResource;
use App\Models\Favorite;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') ? $request->input('limit') : PaginateSetting::DEFAULT_PAGINATE;
        $offset = $request->input('page') ? $request->input('page') * $limit : PaginateSetting::DEFAULT_OFFSET;

        $posts = Posts::orderBy('created_at', 'desc')->where('status', PostConstant::ACTIVE)
            ->offset($offset)->limit($limit)->get();

        foreach ($posts as $item) {
            $item->images = null;
            if ($item->image) {
                $imageTmp = $item->image[0];
                $item->images = $imageTmp;
            }
            $item->comment = count(Comment::where('post_id', $item->id)->get());
            $item->favorite = count(Favorite::where('post_id', $item->id)->get());
            $item->customer = User::select('name', 'avatar')->where('id', $item->customer_id)->first();
            unset($item->image, $item->content, $item->deleted_at);
            $arrPosts[] = $item;
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('messages.successful'),
            'data' => [
                'posts' => $arrPosts,
//                'posts'  => PostResource::collection($posts),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();
        $required = [
            'title' => ['required', 'string', 'max:255']
        ];
        $validator = Validator::make($request->all(), $required);
        if ($validator->fails()) {
            return response()->json([
                'code' => StatusCode::UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()->first(),
            ]);
        }

        $postTmp = Posts::create([
            'title' => $request['title'],
            'author_id' => $user->id,
            'status' => PostConstant::PENDING,
            'author_type' => 2,
            'avatar' => $request['avatar'],
            'images' => $request['images'],
            'videos' => $request['videos'],
            'description' => $request['description'],
            'content' => $request['content'],
        ]);
//        $post_follow = PostsFollow::create([
//            'posts_id' => $postTmp->id,
//            'user_id' => $user->id,
//        ]);
//        if ($user->id != $categoryTmp->user_id) {
//            //        ban thong bao
//            $message = $user->name . ' đã tạo bài viết trong danh mục ' . $categoryTmp->title;
//            $message_en = $user->name . ' created the article in the category ' . $categoryTmp->title;
//            $notification = HistoryNotification::create([
//                'receiver_id' => $categoryTmp->user_id,
//                'sender_id' => $user->id,
//                'content' => $message,
//                'content_en' => $message_en,
//                'status' => 0,
//                'category_id' => $request->category_id,
//                'type_notif' => ResponseStatusOnsignal::CREATED_POSTS,
//            ]);
//            $responsive = [
//                'code' => ResponseStatusOnsignal::CREATED_POSTS,
//                'category_id' => $request->category_id ? $request->category_id : null,
//                'user_send' => $user->id,
//                'notification_id' => $notification->id,
//            ];
////            Functions::notification($message, $categoryTmp->user_id, $responsive);
////            thong bao cho nhung nguoi follow danh muc
//            $list_follow = CategoryFollow::where('category_id', $request->category_id)->get();
//            if (count($list_follow)) {
//                foreach ($list_follow as $value) {
//                    if ($value->user_id != $user->id) {
//                        $category_user_language = User::find($value->user_id)->language;
//                        if (!$category_user_language || $category_user_language == 'en') {
//                            Functions::notification($message_en, $value->user_id, $responsive);
//                        } else {
//                            Functions::notification($message, $value->user_id, $responsive);
//                        }
//                    }
//                }
//            }
////        end ban thong bao
//        }
        if ($postTmp) {
            return response()->json([
                'code' => StatusCode::OK,
                'message' => __('post.create_post_success'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Posts::where('id', $id)->first();
        $posts->comment = count(Comment::where('post_id', $posts->id)->get());
        $posts->show_comments = Comment::select('customer_id', 'comment')
            ->where('post_id', $posts->id)->take(5)->get();
        $posts->favorite = count(Favorite::where('post_id', $posts->id)->get());
        $posts->customer = User::select('name', 'avatar')->where('id', $id)->first();

        if ($posts) {
            return response()->json([
//                'code'    => ResponseStatusCode::OK,
//                'message' => MessageResponseStatus::GET_SUCCESSFUL,
                'data' => [
                    'posts' => $posts,
//                'posts'  => PostResource::collection($posts),
                ],
            ]);
        }
        return response()->json([
            'code' => ResponseStatusCode::NOT_FOUND,
            'message' => MessageResponseStatus::NOT_FOUND,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth('api')->user();
        $required = [
            'title' => ['required', 'string', 'max:255']
        ];
        $validator = Validator::make($request->all(), $required);
        if ($validator->fails()) {
            return response()->json([
                'code' => StatusCode::UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()->first(),
            ]);
        }
//        dd($request->content, $request['content']);
        $post = Posts::find($id);
        $post->title = $request['title'];
        $post->author_id = $user->id;
        $post->status = PostConstant::PENDING;
        $post->author_type = 2;
        $post->avatar = $request['avatar'];
        $post->images = $request['images'];
        $post->videos = $request['videos'];
        $post->description = $request['description'];
        $post->content = $request['content'];
        $post->save();

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('post.update_post_success'),
            'data' => $post,
        ]);
    }


    /**
     * list Post Favorite
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function actionPostFavorite(Request $request)
    {
        $user = auth('api')->user();
        $post = Posts::find($request->id);
        if (!$post) {
            return response()->json([
                'code' => StatusCode::NOT_FOUND,
                'message' => __('post.post_not_exists'),
            ]);
        }
        $post_likes = Favorite::where('post_id', $request->id)->where('customer_id', $user->id)->first();
        if (!$post_likes) {
            Favorite::create([
                'post_id' => $request->id,
                'customer_id' => $user->id,
                'status' => Setting::ACTIVE,
            ]);
        } else {
            $post_likes->delete();
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('system.success'),
        ]);
    }

    /**
     * list Post Favorite
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function listPostFavorite()
    {
        $user = auth('api')->user();
        $post_favorite = Posts::select('avatar', 'description', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc')
            ->whereHas('getPostFollow', function ($query) use ($user) {
                $query->where('customer_id', $user->id)->where('status', Setting::ACTIVE);
            })->get();

        foreach ($post_favorite as $key => $item) {
            $item->author_name = @$item->getAuthor->name;
            unset($item->getAuthor);
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('system.list_data'),
            'data' => $post_favorite
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
