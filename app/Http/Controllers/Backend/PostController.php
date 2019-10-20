<?php

namespace App\Http\Controllers\Backend;

use App\Constants\Setting;
use App\Constants\UserContants;
use App\Constants\PaginateSetting;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\UserConstants;
// use App\Constants\UserSetting;
use App\Http\Requests\CreateUser;
use App\Services\Posts\PostService;
use App\Models\Location;
use Excel;
use Auth;

class PostController extends Controller
{
    /**
     * @var userService
     */
    private $postService;

    /**
     * UserService constructor.
     *
     * @param userService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataSearch = [];
        $dataSearch['searchName'] = $request->searchName;
        $dataSearch['searchPhone'] = $request->searchPhone;
        $dataSearch['searchStatus'] = $request->searchStatus;
        $dataSearch['searchRole'] = $request->searchRole;

        $posts = Post::select('id', 'title', 'status', 'avatar', 'customer_id', 'customer_likes')
            ->when($dataSearch['searchName'], function ($query, $searchName) {
                return $query->where('name', 'like', '%'.$searchName.'%');
            })
            ->when($dataSearch['searchPhone'] != null, function ($query) use ($request) {
                return $query->where('phone', 'like', '%'.$request->searchPhone.'%');
            })
            ->when($dataSearch['searchStatus'] != null, function ($query) use ($request) {
                return $query->where('status', $request->searchStatus);
            })
            ->when($dataSearch['searchRole'] != null, function ($query) use ($request) {
                return $query->where('role', $request->searchRole);
            })
            ->orderBy('id', 'desc')
            ->paginate(PaginateSetting::PAGINATE);

        return view('backend.pages.posts.list', [
            'posts' => $posts,
            'dataSearch' => $dataSearch,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('users.store');
        $listCity = Location::select('id', 'name', 'code')->where('parent_code', Setting::PARENT_CODE)->get();

        return view('backend.pages.users.form', compact('action', 'listCity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $this->userService->register($request);

        return redirect(route('users.index'))->with('status', 'Thêm người dùng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $action = "/admin/users/$id";
        $listCity = Location::select('id', 'name', 'code')->where('parent_code', Setting::PARENT_CODE)->get();

        return view('backend.pages.users.form', compact('user', 'action', 'listCity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUser $request, $id)
    {
        // Retrieve the validated input data...
        // $validated = $request->validated();
        $this->userService->updateProfile($request, $id);

        return redirect(route('users.index'))->with('status', 'Sửa người dùng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            @$user->delete();
            return response()->json([
//                'code'   => ResponseStatusCode::OK,
                'status' => 'Thành công',
                'mess'   => 'Bạn đã xóa người dùng thành công.',
            ]);
        }
    }

    // Select Roles
    public function selectRoleUser(Request $request)
    {
        $data = '';
        if ($request->id == UserConstants::TECHNICAL_STAFF) {
            $data = User::select('id', 'name', 'phone')->where('role', UserConstants::TECHNICAL_MANAGER)->get();
        } elseif ($request->id == UserConstants::SALES) {
            $data = User::select('id', 'name', 'phone')->where('role', UserConstants::SALE_MANAGER)->get();
        } elseif ($request->id == UserConstants::TECHNICAL_MANAGER) {
            $data = User::select('id', 'name', 'phone')->where('role', UserConstants::TECHNICAL_ADMIN)->get();
        } elseif ($request->id == UserConstants::SALE_MANAGER) {
            $data = User::select('id', 'name', 'phone')->where('role', UserConstants::SALE_ADMIN)->get();
        } elseif ($request->id == UserConstants::CUSTOMER) {
            $data = '';
        }

        return $data;
    }

    // Select Location
    public function selectParentLocation(Request $request)
    {
        $data = '';
        $data = Location::select('id', 'name', 'code')->where('parent_code', $request->code_id)->get();

        return $data;
    }

    // Export Excel list
    public function exportListUser(Request $request)
    {
        // $export = InvestorContract::with('getUser', 'saler.user');
        $dataSearch = [];
        $dataSearch['searchName'] = $request->searchName;
        $dataSearch['searchPhone'] = $request->searchPhone;
        $dataSearch['searchStatus'] = $request->searchStatus;
        $dataSearch['searchRole'] = $request->searchRole;

        $users = User::select('id', 'name', 'email', 'phone', 'status', 'image', 'role')
            ->when($dataSearch['searchName'], function ($query, $searchName) {
                return $query->where('name', 'like', '%'.$searchName.'%');
            })
            ->when($dataSearch['searchPhone'] != null, function ($query) use ($request) {
                return $query->where('phone', 'like', '%'.$request->searchPhone.'%');
            })
            ->when($dataSearch['searchStatus'] != null, function ($query) use ($request) {
                return $query->where('status', $request->searchStatus);
            })
            ->when($dataSearch['searchRole'] != null, function ($query) use ($request) {
                return $query->where('role', $request->searchRole);
            });

        $export = $users->orderby("id", "desc")->get();

        Excel::create('Danh sách người dùng', function ($excel) use ($export) {
            $excel->sheet('Sheet 1', function ($sheet) use ($export) {
                $sheet->row(1, array(
                    'Mã người dùng',
                    'Họ tên',
                    'Email',
                    'Số điện thoại',
                    'Chức vụ',
                    'Trạng thái',
//                    'Ngày bắt đầu',
//                    'Ngày kết thúc',
                ));
                $i = 1;
                $arrRoles = [
                    0 => 'Quản trị CMS',
                    1 => 'Khách hàng',
                    2 => 'Nhân viên bán hàng',
                    3 => 'Kỹ thuật viên',
                    4 => 'Quản lý bán hàng',
                    5 => 'Quản lý kỹ thuật',
                    6 => 'Quản trị bán hàng',
                    7 => 'Quản trị kỹ thuật',
                ];

                $arrStatus = [
                    1 => 'Hoạt động',
                    2 => 'Đã khóa',
                ];

                if (count($export)) {
                    foreach ($export as $k => $ex) {
                        $i++;
                        $sheet->row($i, array(
                            (@$ex->id) ? $ex->id : '',
                            (@$ex->name) ? $ex->name : '',
                            (@$ex->email) ? $ex->email : '',
                            (@$ex->phone) ? $ex->phone : '',
                            (@$ex->role) ? $arrRoles[$ex->role] : '',
                            (@$ex->status) ? $arrStatus[$ex->status] : '',
//                            (@$ex->date_start) ? $ex->date_start : '',
//                            (@$ex->date_end) ? $ex->date_end : '',
                        ));
                    }
                }
            });
        })->export('xlsx');
    }
}
