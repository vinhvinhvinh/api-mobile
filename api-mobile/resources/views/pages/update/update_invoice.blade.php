@extends('../layout.master')
@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0">Thông tin đơn hàng</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                  <li class="breadcrumb-item active">Thông tin đơn hàng</li>
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
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <td class="label" width="25%">Mã đơn hàng:</td>
                                <td class="total">
                                    <span class=" amount"><bdi><span class="woocommerce-Price-currencySymbol">{{$invoice->Id}}</span></bdi></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label" width="25%">Khách hàng:</td>
                                <td class="total">
                                    <span class=" amount"><bdi><span class="woocommerce-Price-currencySymbol">{{$invoice->users->Fullname}}</span></bdi></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label" width="25%">Địa chỉ:</td>
                                <td class="total">
                                    <span class=" amount"><bdi><span class="woocommerce-Price-currencySymbol">{{$invoice->users->Address1}}</span></bdi></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label"  width="25%">Số điện thoại:</td>
                                <td class="total">
                                    <span class=" amount"><bdi><span class="woocommerce-Price-currencySymbol">{{$invoice->users->Phone}}</span></bdi></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label"  width="25%">Hình thức thanh toán:</td>
                                <td class="total">
                                    <span class=" amount"><bdi><span class="woocommerce-Price-currencySymbol">{{$invoice->payment->name}}</span></bdi></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label"  width="25%">Thời gian mua:</td>
                                <td class="total">
                                    <span class=" amount"><bdi><span class="woocommerce-Price-currencySymbol">{{date_format(date_create($invoice->IssueDate),'d-m-Y')}}</span></bdi></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label"  width="25%">Trạng thái:</td>
                                <td>
                                   @if ($invoice->order_statuses_id == 1)
                                        <span class="badge badge-danger">{{$invoice->status_order->name}}</span>
                                    @elseif($invoice->order_statuses_id == 2)
                                        <span class="badge badge-success">{{$invoice->status_order->name}}</span>
                                    @elseif($invoice->order_statuses_id == 3)
                                         <span class="badge badge-info">{{$invoice->status_order->name}}</span>
                                    @else
                                        <span class="badge badge-danger">{{$invoice->status_order->name}}</span>
                                   @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="label"  width="25%">Tổng thanh toán:</td>
                                <td class="total">
                                    <span class=" amount"><bdi><span class="woocommerce-Price-currencySymbol myDIV">{{number_format($invoice->Total),0}}</span> VNĐ</bdi></span>
                                </td>
                            </tr>
                            {{-- <tr>
                              
                                <td>
                                    <a class="btn btn-primary" role="button" 
                                    href='#'>
                                        <i class="fas fa-check"></i>

                                    </a>
                                </td>
                                <td width="2%"></td>
                                <td>
                                    <a class="btn btn-outline-dark  " role="button" 
                                    href='#'>
                                        <i class="fas fa-check"></i>
                                      Huỷ
                                    </a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>
      <div class="card-body table-responsive p-0" style="height: 400px;">
        <table class="table table-head-fixed table-striped">
            <thead>

                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $stt = 1;
                @endphp
                @foreach ($invoiceDetail as $detail )
                    <tr>
                        <td>
                            {{$stt++}}
                        </td>
                        <td>
                            <img src="/images/products/{{$detail->products->Image}}" style="width:70px" />
                            <a href="{{route('manage_product')}}" class="wc-order-item-name">{{$detail->products->Name}}</a>
                        </td>
                        <td>{{number_format($detail->Unitprice),0}} VND</td>
                        <td>{{$detail->Quantity}}</td>
                        <td>{{number_format($detail->Intomoney),0}} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</section>
@endsection