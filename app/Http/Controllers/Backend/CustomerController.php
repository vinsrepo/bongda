<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Constants\Setting;

class CustomerController extends Controller
{
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
        $searchAddress = $request->searchAddress;
        
        $dataSearch['searchName'] = $searchName;
        $dataSearch['searchPhone'] = $searchPhone;
        $dataSearch['searchStatus'] = $searchStatus;
        $dataSearch['searchAddress'] = $searchAddress;

        $users = Customer::when($searchName, function ($query, $searchName) {
            return $query->where('name', 'like', '%' . $searchName . '%');
        })
        ->when($searchPhone, function ($query, $searchPhone) {
            return $query->where('phone', 'like', '%' . $searchPhone . '%');
        })
        ->when($searchStatus, function ($query, $searchStatus) {
            return $query->where('status', $searchStatus);
        })->when($searchAddress, function ($query, $searchAddress) {
            return $query->where('address', 'like', '%' . $searchAddress . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(Setting::DEFAULT_PAGINATE);
        return view('backend.pages.customers.list', [
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
}
