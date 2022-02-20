@extends('../layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý loại bánh </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý loại bánh </li>
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
                            <a class="btn btn-primary" role="button" data-toggle="modal" data-target="#productTypeModal">
                                <i class="fas fa-plus-circle"></i>
                                Thêm mới loại bánh
                            </a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-striped" id="productTable">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên loại bánh</th>
                                        <th>Hình ảnh</th>
                                        <th>Trạng thái</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @php
                                        $stt = 0;
                                    @endphp
                                    @foreach ($productTypes as $category)

                                    <tr id="ptid{{$category->Id}}">
                                        <td>
                                            {{++$stt}}
                                        </td>
                                        <td>{{$category->Name}}</td>
                                        <td>
                                            <img src="/images/ProductTypes/{{$category->Image}}" width="70px" />
                                        </td>
                                        <td>
                                            @if ($category->Status)
                                                <span class="badge badge-success">Hoạt động</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a role="button" >
                                                    <button type="submit" class="btn btn-warning"  data-toggle="modal" data-target="#productTypeModal{{$category->Id}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <div class="modal fade" id="productTypeModal{{$category->Id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel{{$category->Id}}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <form class="needs-validation" enctype="multipart/form-data" method="POST" id="form_update_product_type" action="{{route('update_product_type',['id'=> $category->Id])}}">
                                                          @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật loại bánh</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <section class="content">
                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="card card-primary">
                                                                                        <div class="card-body ">
                                                                                            <div class="form-group">
                                                                                                <label for="exampleInputEmail1">Tên loại bánh </label>
                                                                                                <input type="text" name="name"
                                                                                                    class="form-control" value="{{$category->Name}}">
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label>Hình ảnh</label>
                                                                                                <input type="hidden" name="image"  value="{{$category->Image}}">
                                                                                                <img src="/images/ProductTypes/{{$category->Image}}" class="rounded mx-auto d-block" height="70px" width="70px">
                                                                                                <input type="file" name="image_new" class="form-control" >
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
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
                                                <a  onclick="DeleteProductType('{{$category->Id}}')">
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
                        <div class="modal fade" id="productTypeModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form class="needs-validation" enctype="multipart/form-data" method="POST" action="{{route('insert_product_type')}}" id="form_add_product_type">
                                  @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm loại bánh mới</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <section class="content">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card card-primary">
                                                                <div class="card-body ">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tên loại bánh </label>
                                                                        <input type="text" name="name"
                                                                            class="form-control"
                                                                            placeholder="Nhập loại bánh" >
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label>Hình ảnh</label>
                                                                        <input type="file" name="image" class="form-control">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.container-fluid -->
                                        </section>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" >Thêm mới loại bánh</button>
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
