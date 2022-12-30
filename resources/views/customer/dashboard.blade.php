@extends('layout.admin')
@section('content-admin')
    <?php
    $stt = 1;
    $user = Auth::user();
    $id_user = $user->id ?? null;
    ?>
    <div class="container-fluid">
        <div class="container-fluid" style="height: 45px">
            @if(session('notification'))
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        <span>{{session('notification')}}</span>
                    </div>
                </div>
            @endif
        </div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tổng quan</h1>

        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-circle"></i> Hiện tại phục vụ cho dịch vụ <b style="color: red;">Facebook</b>. Dùng số sai mục đích site hoàn toàn không chịu trách nhiệm.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-info">
                    <i class="fas fa-exclamation-circle"></i> Site chỉ hỗ trợ đấu API để lấy số. Vui lòng tham khảo tài liệu API để tích hợp
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-primary">
                    <i class="fas fa-sms"></i> Rate <b style="color: red;">900 vnđ</b> Số Việt. Không giới hạn số luồng. Code về mới trừ tiền
                </div>
            </div>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">--}}
{{--                <div class="alert alert-success">--}}
{{--                    <i class="fas fa-bell"></i> Nhóm Hỗ trợ zalo: <b><a href="https://zalo.me/g/wwzzmu640" target="_blank">https://zalo.me/g/wwzzmu640</a></b>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng tiền nạp</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tong_tien_nap}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số dư
                                </div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$so_du}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Thành công hôm nay</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$success}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Lỗi hôm nay</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$failed}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
