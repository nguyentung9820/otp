@extends('layout.admin')
@section('content-admin')
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
            <h1 class="h3 mb-0 text-gray-800">Nạp tiền</h1>

        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="alert custom alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> Nạp tối thiểu 50.000 VNĐ. Nạp sai chúng tôi hoàn toàn không chịu trách nhiệm
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="alert custom alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Chuyển khoản hoặc quét mã QRCode đúng theo số tài khoản bên dưới và nhập đúng nội dung chuyển tiền <b style="color: green;">(kể cả chữ hoa và thường)</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Nạp tiền</h6>
                    </div>
                    <div class="card-body">
                        <form action="otpcode/transaction/confirm-payment" method="POST" id="form-toptup">
                            <input type="hidden" name="_token" value="74IFD5pEvdAdrdFiKmotAcr2FNciorj4W98bvAr2">
                            <input type="hidden" name="code_payment" value="Z8A7WB">
                            <div class="row mb-2" id="payment_container">
                                <div class="col-md-6 col-lg-6">
                                    <div class="box" style="text-align: center;">
                                        <div class="box-body" style="border-style: solid;border-color: black;">
                                            <img src="{{asset('home/img/Asia_Commercial_Bank_logo.png')}}" height="50px;">
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <td style="text-align: right;">Ngân hàng: </td>
                                                    <td style="text-align: left; color:red">
                                                        <b>ACB</b>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align: right;">Số tài khoản: </td>
                                                    <td style="text-align: left; color: #00cc99;">
                                                        <span style="cursor: pointer" onclick="copyToClipboard($(this))">61993888888</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right;">Chủ tài khoản:
                                                    </td>
                                                    <td style="text-align: left;">
                                                        <b>VU DUY TUNG</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right;">Nội dung chuyển khoản:
                                                    </td>
                                                    <td style="text-align: left; color: red;">
                                                        <span style="cursor: pointer" onclick="copyToClipboard($(this))">ASCBVNVX</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <img class="img-fluid img-thumbnail" style="width: 50%" src="{{asset('home/img/ck.jpg')}}">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
