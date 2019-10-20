<?php

namespace App\Http\Controllers\Backend;

use App\Constants\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\User as UserConstants;
use App\Constants\UserSetting;
use App\Http\Requests\CreateUser;
use App\Services\Users\UserService;
use App\Models\Audits;
use App\Models\News;

class UserController extends Controller
{
    /**
     * @var userService
     */
    private $userService;

    /**
     * UserService constructor.
     *
     * @param userService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchName = $request->searchName;
        $searchPhone = $request->searchPhone;
        $searchStatus = $request->searchStatus;
        $searchRole = $request->searchRole;
        
        $dataSearch['searchName'] = $searchName;
        $dataSearch['searchPhone'] = $searchPhone;
        $dataSearch['searchStatus'] = $searchStatus;
        $dataSearch['searchRole'] = $searchRole;

        $users = User::when($searchName, function ($query, $searchName) {
                return $query->where('name', 'like', '%' . $searchName . '%');
            })
            ->when($searchPhone, function ($query, $searchPhone) {
                return $query->where('phone', 'like', '%' . $searchPhone . '%');
            })
            ->when($searchStatus, function ($query, $searchStatus) {
                // $status = $searchStatus === 'active' ? UserConstants::ACTIVE:UserConstants::INACTIVE;
                return $query->where('status', $searchStatus);
            })->when($searchRole, function ($query, $searchRole) {
                return $query->where('role', $searchRole);
            })
            ->orderBy('id', 'desc')
            ->paginate(Setting::DEFAULT_PAGINATE);
            
        return view('backend.pages.users.list', [
            'users' => $users,
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
        return view('backend.pages.users.form', compact('action'));
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
        $this->userService->createUser($request);
        return view('backend.pages.users.list')->with('status', 'Thêm người dùng thành công.');
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
        return view('backend.pages.users.form', compact('user', 'action'));
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
        $validated = $request->validated();
        $this->userService->updateUser($request, $id);
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
        //
    }
}
