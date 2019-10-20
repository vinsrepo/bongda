@extends('backend.layouts.master')
@section('content')
    <style>
        #list-user .fa:before{
            font-size: 18px;
        }
        #list-user .user-now .fa:before{
            color: #b7aeae;
            cursor: not-allowed;
        }
    </style>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Khách hàng</a>
                        </li>
                        <li class="breadcrumb-item active">Danh sách
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Danh sách khách hàng</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="form-search" action="" method="GET">
                                <div class="row">
                                    <div class="col-md-3 mb-1">
                                        <fieldset class="form-group">
                                            <label for="disabledInput">Họ tên</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="searchName" placeholder="Nhập họ tên" value="{{@$dataSearch['searchName']}}">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3 mb-1">
                                        <fieldset class="form-group">
                                            <label for="disabledInput">Số điện thoại</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="searchPhone" placeholder="Nhập số điện thoại" value="{{@$dataSearch['searchPhone']}}">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <fieldset class="form-group">
                                            <label for="customSelect">Địa chỉ</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="searchAddress" placeholder="Nhập địa chỉ" value="{{@$dataSearch['searchAddress']}}">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <fieldset class="form-group">
                                            <label for="customSelect">Trạng thái</label>
                                            <select class="form-control" id="basicSelect" name="searchStatus">
                                                <option selected="" value="">-- Chọn trạng thái --</option>
                                                <option value="{{\App\Constants\CustomerSetting::ENABLE}}" {{(@$dataSearch['searchStatus'] == \App\Constants\CustomerSetting::ENABLE) ? 'selected' : ''}}>Hoạt động</option>
                                                <option value="{{\App\Constants\CustomerSetting::DISABLE}}" {{(@$dataSearch['searchStatus'] == \App\Constants\CustomerSetting::DISABLE) ? 'selected' : ''}}>Đã khóa</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row" style="transform: translateY(-22px);">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm <i class="fa fa-search"></i></button>
                                        <button type="button" class="btn btn-warning btn-min-width" onclick="location.href='{{route('customers.index')}}';">Làm mới <i class="ft-rotate-cw"></i></button>
                                    </div>
                                </div> 
                            </form>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="list-user" class="table table-bordered table-hover">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Avatar</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>SĐT</th>
                                            <th>Địa chỉ</th>
                                            <th>Trạng thái</th>
                                            <th class="text-center">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($users) && count($users))
                                            @foreach ($users as $item)
                                                <tr>
                                                    <th scope="row">{{$item->id}}</th>
                                                    <td class="text-center">
                                                        <div class="tb-avatar">
                                                            <span class="_image_avatar_round"><img src="{{@$item->image ? asset($item->image) : asset('backend/images/account.png')}}" alt="avatar"></span>
                                                        </div>
                                                    </td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->address}}</td>
                                                    <td>
                                                        @if ($item->status === \App\Constants\CustomerSetting::ENABLE)
                                                            <span class="badge badge-success">Hoạt động</span>
                                                        @elseif ($item->status === \App\Constants\CustomerSetting::DISABLE)
                                                            <span class="badge badge-danger">Đã khóa</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- <a class="primary edit mr-1"><i class="fa fa-info-circle"></i></a> --}}
                                                        <a class="primary edit mr-1" href="/admin/users/{{ $item->id }}/edit"><i class="fa fa-pencil"></i></a>
                                                        <a class="danger delete mr-1 delete-item" data-id="{{ $item->id }}" title="Xóa người dùng"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            Không có người dùng nào.
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tb-paginate float-md-right">
                                {{ $users->appends(['searchName' => $dataSearch['searchName'], 'searchPhone' => $dataSearch['searchPhone'], 'searchStatus' => $dataSearch['searchStatus'], 'searchAddress' => $dataSearch['searchAddress']])->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("body").delegate(".delete-item", "click", function () {
                let elt = $(this).parents('tr');
                var data_id = $(this).data('id');
                swal({
                    title: 'Bạn có chắc chắn xóa mục này?',
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showCloseButton: true,
                }).then(function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { id: data_id },
                        url: "/admin/users/"+data_id,
                        method: 'delete',
                        success: function() {
                            swal({
                                title: 'Đã xóa thành công!',
                                type: 'success'
                            })}
                    });
                    elt.remove();
                }, function (dismiss) {});
            });
        });
    </script>
@endsection
