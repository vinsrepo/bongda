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
                        <li class="breadcrumb-item"><a href="#">Mã code</a>
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
                        <h4 style="margin-bottom: 10px" class="card-title">Danh sách mã code</h4>
                        <a href="{{route('codes.create')}}" title="">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="form-search" action="" method="GET">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="disabledInput">Mã code</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="searchName" placeholder="Nhập mã kích hoạt" value="{{@$dataSearch['searchName']}}">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="disabledInput">Số điện thoại</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="searchPhone" placeholder="Nhập số điện thoại" value="{{@$dataSearch['searchPhone']}}">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="customSelect">Trạng thái</label>
                                            <select class="form-control" id="basicSelect" name="searchStatus">
                                                <option selected="" value="">-- Chọn trạng thái --</option>
                                                <option value="{{\App\Constants\UserSetting::ENABLE}}" {{(@$dataSearch['searchStatus'] == \App\Constants\UserSetting::ENABLE) ? 'selected' : ''}}>Hoạt động</option>
                                                <option value="{{\App\Constants\UserSetting::DISABLE}}" {{(@$dataSearch['searchStatus'] == \App\Constants\UserSetting::DISABLE) ? 'selected' : ''}}>Đã khóa</option>
                                                <option value="{{\App\Constants\UserSetting::EXPIRED}}" {{(@$dataSearch['searchStatus'] == \App\Constants\UserSetting::EXPIRED) ? 'selected' : ''}}>Hết hạn</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 tb-btn-search">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm <i class="fa fa-search"></i></button>
                                        <button type="button" class="btn btn-warning btn-min-width" onclick="location.href='{{route('codes.index')}}';">Làm mới <i class="ft-rotate-cw"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="list-user" class="table table-bordered table-hover">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Mã code</th>
                                            <th>SĐT</th>
                                            <th>Thời gian hết hạn</th>
                                            <th>Trạng thái hết hạn</th>
                                            <th>Trạng thái</th>
                                            <th class="text-center">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($codes) && count($codes))
                                            @foreach ($codes as $item)
                                                <tr>
                                                    <th scope="row">{{$item->id}}</th>
                                                    <td>{{$item->code}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{date('d-m-Y', strtotime($item->time_expired))}}</td>
                                                    <td>
                                                        @if (strtotime($item->time_expired) > time())
                                                            <span class="badge badge-success">Còn hạn</span>
                                                        @else
                                                            <span class="badge badge-danger">Đã hết hạn</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->status === \App\Constants\UserSetting::ENABLE)
                                                            <span class="badge badge-success">Đang hoạt động</span>
                                                        @elseif ($item->status === \App\Constants\UserSetting::DISABLE)
                                                            <span class="badge badge-warning">Đã khóa</span>
                                                        @elseif ($item->status === \App\Constants\UserSetting::EXPIRED)
                                                            <span class="badge badge-danger">Hết hạn</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
{{--                                                        <a class="primary edit mr-1"><i class="fa fa-info-circle"></i></a>--}}
                                                        <a class="primary edit mr-1" href="/admin/codes/{{ $item->id }}/edit"><i class="fa fa-pencil"></i></a>
                                                        <a class="danger delete mr-1 delete-item" data-id="{{ $item->id }}" title="Xóa mã code"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            Không có mã code nào.
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tb-paginate float-md-right">
                                {{ $codes->appends(['searchName' => $dataSearch['searchName'], 'searchPhone' => $dataSearch['searchPhone'], 'searchStatus' => $dataSearch['searchStatus'], 'searchRole' => $dataSearch['searchRole']])->links() }}
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
                        url: "/admin/codes/"+data_id,
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
