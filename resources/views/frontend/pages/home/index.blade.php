<!DOCTYPE html>
<html>
<head>
    <title>Bóng đá Giao Thủy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha256-ZT4HPpdCOt2lvDkXokHuhJfdOKSPFLzeAJik5U/Q+l4=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/main.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="section section1">
        <div class="container">
            <div class="row">
                <div class="title-page">
                    <h2 class="text-center">THÔNG TIN TRẬN ĐẤU</h2>
                </div>
                <div class="list-tran-dau">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="danh-sach-doi-a">
                            <h4 class="text-center">Giao Hà</h4>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="score-match">
                            <h4 class="text-center">3-0</h4>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="danh-sach-doi-b">
                            <h4 class="text-center">Giao Thanh</h4>
                        </div>
                    </div>
                </div>
                <div class="select-player col-xs-12">
                    <h4 class="">Lựa chọn số áo cầu thủ ghi bàn</h4>
                </div>
                <div class="list-cau-thu">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="danh-sach-doi-a">
                            <div class="list-group">
                                <div class="touch-number">
                                    <div class="" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <input style="width: 100%" max="999" class="text-center form-control-lg mb-2" id="code">
                                        </div>
                                        <div class="btn-group">
                                            {{-- <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '1';">1</button> --}}
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="1">1</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="2">2</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="3">3</button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="4">4</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="5">5</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="6">6</button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="7">7</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="8">8</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="9">9</button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary py-3" onclick="document.getElementById('code').value=document.getElementById('code').value.slice(0, -1);">&lt;</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="1">0</button>
                                            <button type="button" class="btn btn-primary py-3" onclick="">Go</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- @if($data['playerListA'])
                                    @foreach($data['playerListA'] as $key => $val)
                                        <div class="list-group-item col-sm-4">
                                            <div class="player-detail" style="height: 200px;position: relative;">
                                                <img style="width: 100%;height: 100%;object-fit: cover;position: relative;" src="https://www.gogoalshop.co/html/upload/item_img/201505/1/1143219625440b1d8a2.jpg" alt="">
                                                <div class="" style="position: absolute;">
                                                    {{@$val->name}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif --}}
                           </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thong-tin-chi-tiet">
                            <div class="list-group">
                                Chi tiết
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="danh-sach-doi-b">
                            <div class="list-group">
                                {{-- @if($data['playerListB'])
                                    @foreach($data['playerListB'] as $key => $val)
                                        <div class="list-group-item col-sm-4">
                                            <div class="player-detail" style="height: 200px;position: relative;">
                                                <img style="width: 100%;height: 100%;object-fit: cover;position: relative;" src="https://www.gogoalshop.co/html/upload/item_img/201505/1/1143219625440b1d8a2.jpg" alt="">
                                                <div class="" style="position: absolute;">
                                                    {{@$val->name}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section2">
        
    </div>
</body>
</html>