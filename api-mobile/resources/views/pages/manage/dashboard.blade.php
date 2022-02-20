@extends('../layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Trang chủ</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">



    <div class="container-fluid">

{{-- 5 san pham ban chay nhat --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Top sản phẩm bán chạy nhất</h3>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>STT</th>

                                    <th>Tên bánh</th>
                                    <th>Số lượng bán được</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $stt = 0;
                            @endphp
                            @foreach ($bestSelling as $item)
                            <tr>
                                <td>
                                    {{++$stt}}
                                </td>
                                <td>{{$item->Name}}</td>
                                <td>
                                    {{$item->so_luong_ban_duoc}}
                                </td>

                            </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.card -->


            </div>
            {{-- 5 khach hang nhieu hoa don nhat --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Khách hàng tiềm năng</h3>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>STT</th>

                                    <th>Tên khách hàng</th>
                                    <th>Số lượng hóa đơn</th>
                                    <th>Tổng tiền thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $stt = 0;
                            @endphp
                            @foreach ($potential as $item)
                            <tr>
                                <td>
                                    {{++$stt}}
                                </td>
                                <td>{{$item->Fullname}}</td>
                                <td>
                                    {{$item->so_luong_hoa_don}}
                                </td>
                                <td>
                                    {{number_format($item->tong_tien_thanh_toan),0}} VNĐ

                                </td>
                            </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.card -->


            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->


    @endsection
