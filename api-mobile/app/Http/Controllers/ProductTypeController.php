<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductTypeController extends Controller
{
    //
    public function index()
    {
        $productTypes = ProductType::where('Status', 1)->get();
        return view('pages.manage.productType', compact('productTypes'));
    }
    public function getAllProductType()
    {
        $data = ProductType::all();
        return response()->json($data, 200);
    }

    public function getPTDetail($id)
    {
        $data = ProductType::find($id);
        if (empty($data)) {
            return response()->json([
                'message' => 'Product type not found',
            ], 500);
        }
        return response()->json($data, 200);
    }

    public function addPT(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:product_types',
        ]);
        $error = $validator->errors()->first();
        //Tạo ID
        $datetime = Date('Ymdhms');
        $countAllPT = ProductType::all()->count() + 1;
        $originalId = $countAllPT;
        $finalId = 'PTYPE' . $datetime . $originalId;
        //----------------------------------------------------------------\
        if (!$error) {
            $newPT = new ProductType();
            $newPT->Id = $finalId;
            $newPT->Name = $request->name;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'PTYPE' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/ProductTypes');
                $image->move($destinationPath, $name);
                $image_name = $name;
            } else {
                $image_name = 'meo.jpg'; // nếu k thì có thì chọn tên ảnh mặc định
            }
            $newPT->Image = $image_name;
            $newPT->Status = 1;
            $newPT->save();
            if ($newPT) {
                alert()->success('Thành công', 'Thêm loại bánh thành công'); // hoặc có thể dùng alert('Post Created','Successfully', 'success');
            }
        } else {
            alert()->error('Thất bại', $error); // hoặc có thể dùng alert('Post Created','Successfully', 'success');

        }

        return redirect()->route('manage_productType');
    }

    public function updatePT(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:product_types',
        ]);
        $error = $validator->errors()->first();
        if(!$error) {
            $existingPT = ProductType::find($id);
            $existingPT->Name=$request->name;
            if ($request->hasFile('image_new')) {
                $image = $request->file('image_new');
                $name = 'PTYPE' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/ProductTypes');
                $image->move($destinationPath, $name);
                $image_name = $name;
            } else {
                $image_name = $request->image;
            }
            $existingPT->Image = $image_name;
            $existingPT->save();
            if($existingPT)
            {
                alert()->success('Thành công', 'Chỉnh sửa loại bánh thành công'); // hoặc có thể dùng alert('Post Created','Successfully', 'success');
            }
        }
        else
        {
            alert()->error('Thất bại', $error); // hoặc có thể dùng alert('Post Created','Successfully', 'success');
        }
        return redirect()->route('manage_productType');
    }

    public function deletePT($id)
    {
        $pt = ProductType::find($id);
        $pt->Status = 0;
        $pt->save();
        return response()->json([
            'message' => 'Xóa sản phẩm thành công',
        ]);
    }
}
