@extends('backend.layouts.master')
@section('content')
    <!-- Modal -->
    <div id="myModal" class="modal fade in" role="dialog">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">

                <!-- Modal content-->
                <div class="modal-content">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">History
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
                        <h4 class="card-title">History</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/admin/history" method="GET">
                                <div class="row">
                                    <!-- <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="disabledInput">Họ tên</label>
                                            <input type="text" class="form-control" id="placeholderInput" name="searchName" placeholder="Nhập họ tên">
                                        </fieldset>
                                    </div> -->
                                    
                                    <div class="col-xl-2 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="customSelect">Table</label>
                                            <select class="form-control" id="table" name="table">
                                                <option selected="" value="">-- Choose --</option>
                                                @if (count($table))
                                                @foreach ($table as $val)
                                                <option value="{{ $val }}" {{ isset($_GET['table']) && $_GET['table'] == $val ? 'selected' : '' }}>{{ nameByModel($val) }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="customSelect">Event</label>
                                            <select class="form-control" id="event" name="event">
                                                <option selected="" value="">-- Choose --</option>
                                                @if (count($event))
                                                @foreach ($event as $val)
                                                <option value="{{ $val }}" {{ isset($_GET['event']) && $_GET['event'] == $val ? 'selected' : '' }}>{{ $val }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-6 col-md-12 tb-btn-search">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm <i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th style="width:5%">#</th>
                                            <th style="width:10%">Table</th>
                                            <th style="width:15%">Update by</th>
                                            <th style="width:10%">Event</th>
                                            <th style="width:10%">IP Address</th>
                                            <th>User Agent</th>
                                            <th class="text-center" style="width:5%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($datas))
                                            @foreach ($datas as $data)
                                                <tr data-id="{{$data->id}}" data-tableid="{{ $data->auditable_id }}" data-table="{{ $data->auditable_type }}">
                                                    <td scope="row">{{ $data->id }}</td>
                                                    <td>{{ nameByModel($data->auditable_type) }}</td>
                                                    <td>{{ @$data->user->name }}</td>
                                                    <td>{{ $data->event }}</td>
                                                    <td>{{ $data->ip_address }}</td>
                                                    <td>{{ $data->user_agent }}</td>
                                                    <td class="text-center">
                                                        <a class="primary show-detail mr-1"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">No result.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tb-paginate float-md-right">
                                @if (isset($datas))
                                {{ $datas->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.show-detail').click(function () {
        var parent = $(this).closest('tr');
        var audit_id = parent.data('id');
        var table_id = parent.data('tableid');
        var model = parent.data('table');
        var url = '/admin/history-detail';
        data = {};
        data.audit_id = audit_id;
        data.table_id = table_id;
        data.model = model;
        $.get(url, data, function (res){
            $('#myModal.modal .modal-content').html(res);
            $("#myModal.modal").css('display', 'block');
        });
    })
    $('body').on('click', '#myModal.modal button.close', function (){
        $('#myModal.modal').css('display', 'none');
    })
    var modal = document.getElementById('myModal');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            modal.html = "";
        }
    }
</script>
@endsection