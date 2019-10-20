@extends('backend.layouts.master')
@section('style')
<style>

</style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="/products">Sản phẩm</a>
                    </li>
                    <li class="breadcrumb-item active"><a href="#">Thêm nhãn hiệu/Model</a>
                    </li>
                </ol>
            </div>
        </div>
        <h3 class="content-header-title mb-0">Thêm nhãn hiệu/Model</h3>
    </div>

    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4 class="card-title" id="basic-layout-form">Thông tin nhãn hiệu/Model</h4> --}}
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form-horizontal" method="POST" action="{{ route('taxonomies.store')}}" enctype="multipart/form-data">
                                    @include('backend.pages.taxonomy.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection