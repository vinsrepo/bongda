@extends('frontend.pages.layouts.master')
@section('content')
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
                            <h4 class="text-center time_live">30:23</h4>
                            <h5 class="text-center">3-0</h5>
                            <input type="hidden" name="match_id" class="match_id" value="1">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="danh-sach-doi-b">
                            <h4 class="text-center">Giao Thanh</h4>
                        </div>
                    </div>
                </div>
               {{--  <div class="select-player col-xs-12">
                    <h4 class="">Lựa chọn số áo cầu thủ ghi bàn</h4>
                </div> --}}
                <div class="list-cau-thu" style="width: 100%;float: left;">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="danh-sach-doi-a">
                            <div class="list-group">
                                <div class="touch-number doi-a">
                                    <div class="" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <input style="width: 100%" max="999" class="input-score text-center form-control-lg mb-2" id="code-a" placeholder="Điền số áo cầu thủ ghi bàn">
                                            <input type="hidden" name="team_id" class="team_id" value="{{@$teamA->id}}">
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
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thong-tin-chi-tiet">
                            <div class="list-group">
                                Chi tiết
                            </div>
                            <div class="details">
                                @if(@$data['ResultDetail'])
                                    @foreach(@$data['ResultDetail'] as $key => $item)
                                        <div class="item">
                                            <div>
                                                {{@$item->note}} phút thứ {{@$item->time_takes_place}}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="danh-sach-doi-b">
                            <div class="list-group">
                                <div class="touch-number doi-b">
                                    <div class="" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <input style="width: 100%" max="999" class="input-score text-center form-control-lg mb-2" id="code-b" placeholder="Điền số áo cầu thủ ghi bàn">
                                            <input type="hidden" name="team_id" class="team_id" value="{{@$teamB->id}}">
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
                    var parentA = $(this).parent('.touch-number');
                    var parentB = $(this).closest('.touch-number.doi-b');
                    console.log(parentA, parentB);
                    var id = $(this).data('id');
                    var player_id = $('.touch-number.doi-a .input-score').val();
                    if (player_id == '') {
                        alert("Điền số áo cầu thủ thực hiện");
                        return false;
                    }
                    var type = '';
                    if (id == 1) {
                        type = 1;
                    } else if (id == 2) {
                        type = 2;
                    } else if (id == 3) {
                        type = 3;
                    }
                    var data = {};
                    data.type = type;
                    data.player_id = player_id;
                    data.team_id = $('.touch-number.doi-a .team_id').val();
                    data.time_live = $('.time_live').text();
                    data.match_id = $('.match_id').val();
                    $.ajax({
                        url: '{{route('ajaxDetailMatch')}}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        async: false,
                        success: function (res) {
                            alert('Cập nhật thành công!');
                            setTimeout(function(){
                                window.location.href = '/';
                            }, 500);
                        }
                    });
                });
            })
        </script>
    </div>
@endsection