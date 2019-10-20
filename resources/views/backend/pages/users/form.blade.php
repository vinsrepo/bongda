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
                        {{ isset($user) ? 'Chỉnh sửa thông tin người dùng' : 'Thêm mới'}}
                    </li>
                </ol>
            </div>
        </div>
        <h3 class="content-header-title mb-0">{{ isset($user) ? 'Chỉnh sửa' : 'Thêm mới'}}</h3>
    </div>

    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">Thông tin người dùng</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form-horizontal" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                    @if(isset($user))
                                        @method('put')
                                    @endif
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ isset($user) ? $user->id : 0 }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                                                <label for="projectinput1">Tên người dùng <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Tên người dùng"
                                                       name="name"
                                                       value="{{ !empty($user) ? $user->name : old('name') }}">
                                                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" placeholder="Email"
                                                       name="email"
                                                       value="{{ !empty($user) ? $user->email : old('email') }}">
                                                <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="{{(!isset($user)) ? 'col-md-6' : 'col-md-12' }}">
                                                    <div class="form-group required {{ $errors->has('phone') ? 'has-error' : '' }}">
                                                        <label for="projectinput4">Số điện thoại <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                               placeholder="Số điện thoại" name="phone"
                                                               value="{{ !empty($user) ? $user->phone : old('phone') }}">
                                                        <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                                                    </div>
                                                </div>

                                                @if (!isset($user))
                                                    <div class="col-md-6">
                                                        <div class="form-group required {{ $errors->has('password') ? 'has-error' : '' }}">
                                                            <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                                                            <input type="password" class="form-control"
                                                                   placeholder="Mật khẩu"
                                                                   name="password" value="{{ old('password') }}">
                                                            <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Trạng thái</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="{{ \App\Constants\Setting::ACTIVE }}" {{ isset($user) && $user->status == \App\Constants\Setting::ACTIVE ? 'selected' : '' }}>
                                                        Hoạt động
                                                    </option>
                                                    <option value="{{ \App\Constants\Setting::INACTIVE }}" {{ isset($user) && $user->status == \App\Constants\Setting::INACTIVE ? 'selected' : '' }}>
                                                        Không hoạt động
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="role">Ảnh đại diện</label>
                                                        <div class="col d-flex justify-content-center" style="margin-top: 10px;">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail" style="border-radius: 5px;width: 200px; height: 150px;">
                                                                    <img class="viewImage" src="{{@$user->avatar? asset($user->avatar): asset('backend/images/account.png')}}"
                                                                         alt="Ảnh đại diện" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                <div class="d-flex justify-content-center" style="margin-top: 10px;">
                                                                    <button type="button" class="btn btn-secondary btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-picture-o"></i> Chọn ảnh</span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Thay đổi</span>
                                                                        <input type="file" id='image' name='avatar' class="btn-secondary"/>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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