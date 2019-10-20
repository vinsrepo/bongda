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
                                                <label for="companyName">Nơi làm việc</label>
                                                <input type="text" id="work_place"
                                                       value="{{ isset($user) ? $user->work_place : '' }}"
                                                       class="form-control" placeholder="Nơi làm việc"
                                                       name="work_place">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Trạng thái</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="{{ \App\Constants\UserConstants::ACTIVE }}" {{ isset($user) && $user->status == \App\Constants\UserConstants::ACTIVE ? 'selected' : '' }}>
                                                        Hoạt động
                                                    </option>
                                                    <option value="{{ \App\Constants\UserConstants::INACTIVE }}" {{ isset($user) && $user->status == \App\Constants\UserConstants::INACTIVE ? 'selected' : '' }}>
                                                        Không hoạt động
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Địa chỉ</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select id="province_id" name="province_id"
                                                                class="form-control">
                                                            @if (isset($listCity) && count($listCity))
                                                                @foreach ($listCity as $key => $item)
                                                                    <option {{@$user->province_id == $item['id'] ? 'selected':''}} data-code="{{ $item['code'] }}"
                                                                            value="{{ $item['id'] }}">{{$item['name']}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select id="district_id" name="district_id"
                                                                class="form-control"></select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select id="commune_id" name="commune_id"
                                                                class="form-control"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Chức vụ</label>
                                                <select id="selectRoleUser" name="role" class="form-control">
                                                    <option style="font-size: 17px;font-weight: bold" data-id="false"
                                                            value="{{ \App\Constants\UserConstants::ADMIN }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::ADMIN ? 'selected' : '' }}>
                                                        Quản trị CMS
                                                    </option>
                                                    <option style="font-size: 17px;font-weight: bold" data-id="false"
                                                            value="{{ \App\Constants\UserConstants::TECHNICAL_ADMIN }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::TECHNICAL_ADMIN ? 'selected' : '' }}>
                                                        Technical Admin
                                                    </option>
                                                    <option style="font-size: 15px;font-weight: bold" data-id="true"
                                                            value="{{ \App\Constants\UserConstants::TECHNICAL_MANAGER }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::TECHNICAL_MANAGER ? 'selected' : '' }}>
                                                        -- Technical Manager --
                                                    </option>
                                                    <option style="font-weight: bold" data-id="true"
                                                            value="{{ \App\Constants\UserConstants::TECHNICAL_STAFF }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::TECHNICAL_STAFF ? 'selected' : '' }}>
                                                        ---- Technical Staff ----
                                                    </option>
                                                    <option style="font-size: 17px;font-weight: bold" data-id="false"
                                                            value="{{ \App\Constants\UserConstants::SALE_ADMIN }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::SALE_ADMIN ? 'selected' : '' }}>
                                                        Sale Admin
                                                    </option>
                                                    <option style="font-size: 15px;font-weight: bold" data-id="true"
                                                            value="{{ \App\Constants\UserConstants::SALE_MANAGER }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::SALE_MANAGER ? 'selected' : '' }}>
                                                        --  Sale Manager --
                                                    </option>
                                                    <option style="font-weight: bold" data-id="true"
                                                            value="{{ \App\Constants\UserConstants::SALES }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::SALES ? 'selected' : '' }}>
                                                        ---- Sales ----
                                                    </option>
                                                    <option style="font-size: 17px;font-weight: bold" data-id="false"
                                                            value="{{ \App\Constants\UserConstants::CUSTOMER }}" {{ isset($user) && $user->role == \App\Constants\UserConstants::CUSTOMER ? 'selected' : '' }}>
                                                        Khách hàng
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Cấp trên</label>
                                                <select id="selectUserParent" name="parent_id" class="form-control">
                                                    <option value="{{(isset($user->parent_id) && $user->parent_id != '') ? $user->parent_id : 0}}">{{(isset($user->parent_id) && $user->parent_id != '') ? @$user->getNameUserByParent->name : 'Không có dữ liệu'}}</option>
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
                                                                    <img class="viewImage" src="{{@$user->image? asset($user->image): asset('backend/images/account.png')}}"
                                                                         alt="Ảnh đại diện" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                <div class="d-flex justify-content-center" style="margin-top: 10px;">
                                                                    <button type="button" class="btn btn-secondary btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-picture-o"></i> Chọn ảnh</span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Thay đổi</span>
                                                                        <input type="file" id='image' name='image' class="btn-secondary"/>
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


    <script type="text/javascript">
        $(document).ready(function () {
            if ($('#selectRoleUser').find('option:selected').data('id') == false) {
                $("#selectUserParent").css('display', 'none');
            }
            $('#selectRoleUser').change(function () {
                var role_user_child = $(this).val();
                var check_data = $(this).find('option:selected').data('id');
                // console.log(check_data);
                var html = '';

                if (check_data == true) {
                    $("#selectUserParent").attr('disabled', false);
                    $("#selectUserParent").css('display', 'block');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: role_user_child,
                        },
                        url: '{{route('selectRoleUser')}}',
                        type: 'GET',
                        success: function (data) {
                            // console.log(data);
                            if ($.trim(data) && data != '') {
                                $.each(data, function (i, e) {
                                    // console.log(i, e);
                                    html += '<option value="' + e.id + '">' + e.name + '(' + e.phone + ')' + '</option>';
                                });
                            } else {
                                $("#selectUserParent").attr('disabled', true);
                                // $("#selectUserParent").css('display', 'none');
                                html += '<option value="0">Vui lòng thêm đầy đủ dữ liệu</option>';
                            }
                            $('#selectUserParent').html(html);
                        }
                    });
                } else {
                    $("#selectUserParent").attr('disabled', true);
                    // $("#selectUserParent").css('display', 'none');
                    html += '<option value="0">Không có dữ liệu</option>';
                    $('#selectUserParent').html(html);
                }
            });

            // select province
            $('#province_id').change(function () {
                var parent_id = $(this).val();
                var code_id = $(this).find('option:selected').data('code');
                var check_data = $(this).find('option:selected').data('id');
                var html = '';

                // if (check_data == true) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: parent_id,
                        code_id: code_id,
                    },
                    url: '{{route('selectParentLocation')}}',
                    type: 'GET',
                    success: function (data) {
                        // console.log(data);
                        if ($.trim(data) && data != '') {
                            $.each(data, function (i, e) {
                                // console.log(i, e);
                                html += '<option data-code="' + e.code + '" value="' + e.id + '">' + e.name + '</option>';
                            });
                        } else {
                            html += '<option value="0">Vui lòng thêm đầy đủ dữ liệu</option>';
                        }
                        $('#district_id').html(html);
                        $('#district_id').val('{{@$user->district_id}}').trigger('change');
                        $('#district_id').val() == undefined ? $('#district_id').prop('selectedIndex', 0).trigger('change') : "";
                    }
                });
                // } else {
                // html += '<option value="0">Không có dữ liệu</option>';
                // $('#selectUserParent').html(html);
                // }
            });

            // select province
            $('#district_id').change(function () {
                var parent_id = $(this).val();
                var code_id = $(this).find('option:selected').data('code');
                var check_data = $(this).find('option:selected').data('id');
                var html = '';

                // if (check_data == true) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: parent_id,
                        code_id: code_id,
                    },
                    url: '{{route('selectParentLocation')}}',
                    type: 'GET',
                    success: function (data) {
                        // console.log(data);
                        if ($.trim(data) && data != '') {
                            $.each(data, function (i, e) {
                                // console.log(i, e);
                                html += '<option data-code="' + e.code + '" value="' + e.id + '">' + e.name + '</option>';
                            });
                        } else {
                            html += '<option value="0">Vui lòng thêm đầy đủ dữ liệu</option>';
                        }
                        $('#commune_id').html(html);
                        $('#commune_id').val('{{@$user->commune_id}}').trigger('change');
                        $('#commune_id').val() == undefined ? $('#commune_id').prop('selectedIndex', 0).trigger('change') : "";
                    }
                });
                // } else {
                // html += '<option value="0">Không có dữ liệu</option>';
                // $('#selectUserParent').html(html);
                // }
            });

            $('#province_id').trigger('change');
        })
    </script>
@endsection