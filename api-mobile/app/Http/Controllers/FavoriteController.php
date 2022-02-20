<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function getAllFavorite()
    {
        $data = Favorite::where('user_id','=',User::user()->id)->all();
        return json_encode([
            'success' => true,
            'data' => $data,
        ]);
    }

    // //Lọc sản phẩm yêu thích theo Id account
    public function findFavoriteByAccountId($accountId)
    {
        $favorite = Favorite::where('user_id',$accountId)->get();
        return json_encode($favorite);
    }

    public function addFavorite(Request $request)
    {

        $datetime = Date('Ymdhms');
        $countAllFavorite= Favorite::all()->count() + 1;
        $originalId = $countAllFavorite;
        $finalId = 'FAVORITE' . $datetime . $originalId;

        //$accountId = Auth::user()->id;

        $favorite = new Favorite();
        $favorite->Id=$finalId;
        $favorite->user_id= $request->user_id;
        $favorite->ProductId=$request->ProductId;
        $favorite->Status=1;
        $favorite->save();

        if ($favorite == null) {
            return json_encode([
                'success' => false,
                'message' => 'Yêu thích thất bại',
            ]);
        }

        return json_encode([
            'success' => true,
            'message' => 'Đã thêm sản phẩm vào danh sách yêu thích',
        ]);
    }

    public function updateFavorite(Request $request, $id)
    {
        $favorite = Favorite::find($id);
        if (empty($favorite)) {
            return json_encode([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm này trong danh sách yêu thích',
            ]);
        }
        $status=$favorite->Status;
        //Update
        if($favorite->Status==1){
            $status=0;
        }
        else{
            $status=1;
        }
        $favorite->Status=$status;
        $favorite->save();


        if ($favorite == null) {
            return json_encode([
                'success' => false,
                'message' => 'Cập nhật thất bại',
            ]);
        }

        return json_encode([
            'success' => true,
            'message' => 'Cập nhật thành công',
            'data'=>$favorite,
        ]);
    }

    //xóa bình luận
    public function deleteFavorite($id)
    {

        $favorite = Favorite::find($id);
        if (empty($favorite)) {
            return json_encode([
                'success' => false,
                'message' => 'Không tìm thấy bình luận',
            ]);
        }

        $favorite->delete();
        return json_encode([
            'success' => true,
            'message' => 'Xóa thành công',
        ]);
    }
}
