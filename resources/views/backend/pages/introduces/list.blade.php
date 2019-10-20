@extends('backend.layouts.master')
@section('content')
    <!-- Breadcrumb -->
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Trag chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Quản lý nội dung tĩnh</a>
                    </li>
                </ol>
            </div>
        </div>
{{--        <h3 class="content-header-title mb-0">Add new</h3>--}}
    </div>

    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">Quản lý nội dung tĩnh</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="box-header with-border">
                                <a class="btn btn-primary text-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="float: none;margin-top: 15px;">
                                    Thêm mới
                                </a>
                            </div>
                            <div class="box-header with-border" style="border-bottom: none;">
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body" style="padding: 20px 0;margin-bottom: 0;">
                                        <h3 class="box-title" style="margin-bottom: 15px;;color: #ff0000;">Mục thêm mới này chỉ dành cho nhà phát triển CMS/APP <span class='red'>*</span></h3>
                                        <form id="form" action="{{ route('introduce.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            @csrf
                                            @method('post')
                                            <div class="box-body row">

                                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label required">Tên nội dung  <span class='red'>*</span></label>
                                                    <input class="form-control" required type="text" name="name" placeholder="Nhập tên nội dung">
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label required">Ghi chú</label>
                                                    <input class="form-control" type="text" name="note" placeholder="Điền ghi chú">
                                                </div>
                                                <div class="clear"></div>
                                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label required">Từ khóa  <span class='red'>*</span></label>
                                                    <input class="form-control" required type="text" name="condition" placeholder="Nhập từ khóa kiểm tra">
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label required">Kiểu nội dung  <span class='red'>*</span></label>
                                                    <select id="tipsnews_status" name="type" class="form-control" required>
                                                        <option value="{{App\Constants\IntroduceSetting::TEXT_INPUT}}"> Nội dung </option>
                                                        <option value="{{App\Constants\IntroduceSetting::IMAGE_TEXT}}"> Ảnh </option>
                                                        <option value="{{App\Constants\IntroduceSetting::TEXT_TEXTAREA}}"> Mô tả nội dung chi tiết </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                                                <a class="btn btn-warning" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Trở lại</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @if (\Session::has('message'))
                                    <div class="alert alert-success notification" style="display: block;">
                                        <ul style="padding-left: 0;list-style: none;margin: 0;display: block;">
                                            <li>{!! \Session::get('message') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                            <!-- general form elements -->
                                <div class="box box-primary">
                                    <!-- form start -->
                                    @if(count($StaticContentManager1) || count($StaticContentManager2) || count($StaticContentManager3))
                                        <h3 class="box-title">Chỉnh sửa nội dung tĩnh</h3>
                                    @endif
                                    <form id="form" action="{{ route('introduce.update', ['id' => 'all']) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        @method('put')
                                        <div class="box-body row">
                                            <div class="" style="width: 100%;display: inline-block;">
                                                @if(isset($StaticContentManager1) && count($StaticContentManager1))
                                                    @foreach($StaticContentManager1 as $key => $setting)
                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group" style="margin-bottom: 30px;float: left;">
                                                            <label class="control-label required" style="font-size: 15px;text-transform: capitalize;">{{ ($setting) ? $setting->name : '' }}  <span class='red'>*</span></label>
                                                            <a class="tt_large" style="float: right;" href="javascript:void(0)" rel="tooltip" data-toggle="tooltip" title="{{ ($setting) ? $setting->note : '' }}"><i class="fa fa-info-circle" style="font-size: 16px;" aria-hidden="true"></i></a>
                                                            <div class="col d-flex justify-content-center" style="margin-top: 10px;">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="border-radius: 5px;width: 200px; height: 150px;">
                                                                        <img style="width: 100%;object-fit: cover;" class="viewImage" src="{{@$setting->content? asset($setting->content): asset('backend/images/no-image.png')}}"
                                                                             alt="Ảnh đại diện" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                    <div class="d-flex justify-content-center" style="margin-top: 10px;">
                                                                        <button type="button" class="btn btn-secondary btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-picture-o"></i> Chọn ảnh</span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Thay đổi</span>
                                                                            <input type="file" name='{{ ($setting) ? $setting->condition : '' }}' class="btn-secondary" value="{{@$setting->content? asset($setting->content): ''}}"/>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="" style="width: 100%;display: inline-block;">
                                                @if(isset($StaticContentManager2) && count($StaticContentManager2))
                                                    @foreach($StaticContentManager2 as $key => $setting)
                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group" style="margin-bottom: 30px;float: left;">
                                                            <label class="control-label required" style="font-size: 15px;text-transform: capitalize;">{{ ($setting) ? $setting->name : '' }} <span class='red'>*</span></label>
                                                            <a class="tt_large" style="float: right;" href="javascript:void(0)" rel="tooltip" data-toggle="tooltip" title="{{ ($setting) ? $setting->note : '' }}"><i class="fa fa-info-circle" style="font-size: 16px;" aria-hidden="true"></i></a>
                                                            <input type="text" name="{{ ($setting) ? $setting->condition : '' }}" value="{{ ($setting) ? $setting->content : '' }}" placeholder="{{ ($setting) ? $setting->note : '' }}" style="width: 100%;padding: 5px 10px;">
                                                        </div>
                                                        <div class="clear"></div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div id="textarea" style="width: 100%;display: inline-block;">
                                                @if(isset($StaticContentManager3) && count($StaticContentManager3))
                                                    @foreach($StaticContentManager3 as $key => $setting)
                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group" style="margin-bottom: 30px;float: left;">
                                                            <label class="control-label required" style="font-size: 15px;text-transform: capitalize;">{{ ($setting) ? $setting->name : '' }}  <span class='red'>*</span></label>
                                                            <a class="tt_large" style="float: right;" href="javascript:void(0)" rel="tooltip" data-toggle="tooltip" title="{{ ($setting) ? $setting->note : '' }}"><i class="fa fa-info-circle" style="font-size: 16px;" aria-hidden="true"></i></a>
                                                            <textarea required type="text" name="{{ ($setting) ? $setting->condition : '' }}" class="form-control ckeditor-input">{{ ($setting) ? $setting->content : '' }}</textarea>
                                                        </div>
                                                        <div class="clear"></div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        @if(count($StaticContentManager1) || count($StaticContentManager2) || count($StaticContentManager3))
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary">Lưu tất cả</button>
                                                <a href='/admin' class="btn btn-warning">Trở lại</a>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function(){
                setTimeout(function(){
                    $('.notification').hide('fade');
                }, 5000);

                $(".tt_large").tooltip({
                    template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                });

                $("#textarea .ckeditor-input").each(function() {
                    var name = $(this).attr("name");
                    CKEDITOR.replace(name);
                })
            })
        </script>
    @endsection
@endsection