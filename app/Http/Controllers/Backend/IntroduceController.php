<?php

namespace App\Http\Controllers\Backend;

use App\Constants\IntroduceSetting;
use App\Constants\DirectoryConstant;
use App\Models\User;
use App\Models\Introduce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntroduceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['StaticContentManager1'] = Introduce::orderBy('id', 'asc')
            ->where('type', IntroduceSetting::IMAGE_TEXT)->get();
        $data['StaticContentManager2'] = Introduce::orderBy('id', 'asc')
            ->where('type', IntroduceSetting::TEXT_INPUT)->get();
        $data['StaticContentManager3'] = Introduce::orderBy('id', 'asc')
            ->where('type', IntroduceSetting::TEXT_TEXTAREA)->get();

        return view('backend.pages.introduces.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');

        $staticContent = Introduce::create([
            'name' => $input['name'],
            'note' => $input['note'],
            'condition' => $input['condition'],
            'type' => $input['type'],
        ]);
        $staticContent->save();

        return redirect(route('introduce.index'))->with('message', 'Thêm mới thành công!');
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
    public function update(Request $request, $id)
    {
        $input = $request->except('_token');
        foreach ($input as $key => $value) {
            $settings[$key] = $value;
        }
        foreach ($settings as $k => $s) {
            $setting = Introduce::where('condition', $k)->first();
            if ($setting) {
                $setting->content = $s;
                $setting->save();
            }
        }

        $path = DirectoryConstant::INTRODUCE;
        foreach ($request->files as $name => $file) {
            $image_name = time().'-'.$file->getClientOriginalName();
            $introduce = Introduce::where('condition', $name)->first();
            $introduce->content = $path . $image_name;
            $introduce->save();
            $file->move(public_path($path), $image_name);
        }

        return redirect(route('introduce.index'))->with('message', 'Chỉnh sửa thành công!');
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
