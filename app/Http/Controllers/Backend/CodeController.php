<?php

namespace App\Http\Controllers\Backend;

use App\Constants\IntroduceSetting;
use App\Constants\DirectoryConstant;
use App\Constants\Setting;
use App\Models\Code;
use App\Models\Introduce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Codes\CodeService;
use App\Http\Requests\CreateCode;

class CodeController extends Controller
{
    /**
     * @var userService
     */
    private $codeService;

    /**
     * CodeService constructor.
     *
     * @param userService $userService
     */
    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
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

        $codes = Code::when($searchName, function ($query, $searchName) {
                return $query->where('code', 'like', '%' . $searchName . '%');
            })
            ->when($searchPhone, function ($query, $searchPhone) {
                return $query->where('phone', 'like', '%' . $searchPhone . '%');
            })
            ->when($searchStatus, function ($query, $searchStatus) {
                return $query->where('status', $searchStatus);
            })
            ->orderBy('id', 'desc')
            ->paginate(Setting::DEFAULT_PAGINATE);
            
        return view('backend.pages.codes.list', [
            'codes' => $codes,
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
        $action = route('codes.store');

        return view('backend.pages.codes.form', compact('code', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCode $request)
    {
        $this->codeService->createCode($request);

        return redirect(route('codes.index'))->with('message', 'Thêm mới thành công!');
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
        $code = Code::where('id', $id)->first();
        $action = "/admin/codes/$id";
        // $action = route('codes.update');

        return view('backend.pages.codes.form', compact('code', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCode $request, $id)
    {
        $this->codeService->updateCode($request, $id);

        return redirect(route('codes.index'))->with('message', 'Chỉnh sửa thành công!');
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
