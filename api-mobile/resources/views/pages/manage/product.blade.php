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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary" role="button" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-plus-circle"></i>
                                Thêm mới sản phẩm
                            </a>

                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-striped" id="productTable">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Giá tiền</th>
                                        <th>Tồn kho</th>
                                        <th>Hình ảnh</th>
                                        <th>Thuộc loại</th>
                                        <th>Trạng thái</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $stt = 0;
                                    @endphp
                                    @foreach ($products as $product)

                                    <tr id="pid{{$product->Id}}">
                                        <td>
                                            {{++$stt}}
                                        </td>
                                        <td>{{$product->Name}}</td>
                                        <td>{{number_format($product->Price),0}} VND</td>
                                        <td>{{$product->Stock}}</td>
                                        <td>
                                            <img src="/images/products/{{$product->Image}}" width="70px" />
                                        </td>
                                        <td>{{$product->Category->Name}}</td>
                                        <td>
                                            @if ($product->Status)
                                                <span class="badge badge-success">Hoạt động</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a role="button" >
                                                    <button type="submit" class="btn btn-warning"  data-toggle="modal" data-target="#exampleModal{{$product->Id}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <div class="modal fade" id="exampleModal{{$product->Id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel{{$product->Id}}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <form class="needs-validation" enctype="multipart/form-data" method="POST" action="{{ route('update_product', ['id' => $product->Id]) }}" id="form_update_product">
                                                          @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật sản phẩm</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <section class="content">
                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <!-- left column -->
                                                                            <div class="col-md-12">
                                                                                <!-- jquery validation -->
                                                                                <div class="card card-primary">
                                                                                        <div class="card-body ">
                                                                                            <div class="form-group">
                                                                                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                                                                                <input type="text" name="name"
                                                                                                    class="form-control"
                                                                                                    value="{{$product->Name}}">
                                                                                            </div>
                                                                                            <div class="form-group d-flex ">
                                                                                                <div class="form-group">
                                                                                                    <label>Giá tiền</label>
                                                                                                    <input type="number" name="price"
                                                                                                        class="form-control"
                                                                                                        value="{{$product->Price}}">
                                                                                                </div>
                                                                                                <div class="form-group form_price_stock">
                                                                                                    <label>Số lượng </label>
                                                                                                    <input type="number" name="stock"
                                                                                                        class="form-control"
                                                                                                        placeholder="Nhập số lượng sản phẩm"
                                                                                                        step="1" min="1" value="{{$product->Stock}}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label>Hình ảnh</label>
                                                                                                <input type="hidden" name="image" value="{{$product->Image}}">
                                                                                                <img src="/images/products/{{$product->Image}}" class="rounded mx-auto d-block" height="70px" width="70px">
                                                                                                <input type="file" name="image_new" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label>Thuộc loại</label>
                                                                                                <select class="custom-select" name="category">
                                                                                                    @if ($product->ProductTypeId)
                                                                                                        <option value="{{$product->ProductTypeId}}" >{{$product->category->Name}}</option>
                                                                                                    @endif
                                                                                                  @foreach ($category as $item)

                                                                                                      <option value="{{$item->Id}}">{{$item->Name}}</option>
                                                                                                  @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                          <div class="form-group ">
                                                                                            <label>Mô tả</label>
                                                                                            <textarea class="ckeditor form-control" name="description" value="{{$product->Description}}"></textarea>
                                                                                          </div>
                                                                                        </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">

                                                                            </div>
                                                                            <!--/.col (right) -->
                                                                        </div>
                                                                        <!-- /.row -->
                                                                    </div><!-- /.container-fluid -->
                                                                </section>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                                                            </div>
                                                        </div>
                                                      </form>
                                                    </div>
                                                </div>
                                                </a>
                                                <a  onclick="DeleteProduct('{{$product->Id}}')">
                                                    <button type="button" class="btn btn-danger" id="btn-delete" title="Xóa">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form class="needs-validation" enctype="multipart/form-data" method="POST" action="{{route('insert_product')}}" id="form_add_product">
                                  @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <section class="content">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- left column -->
                                                    <div class="col-md-12">
                                                        <!-- jquery validation -->
                                                        <div class="card card-primary">
                                                                <div class="card-body ">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control"
                                                                            placeholder="Nhập tên sản phẩm" required>
                                                                    </div>
                                                                    <div class="form-group d-flex ">
                                                                        <div class="form-group">
                                                                            <label>Giá tiền</label>
                                                                            <input type="number" name="price"
                                                                                class="form-control"
                                                                                placeholder="Nhập giá tiền sản phẩm">
                                                                        </div>
                                                                        <div class="form-group form_price_stock">
                                                                            <label>Số lượng </label>
                                                                            <input type="number" name="stock"
                                                                                class="form-control"
                                                                                placeholder="Nhập số lượng sản phẩm"
                                                                                step="1" min="1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label>Hình ảnh</label>
                                                                        <input type="file" name="image"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label>Thuộc loại</label>
                                                                        <select class="custom-select" name="category">
                                                                          @foreach ($category as $item)
                                                                              <option value="{{$item->Id}}">{{$item->Name}}</option>
                                                                          @endforeach
                                                                        </select>
                                                                    </div>
                                                                  <div class="form-group ">
                                                                    <label>Mô tả</label>
                                                                    <textarea class="ckeditor form-control" name="description"></textarea>
                                                                  </div>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">

                                                    </div>
                                                    <!--/.col (right) -->
                                                </div>
                                                <!-- /.row -->caapj
                                            </div><!-- /.container-fluid -->
                                        </section>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" >Thêm mới sản phẩm</button>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
