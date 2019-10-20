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
                        <li class="breadcrumb-item"><a href="#">Bài viết</a>
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
                        <h4 class="card-title">Danh sách bài viết</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="form-search" action="/admin/posts" method="GET">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="disabledInput">Họ tên</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="searchName" placeholder="Nhập họ tên" value="{{@$dataSearch['searchName']}}">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
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
                                                <option value="{{\App\Constants\Setting::ACTIVE}}" {{(@$dataSearch['searchStatus'] == \App\Constants\Setting::ACTIVE) ? 'selected' : ''}}>Hoạt động</option>
                                                <option value="{{\App\Constants\Setting::INACTIVE}}" {{(@$dataSearch['searchStatus'] == \App\Constants\Setting::INACTIVE) ? 'selected' : ''}}>Đã khóa</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 tb-btn-search">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm <i class="fa fa-search"></i></button>
                                        <button type="button" class="btn btn-warning btn-min-width" onclick="location.href='{{route('users.index')}}';">Làm mới <i class="ft-rotate-cw"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group" style="margin-top: -15px;">
                                <a href="javascript:void(0)" class="btn btn-warning" id="export-contract">Xuất file Excel</a>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="list-user" class="table table-bordered">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Tiêu đề</th>
                                            <th>Người đăng</th>
                                            <th>Số lượt like</th>
                                            <th>Trạng thái</th>
                                            <th class="text-center">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($posts) && count($posts))
                                            @foreach ($posts as $item)
                                                <tr>
                                                    <th scope="row">{{$item->id}}</th>
                                                    <td class="text-center">
                                                        <div class="tb-avatar">
                                                            <span class="_image_avatar_round"><img src="{{@$item->image ? asset($item->image) : asset('backend/images/account.png')}}" alt="avatar"></span>
                                                        </div>
                                                    </td>
                                                    <td>{{$item->title}}</td>
                                                    <td>{{$item->customer_id}}</td>
                                                    <td>{{$item->customer_likes}}</td>
                                                    <td>
                                                        @if ($item->status == \App\Constants\Setting::ACTIVE)
                                                            <span class="badge badge-success">Hoạt động</span>
                                                        @elseif ($item->status == \App\Constants\Setting::INACTIVE)
                                                            <span class="badge badge-danger">Đã khóa</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="primary edit mr-1" href="/admin/posts/{{ $item->id }}/edit"><i class="fa fa-pencil"></i></a>
                                                        <a class="danger delete mr-1 delete-item" data-id="{{ $item->id }}" title="Xóa người dùng"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                Không có người dùng nào.
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tb-paginate float-md-right">
                                {{ $posts->appends(['searchName' => $dataSearch['searchName'], 'searchPhone' => $dataSearch['searchPhone'], 'searchStatus' => $dataSearch['searchStatus'], 'searchRole' => $dataSearch['searchRole']])->links() }}
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

            // export excel
        {{--    $('#export-contract').click(()=>{--}}
        {{--        $('#form-search').attr('action','{{route('exportListUser')}}');--}}
        {{--        $('#form-search').submit();--}}
        {{--    });--}}
            $("body").delegate("#export-contract", "click", function () {
                swal({
                    title: 'Bạn muốn xuất file dữ liệu này?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showCloseButton: true,
                }).then(function() {
                    {{--$('#form-search').attr('action','{{route('exportListUser')}}');--}}
                    $('#form-search').submit();
                    $('#form-search').attr('action','');
                    setTimeout(function(){
                        swal({
                            title: 'Đã xuất file thành công!',
                            type: 'success'
                        });
                    }, 2000);
                }, function (dismiss) {});
            })
        })
    </script>
@endsection
