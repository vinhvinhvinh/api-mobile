<?php

namespace App\Http\Controllers;


use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Alert;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class ProductController extends Controller
{
    //
    public function index()
    {
        $category = ProductType::where('Status', '=', 1)->get();
        $products = Product::where('Status', 1)->get();
        return view('pages.manage.product', compact('category', 'products'));
    }
    public function getAllProduct()
    {
        $data = Product::where('Status', 1)->get();
        return response()->json(
            $data,
            200
        );
    }

    public function getNewProduct()
    {
        $prod = DB::table('products')->orderBy('Date', 'DESC')->take(10)->get();
        return response()->json(
            $prod,
            200
        );
    }


    public function bstSelling()
    {

        $prods =  DB::select('select products.*, SUM(invoice_details.Quantity) as so_luong_ban_ra from products, invoice_details
        where products.Id=invoice_details.ProductId and Status=1
        group by products.Id
        order by SUM(invoice_details.Quantity) desc');

        return response()->json($prods, 200);
    }

    public function getProductByType($typeId)
    {
        // $existingType = ProductType::find($typeId);
        // if ($existingType == null) {
        //     return json_encode([
        //         'success' => false,
        //         'message' => 'Loại không tồn tại',
        //     ]);
        // }

        $prodByType = Product::where('ProductTypeId', $typeId)->where('Status', '1')->get();
        if (($prodByType)->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Không có sản phẩm nào',
            ]);
        } else {
            return json_encode($prodByType, 200);
        }
    }

    public function getProductByFavorite($accountId)
    {
        //AccountId lấy từ thông tin đăng nhập

        $prodByFav = DB::table('products')
            ->join('favorites', 'products.Id', '=', 'favorites.ProductId')
            ->where('favorites.user_id', $accountId)->select('products.*')->get();

        if (($prodByFav)->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Danh sách yêu thích trống',
            ]);
        } else {
            return response()->json($prodByFav);
        }
    }

    public function getProductsInCart($accountId)
    {
        //AccountId lấy từ thông tin đăng nhập

        $prodByCartofAccountId = DB::table('products')
            ->select(['carts.Id as Id', 'products.Id as CakeId', 'products.Name', 'products.Price', 'carts.Quantity', 'products.Image', 'product_types.Name as TypeName', 'carts.user_id as UserId'])
            ->join('carts', 'carts.ProductId', '=', 'products.Id')
            ->join('product_types', 'product_types.Id', '=', 'products.ProductTypeId')
            ->where('carts.user_id', $accountId)->get();
        //dd($prodByCartofAccountId);

        if (($prodByCartofAccountId)->isEmpty()) {
            return response()->json(['message' => 'Blank Cart'], 400);
        } else {
            return response()->json($prodByCartofAccountId, 200);
        }
    }

    public function getProductDetail($id)
    {
        $data = Product::find($id)->join('product_types','products.ProductTypeId','product_types.Id')->select('products.*','product_types.Name as TypeName' )->get();
        if (empty($data)) {
            return json_encode([
                'success' => false,
                'message' => 'Product not found',
            ]);
        }
        return json_encode($data);
    }

    public function add(Request $request)
    {
        $datetime = Date('Ymdhms');
        $countAllProd = Product::all()->count() + 1;
        $originalId = $countAllProd;
        $finalId = 'CAKE' . $datetime . $originalId;
        //----------------------------------------------------------------

        $newProd = new Product();
        $newProd->Id = $finalId;
        $newProd->Name = $request->name;
        $newProd->Price = $request->price;
        $newProd->Stock = $request->stock;
        $newProd->Date = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'Cake' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath, $name);
            $image_name = $name;
        } else {
            $image_name = "meo.jpg"; // nếu k thì có thì chọn tên ảnh mặc định
        }
        $newProd->Image = $image_name;
        $newProd->ProductTypeId = $request->category;
        $newProd->Description = ($request->description) ? $request->description : 'Thông tin';
        $newProd->Status = 1;
        $newProd->save();
        if ($newProd) {
            alert()->success('Thành công', 'Successfully'); // hoặc có thể dùng alert('Post Created','Successfully', 'success');
        } else {

            alert()->error('Thất bại', 'Something went wrong!'); // hoặc có thể dùng alert('Post Created','Something went wrong!', 'error');
        }

        return redirect()->route('manage_product');
    }

    public function update(Request $request, $id)
    {
        $newProd = Product::find($id);
        $newProd->Name = $request->name;
        $newProd->Price = $request->price;
        $newProd->Stock = $request->stock;
        $newProd->Date = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('image_new')) {
            $image = $request->file('image_new');
            $name = 'Cake' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath, $name);
            $image_name = $name;
        } else {
            $image_name = $request->image; // nếu k thì có thì chọn tên ảnh mặc định
        }
        $newProd->Image = $image_name;
        $newProd->ProductTypeId = $request->category;
        $newProd->Description = ($request->description) ? $request->description : 'Thông tin';
        $newProd->Status = 1;
        $newProd->save();
        if ($newProd) {
            alert()->success('Thành công', 'Successfully'); // hoặc có thể dùng alert('Post Created','Successfully', 'success');
        } else {
            alert()->error('Thất bại', 'Something went wrong!'); // hoặc có thể dùng alert('Post Created','Something went wrong!', 'error');
        }
        return redirect()->route('manage_product');
    }


    public function delete($id)
    {
        $product = Product::find($id);
        $product->Status = 0;
        $product->save();
        return response()->json([
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }



    public static function getProductOrdersByProduct($id)
    {
        $products = DB::select('SELECT SUM(Quantity) AS amount FROM invoice_details WHERE ProductId IN (SELECT Id FROM products WHERE Id=  "' . $id . '" )');
        $amounts = $products[0];
        $amount = (int)$amounts->amount;
        return $amount;
    }

    public static function search($key){
        $searchProducts=DB::table('products')->select('products.*')
        ->join('product_types','product_types.Id','products.ProductTypeId')
        ->where('products.Name', 'like','%'.$key.'%')->orWhere('product_types.Name', 'like','%'.$key.'%')
        //->orWhere('products.Description', 'like','%'.$key.'%')
        ->get();
        return response()->json(
            $searchProducts,200
        );
    }
    // public static function search($value){
    //     $searchProducts=DB::select('SELECT products.* FROM products, product_types WHERE ')
    // }

    // public function ProductBestSelling(Request $request)
    // {
    //     $limit  = $request->limit ? $request->limit : 10;
    //     switch ($request->type) {
    //         case 'amount': {
    //                 $prods = [];
    //                 $products = DB::table('invoice_details')->select('ProductId')->groupBy('ProductId')->get();
    //                 foreach ($products as $item) {
    //                     $amount = (int)ProductController::getProductOrdersByProduct($item->ProductId);
    //                     $sp = Product::find($item->ProductId);
    //                     $sp->amount = $amount;
    //                     array_push($prods, $sp);
    //                 }
    //                 usort(
    //                     $prods,
    //                     function ($a, $b) {
    //                         if ($a == $b) {
    //                             return 0;
    //                         }
    //                         return ($a->amount > $b->amount) ? -1 : 1;
    //                     }
    //                 );
    //                 $prods = array_slice($prods, 0, $limit);
    //                 return response()->json($prods);
    //             }
    //             break;
    //         case 'discount': {
    //                 $prods = [];
    //                 $promotion_products = DB::table('invoice_details')->select('ProductId')->groupBy('ProductId')->get();
    //                 foreach ($promotion_products as $item) {
    //                     $sp = Product::find($item->ProductId);
    //                     array_push($prods, $sp);
    //                 }
    //                 usort(
    //                     $prods,
    //                     function ($a, $b) {
    //                         if ($a == $b) {
    //                             return 0;
    //                         }
    //                         return ($a->Price < $b->Price) ? -1 : 1;
    //                     }
    //                 );
    //                 $promotion_products = array_slice($prods, 0, $limit);

    //                 return response()->json($promotion_products);
    //             }
    //             break;
    //         default: {
    //                 $prods = [];
    //                 $products = DB::table('invoice_details')->select('ProductId')->groupBy('ProductId')->get();
    //                 foreach ($products as $item) {
    //                     $amount = (int)ProductController::getProductOrdersByProduct($item->ProductId);
    //                     $sp = Product::find($item->ProductId);
    //                     array_push($prods, $sp);
    //                 }
    //                 usort(
    //                     $prods,
    //                     function ($a, $b) {
    //                         if ($a == $b) {
    //                             return 0;
    //                         }
    //                         return ($a->SoLuong > $b->SoLuong) ? -1 : 1;
    //                     }
    //                 );
    //                 $prods = array_slice($prods, 0, $limit);
    //                 return response()->json($prods);
    //             }
    //             break;
    //     }
    // }
}
