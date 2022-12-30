@extends('layout.admin')
@section('content-admin')
    <?php
    $stt = 1;
    $user = Auth::user();
    $id_user = $user->id ?? null;
    ?>
    <div class="container-fluid" style="height: 45px">
        @if(session('notification'))
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    <span>{{session('notification')}}</span>
                </div>
            </div>
        @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Thuê OTP</h1>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="alert custom alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Thời gian chờ lấy OTP: <b style="color: red;">15-30 phút</b>
                    </div>
                </div>
            </div>
            <!-- Page Heading -->

            <div class="row" >
                <form action="/getnumber" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group col-md-6">
                        <select name="service"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option value="facebook">Facebook - 900 đ</option>
                        </select>
                        <button class="btn btn-success btn-icon-split" type="submit">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                            <span class="text">Tạo yêu cầu</span>
                        </button>
                    </div>
                </form>

            </div>
            <div class="row">
                <div class="col-xl-12 col-md-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách thuê OTP</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="table-request-detail-use-otp-today_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
{{--                                        <div class="col-sm-12 col-md-6">--}}
{{--                                            <div class="dropdown">--}}
{{--                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                    Hiển thị--}}
{{--                                                </button>--}}
{{--                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                                                    <a class="dropdown-item" href="/thueotp?&quantity=10">10</a>--}}
{{--                                                    <a class="dropdown-item" href="/thueotp?&quantity=25">25</a>--}}
{{--                                                    <a class="dropdown-item" href="/thueotp?&quantity=50">50</a>--}}
{{--                                                    <a class="dropdown-item" href="/thueotp?&quantity=100">100</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-sm-12 col-md-6">
                                            <div id="table-request-detail-use-otp-today_filter" class="dataTables_filter">
                                                <label>Tìm kiếm SĐT:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="table-request-detail-use-otp-today">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered dataTable no-footer" id="table-request-detail-use-otp-today" role="grid" aria-describedby="table-request-detail-use-otp-today_info" style="width: 100%;">
                                                <thead>
                                                <tr role="row">
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Dịch vụ</th>
                                                    <th class="text-center">Giá</th>
                                                    <th class="text-center">Số điện thoại</th>
                                                    <th class="text-center">OTP</th>
{{--                                                    <th class="text-center" >Thời gian</th>--}}
                                                    <th class="text-center" >Trạng thái</th>
                                                    <th class="text-center" ></th>

                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($data as $item)
                                                    <tr role="row">
                                                        <th class="text-center">{{$item->id}}</th>
                                                        <th class="text-center">{{$item->service}}</th>
                                                        <th class="text-center">{{$item->price}}</th>
                                                        <th class="text-center">{{$item->phone}}</th>
                                                        <th class="text-center">{{$item->otp}}</th>
{{--                                                        <th class="text-center" >{{$item->updated_at}}</th>--}}
                                                        @if($item->status == 1)
                                                            <th class="text-center" style="color: green;">Hoàn thành</th>
                                                        @else
                                                            <th class="text-center" style="color: red;">Đang xử lý</th>
                                                            <th class="text-center" >
                                                                <form method="POST" action="/getotp" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <input name="history_id" value="{{$item->id}}"  hidden/>
                                                                    <button type="submit" class="btn btn-success">Lấy OTP</button>
                                                                </form>
                                                            </th>
                                                        @endif
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection
