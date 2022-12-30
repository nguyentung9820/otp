@extends('layout.admin')
@section('content-admin')
    <?php
    $stt = 1; $user = Auth::user();
    $id_user = $user->id ?? null;
    ?>
    <form action="{{route('UpdateAccount')}}" id="submit" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
    </form>

    <div class="container-fluid">
        <div class="row" style="padding-top: 3%;padding-bottom: 1%;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 style="text-align: center">Sửa tài khoản</h2>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="height: 60px; line-height:60px; padding: 0 0 20px 0">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="float: left;">
                @if(session('notification'))
                    <span style="padding-left: 20px; color: red">
                                <i class="fas fa-times" style="color: red"></i>
                                {{session('notification')}}
                            </span>
                @endif
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div style="float: right; padding-right:15px">
                    <button title="Back" class="btn btn-outline-info" type="button">
                        <a href="/admin/home" style="color: black">
                            <i class="fas fa-arrow-left"></i><span> Quay lại</span>
                        </a>
                    </button>
                    <input type="button" class="btn btn-outline-danger" value="Xóa" data-toggle="modal"
                           data-target="#deleteModal">
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                         aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <span>Bạn chắc chắn muốn xóa tài khoản này chứ?</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                            data-dismiss="modal">
                                        Cancel
                                    </button>
                                    <a class="btn btn-outline-danger"
                                       href="/admin/delete/delete_user/{{$data->id}}">Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary" form="submit"><i class="fas fa-save"></i>
                        Lưu
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid card z-index-2" style="width:75%">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style=" border-right: 15px solid #F4F6F9;">
                <div>
                    <div style="height:5px"></div>
                    <span style="width:100%; text-align: center" class="nav-link"><i
                            class="fas fa-address-card"></i> Thông tin</span>
                    <div style="height:5px"></div>
                </div>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                <div style="height:10px"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><span>Email <span
                                    style="color: red">*</span></span></div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><i
                                            class="fas fa-envelope"></i></span>
                                </div>
                                <input value="{{$data->email}}" type="email" name="email" style="width:100%"
                                       aria-describedby="inputGroup-sizing-default" class="form-control"
                                       form="submit" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height:10px"></div>
                <div style="height:10px"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><span>Trạng thái <span
                                    style="color: red">*</span></span></div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="input-group mb-3" style="padding:0 0 0 20px">
                                <div class="form-check form-switch">
                                    @if($data->is_active == 1)
                                        <?php
                                        $checked = 'checked';
                                        $lableDefault = 'Active';
                                        ?>
                                    @else
                                        <?php
                                        $checked = '';
                                        $lableDefault = 'Disable';
                                        ?>
                                    @endif
                                    <input class="form-check-input" onclick="isActive()" name="is_active"
                                           type="checkbox" id="flexSwitchCheckChecked"
                                           {{$checked}} form="submit">
                                    <label class="form-check-label" id="lable_active"
                                           for="flexSwitchCheckChecked">{{$lableDefault}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height:10px"></div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><span>Số dư<span
                                    style="color: red">*</span></span></div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><i
                                            class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input value="{{$data->money}}" type="number" name="money" style="width:100%"
                                       aria-describedby="inputGroup-sizing-default" class="form-control"
                                       form="submit">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <input type="text" name="id" value="{{$data->id}}" form="submit" hidden>
            <script>
                function isActive() {
                    var checkbox = document.getElementById("flexSwitchCheckChecked").checked;
                    if (checkbox == true) {
                        document.getElementById("lable_active").innerHTML = 'Active';
                    } else {
                        document.getElementById("lable_active").innerHTML = 'Disable';
                    }
                }
            </script>
@endsection

