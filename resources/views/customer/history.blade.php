@extends('layout.admin')
@section('content-admin')
    <?php
    $stt = 1;
    $user = Auth::user();
    $id_user = $user->id ?? null;
    ?>
    @if(!empty($id_user))
        <div class="container-fluid">
            <div style="padding-top: 3%; text-align: center">
                <h2>History</h2>
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
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">ID</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Số tiền nạp</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Thời gian</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Trạng thái</th>
                    </tr>
                    @foreach($data as $item)
                        <tr class="odd gradeX" align="center">
                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1">{{$item->id}}</td>
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$item->new_money - $item->old_money}}</td>
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$item->created_at}}</td>
                            <td style="color: green" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Thành công</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@endsection
