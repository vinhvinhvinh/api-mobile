@extends('../layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-striped" id="productTable">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Tên người mua</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($invoices as $invoice)                                     
                                    <tr>
                                        <td>
                                            {{$invoice->Id}}
                                        </td>
                                        <td>{{$invoice->users->Fullname}}</td>
                                        <td>{{$invoice->IssueDate}}</td>
                                        <td>{{number_format($invoice->Total,0)}} VND</td>
                                        <td>
                                            @if ( $invoice->order_statuses_id == 1)
                                                <span class="badge badge-warning">{{$invoice->status_order->name}}</span>
                                            @elseif($invoice->order_statuses_id == 2)
                                                <span class="badge badge-success">{{$invoice->status_order->name}}</span>
                                            @elseif($invoice->order_statuses_id == 3)
                                                 <span class="badge badge-info">{{$invoice->status_order->name}}</span>
                                            @else
                                                <span class="badge badge-danger">{{$invoice->status_order->name}}</span>
                                            @endif
                                            </td>                                       
                                        <td>
                                            <div class="btn-group">
                                                <a role="button" href="{{route('OrderDetail',['id' => $invoice->Id])}}">
                                                    <button type="submit" class="btn btn-warning" >
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
