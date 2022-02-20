<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function getAllComment()
    {
        $data = Comment::all();
        return json_encode($data,
        );
    }
    //Lọc comment theo Id sản phẩm
    public function findCommentByProductId($productId)
    {

        $cmt = DB::table('comments')->join('users','comments.user_id','users.id')->select('comments.*','users.Fullname','users.Avatar')->where('ProductId',$productId)->get();
        return json_encode($cmt);
    }
    // //Lọc comment theo Id account
    // public function findCommentByAccountId($accountId)
    // {

    //     $cmt = Comment::all()->where('AccountId',$accountId);
    //     return json_encode([
    //         'success' => true,
    //         'data' => $cmt,
    //     ]);
    // }

    public function addComment(Request $request)
    {
        //check empty
        if (empty($request->Content)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập nội dung',
            ]);
        }

        $datetime = Date('Ymdhms');
        $countAllComment = Comment::all()->count() + 1;
        $originalId = $countAllComment;
        $finalId = 'COMMENT' . $datetime . $originalId;

        //$accountId = Auth::user()->id;

        $cmt = new Comment();
        $cmt->Id=$finalId;
        $cmt->AccountId= $request->AccountId;
        $cmt->ProductId=$request->ProductId;
        $cmt->Content = $request->Content;
        $cmt->PostedDate=$datetime;
        $cmt->Status=1;
        $cmt->save();

        if ($cmt == null) {
            return json_encode([
                'success' => false,
                'message' => 'Bình luận thất bại',
            ]);
        }

        return json_encode([
            'success' => true,
            'message' => 'Bình luận thành công',
        ]);
    }
    //Sửa bình luận
    public function updateComment(Request $request, $id)
    {
        $cmt = Comment::find($id);
        if (empty($cmt)) {
            return json_encode([
                'success' => false,
                'message' => 'Không tìm thấy bình luận',
            ]);
        }

        //check empty
        if (empty($request->Content)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập nội dung',
            ]);
        }

        //Update

        $cmt->Content = $request->Content;

        $cmt->save();


        if ($cmt == null) {
            return json_encode([
                'success' => false,
                'message' => 'Cập nhật thất bại',
            ]);
        }

        return json_encode([
            'success' => true,
            'message' => 'Cập nhật thành công',
        ]);
    }
    //xóa bình luận
    public function deleteComment($id)
    {

        $cmt = Comment::find($id);
        if (empty($cmt)) {
            return json_encode([
                'success' => false,
                'message' => 'Không tìm thấy bình luận',
            ]);
        }

        $cmt->delete();
        return json_encode([
            'success' => true,
            'message' => 'Xóa thành công',
        ]);
    }
}
