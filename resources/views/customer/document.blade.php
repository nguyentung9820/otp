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
            <h1 class="h3 mb-0 text-gray-800">Tài liệu API</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tạo API key</h6>
                    </div>
                    <div class="card-body">
                        <form class="form-row" method="POST" action="/getApiKey" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="905" id="user_id">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="API key" disabled="disabled" id="api_key" value="{{$data}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <button class="btn btn-success btn-icon-split" type="submit" id="btn-create">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                        <span class="text">Tạo API key</span>
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kiểm tra số dư</h6>
                    </div>
                    <div class="card-body">
                        <h7 class="card-text">Phương thức: <b>GET</b></h7><br>
                        <h7>URL: <code id="__services_post_url" class="text-info">https://code282.com/api/checkBalanceOTP/{apiKey}</code></h7>
                        <br>
                        <h7>
                            Params: <ul>
                                <li><code>{api_key}: API key tài khoản</code></li>
                            </ul>
                        </h7>
                        <h7>
                            <strong>Example Response</strong>
                            <pre style="font-size: 87.5%; color: #FFFFFF; ;word-wrap: break-word; background-color: #272B2E;">
{
    "status": 200,
    "message": "Thành công",
    "balance": 99999
}
                        </pre>
                        </h7>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lấy danh sách dịch vụ</h6>
                    </div>
                    <div class="card-body">
                        <h7 class="card-text">Phương thức: <b>GET</b></h7><br>
                        <h7>URL: <code id="__services_post_url" class="text-info">https://code282.com/api/getServices</code></h7>
                        <br>
                        <h7>
                            <strong>Example Response</strong>
                            <pre style="font-size: 87.5%; color: #FFFFFF; ;word-wrap: break-word; background-color: #272B2E;">
{
  "status": 200,
  "message": "Thành công",
  "data": {
    "id": 10,
    "service_name": "Facebook",
    "price": 900
  }
}
                        </pre>
                        </h7>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thuê số</h6>
                    </div>
                    <div class="card-body">
                        <h7 class="card-text">Phương thức: <b>GET</b></h7><br>
                        <h7>URL: <code id="__services_post_url" class="text-info">https://code282.com/api/createRequestOTP/{api_key}/service_id/{service_id}</code></h7>
                        <br>
                        <h7>
                            Params: <ul>
                                <li><code>{api_key}: API key tài khoản</code></li>
                                <li><code>{service_id}: Id của dịch vụ bạn lấy từ API lấy danh sách dịch vụ</code></li>
                            </ul>
                        </h7>
                        <h7>
                            <strong>Example Response</strong>
                            <pre style="font-size: 87.5%; color: #FFFFFF; ;word-wrap: break-word; background-color: #272B2E;">
{
    "status": 200,
    "message": "Thành công",
    "data":
        {
            "phone": "0583110010",
            "otp_code": "",
            "status": 200,
            "name": "Facebook",
            "price": 900
        }
}
                        </pre>
                        </h7>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lấy OTP</h6>
                    </div>
                    <div class="card-body">
                        <h7 class="card-text">Phương thức: <b>GET</b></h7><br>
                        <h7>URL: <code id="__services_post_url" class="text-info">https://code282.com/api/getOTPCode/{api_key}/phone/{phone_number}</code></h7>
                        <br>
                        <h7>
                            Params: <ul>
                                <li><code>{api_key}: API key tài khoản</code></li>
                                <li><code>{phone_number}: Số điện thoại cần thuê OTP</code></li>
                            </ul>
                        </h7>
                        <h7>
                            <strong>Example Response</strong>
                            <pre style="font-size: 87.5%; color: #FFFFFF; ;word-wrap: break-word; background-color: #272B2E;">
{
    "status": 200,
    "message": "Thành công",
    "otpcode": 10017
}
                        </pre>
                        </h7>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
