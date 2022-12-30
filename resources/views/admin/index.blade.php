@extends('layout.admin')
@section('content-admin')
    <?php
    $stt = 1;
    $user = Auth::user();
    $id_user = $user->id ?? null;
    $id_admin = $user->is_admin;
    ?>
    @if($id_admin)
    <div class="container-fluid">
        <div style="padding-top: 3%; text-align: center">
            <h2>Dashboard</h2>
        </div>

        <div class="container-fluid" style="height: 45px">
            @if(session('notification'))
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        <span>{{session('notification')}}</span>
                    </div>
                </div>
            @endif
        </div>

        <div style="height:45px"></div>
        <div class="table-responsive">
            <table class="table table-bordered container-fluid" id="dataTables-example"
                   style="width: 95%;">
                <tr align="center" style="background:#103D8F;color: #fff">
                    <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">STT</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Email</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Trạng thái</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Số dư</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></th>
                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></th>
                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></th>
                </tr>
                @foreach($data as $item)
                    <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="/admin/account/add_money/{{$item->id}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <span>Xác nhận nạp tiền (VNĐ)</span>
                                        <input name="money" class="form-control form-control-sm" type="number" required/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                                data-dismiss="modal">
                                            Hủy bỏ
                                        </button>
                                        <button type="submit" class="btn btn-outline-danger">Nạp</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <tr class="odd gradeX" align="center">
                        <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1">{{$stt}}</td>
                        <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$item->name}}</td>
                        @if($item->is_active == 1)
                            <td style="color: green" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Hoạt động</td>
                        @else
                            <td style="color: red" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Đã vô hiệu</td>
                        @endif
                        <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$item->money}}</td>
                        <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a
                                href="/admin/account/edit_account/{{$item->id}}"><i
                                    class="fas fa-edit"></i></a></td>
                        <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <input type="button" class="btn btn-outline-danger" value="Nạp tiền" data-toggle="modal"
                                   data-target="#deleteModal{{$item->id}}">
                        </td>
                        @if($item->is_active == 1)
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="/admin/account/block/{{$item->id}}"><button type="button" class="btn btn-danger">Block</button></a></td>
                        @else
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><a href="/admin/account/open/{{$item->id}}"><button type="button" class="btn btn-success">Open</button></a></td>
                        @endif
                    </tr>
                        <?php $stt++ ?>
                @endforeach
            </table>
        </div>
    </div>
    @endif

@endsection
