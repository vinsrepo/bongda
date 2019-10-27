<!DOCTYPE html>
<html>
<head>
    <title>Bóng đá Giao Thủy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha256-ZT4HPpdCOt2lvDkXokHuhJfdOKSPFLzeAJik5U/Q+l4=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/main.css')}}">
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
                            <h4 class="text-center">30:23</h4>
                            <h5 class="text-center">3-0</h5>
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
                    <div class="col-md-offset-2 col-md-4 col-sm-4 col-xs-12">
                        <div class="danh-sach-doi-a">
                            <div class="list-group">
                                <div class="touch-number doi-a">
                                    <div class="" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <input style="width: 100%" max="999" class="input-score text-center form-control-lg mb-2" id="code-a">
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
                                            <button type="button" class="btn btn-outline-secondary py-3 remove-last-number">&lt;</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="0">0</button>
                                            <button type="button" class="btn btn-primary py-3 go-score">Go</button>
                                        </div>
                                        <div class="btn-group notify">
                                            <button type="button" class="btn btn-outline-secondary py-3 btn-click-result select-score" data-id="1">Ghi bàn</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 btn-click-result select-card-yellow" data-id="2">Thẻ vàng</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 btn-click-result select-card-red" data-id="3">Thẻ đỏ</button>
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
                   {{--  <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thong-tin-chi-tiet">
                            <div class="list-group">
                                Chi tiết
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="danh-sach-doi-b">
                            <div class="list-group">
                                <div class="touch-number doi-b">
                                    <div class="" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <input style="width: 100%" max="999" class="input-score text-center form-control-lg mb-2" id="code-b">
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
                                            <button type="button" class="btn btn-outline-secondary py-3 remove-last-number">&lt;</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 select-num" value="0">0</button>
                                            <button type="button" class="btn btn-primary py-3 go-score">Go</button>
                                        </div>
                                        <div class="btn-group notify">
                                            <button type="button" class="btn btn-outline-secondary py-3 btn-click-result select-score" data-id="1">Ghi bàn</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 btn-click-result select-card-yellow" data-id="2">Thẻ vàng</button>
                                            <button type="button" class="btn btn-outline-secondary py-3 btn-click-result select-card-red" data-id="3">Thẻ đỏ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section2">
        
    </div>
    <div class="footer">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>

        <script type="text/javascript" charset="utf-8" async defer>
            $(document).ready(function(){
                $('.touch-number.doi-a .select-num').on('click', function(){
                    var selectA = $('.touch-number.doi-a .input-score').val();
                    var val = $(this).val();
                    $('.touch-number.doi-a .input-score').val(selectA + val);
                })
                $('.touch-number.doi-a .remove-last-number').on('click', function(){
                    var selectA = $('.touch-number.doi-a .input-score').val().slice(0, -1);
                    $('.touch-number.doi-a .input-score').val(selectA);
                });
                $('.touch-number.doi-a .go-score').on('click', function(){
                    $('.touch-number.doi-a .btn-group.notify').addClass('red');
                    $('.touch-number.doi-a .btn-group.notify').trigger('click');
                });
                $('body:not(".touch-number.doi-a .go-score")').on('click', function(){
                    $('.touch-number.doi-a .btn-group.notify').removeClass('red');
                });


                $('.touch-number.doi-b .select-num').on('click', function(){
                    var selectB = $('.touch-number.doi-b .input-score').val();
                    var val = $(this).val();
                    $('.touch-number.doi-b .input-score').val(selectB + val);
                })
                $('.touch-number.doi-b .remove-last-number').on('click', function(){
                    var selectB = $('.touch-number.doi-b .input-score').val().slice(0, -1);
                    $('.touch-number.doi-b .input-score').val(selectB);
                });
                $('.touch-number.doi-b .go-score').on('click', function(){
                    $('.touch-number.doi-b .btn-group.notify').addClass('red');
                    $('.touch-number.doi-b .btn-group.notify').trigger('click');
                });
                $('body:not(".touch-number.doi-b .go-score")').on('click', function(){
                    $('.touch-number.doi-b .btn-group.notify').removeClass('red');
                });

                $('.btn-click-result').on('click', function(){
                    var id = $(this).data('id');
                    var type = '';
                    if (id = 1) {
                        type = 1;
                    } else if (id = 2) {
                        type = 2;
                    } else if (id = 3) {
                        type = 3;
                    }
                    data.type = type;
                    var data = {};
                    alert(id, type);
                    var url = '{{route('detailMatch')}}';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        async: false,
                        success: function (res) {
                            alert('Cập nhật thành công!');
                            window.location.href = '/';
                        }
                    });
                });
            })
        </script>
    </div>
</body>
</html>