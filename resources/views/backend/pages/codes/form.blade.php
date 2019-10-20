@extends('backend.layouts.master')
@section('content')
    <!-- Breadcrumb -->
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="/admin/users">Người dùng</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ isset($code) ? 'Chỉnh sửa mã code' : 'Thêm mới'}}
                    </li>
                </ol>
            </div>
        </div>
        <h3 class="content-header-title mb-0">{{ isset($code) ? 'Chỉnh sửa' : 'Thêm mới'}}</h3>
    </div>

    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">Thông tin mã code</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form-horizontal" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                    @if(isset($code))
                                        @method('put')
                                    @endif
                                    @csrf
                                    <input type="hidden" name="id" value="{{ isset($code) ? $code->id : 0 }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required {{ $errors->has('code') ? 'has-error' : '' }}">
                                                <label for="projectinput1">Mã code <span class="text-danger">*</span></label>
                                                <input style="margin-bottom: 5px;" type="number" class="form-control" placeholder="Nhập mã code"
                                                       name="code"
                                                       value="{{ !empty($code) ? $code->code : old('code') }}">
                                                <span class="help-block">{{ $errors->first('code', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Trạng thái</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="{{ \App\Constants\Setting::ACTIVE }}" {{ isset($code) && $code->status == \App\Constants\Setting::ACTIVE ? 'selected' : '' }}>
                                                        Hoạt động
                                                    </option>
                                                    <option value="{{ \App\Constants\Setting::INACTIVE }}" {{ isset($code) && $code->status == \App\Constants\Setting::INACTIVE ? 'selected' : '' }}>
                                                        Không hoạt động
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required {{ $errors->has('code') ? 'has-error' : '' }}">
                                                <label for="projectinput1">SĐT</label>
                                                <input style="margin-bottom: 5px;" type="text" class="form-control" placeholder="Nhập SĐT"
                                                       name="phone"
                                                       value="{{ !empty($code) ? $code->phone : old('phone') }}">
                                                <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-outline-primary mr-1">
                                            <i class="ft-check"></i> Lưu Lại
                                        </button>
                                        <button type="button" class="btn btn-outline-warning" onclick="location.href='{{route('users.index')}}';">
                                            <i class="ft-x"></i> Trở lại
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection