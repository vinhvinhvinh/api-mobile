<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function getAllUser()
    {
        $data = User::all();
        return response()->json($data, 200);
    }

    public function getUserDetail($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return json_encode([
                'success' => false,
                'message' => 'User not found',
            ]);
        }

        return response()->json(
            $user,
            200
        );
    }

    //add
    public function addUser(Request $request)
    {
        //Kiểm tra đã nhập tên hay chưa
        if (empty($request->Username)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập tên tài khoản',
            ]);
        }
        //kiểm tra nhập password
        if (empty($request->Password)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập Mật khẩu',
            ]);
        }

        //Kiểm tra nhập email
        if (empty($request->Email)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập Email',
            ]);
        }

        //Kiểm tra  nhập tên
        if (empty($request->Fullname)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập tên ',
            ]);
        }
        //Kiểm tra nhập địa chỉ
        if (empty($request->Address1)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập địa chỉ',
            ]);
        }

        //Kiểm tra nhập phone
        if (empty($request->Phone)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập SDT',
            ]);
        }



        //check exist
        $existingUser = User::where('Username', $request->Username)->count();
        if ($existingUser > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Tên tài khoản đã tồn tại'
            ]);
        }

        $existingUser = User::where('Email', $request->Email)->count();
        if ($existingUser > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Email đã tồn tại'
            ]);
        }

        //Tạo ID
        $datetime = Date('Ymdhms');
        $countAllUser = User::all()->count() + 1;
        $originalId = $countAllUser;
        $finalId = 'USER' . $datetime . $originalId;
        //----------------------------------------------------------------


        $newAcc = new User();
        $newAcc->Id = $finalId;
        $newAcc->Username = $request->Username;
        $newAcc->Password = Hash::make($request->Password);
        $newAcc->Email = $request->Email;
        $newAcc->FullName = $request->Fullname;
        $newAcc->Address1 = $request->Address1;
        $newAcc->Address2 = '';
        $newAcc->Phone = $request->Phone;
        $newAcc->Avatar = '';
        $newAcc->IsAdmin = false;
        $newAcc->Status = 1;

        $newAcc->save();

        if ($newAcc == null) {
            return json_encode([
                'success' => false,
                'message' => 'Thêm thất bại',
            ]);
        }

        return json_encode([
            'success' => true,
            'message' => 'Thêm thành công',
        ]);
    }

    public function userUpdateAdmin(Request $request, $id)
    {


        //Kiểm tra đã nhập tên hay chưa
        if (empty($request->Username)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập tên tài khoản',
            ]);
        }

        //kiểm tra nhập password
        if (empty($request->Password)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập Mật khẩu',
            ]);
        }

        //Kiểm tra nhập email
        if (empty($request->Email)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập Email',
            ]);
        }

        $existingUser = User::where('Email', $request->Email)->count();
        if ($existingUser > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Email đã tồn tại'
            ]);
        }

        //Kiểm tra  nhập tên
        if (empty($request->Fullname)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập tên ',
            ]);
        }
        //Kiểm tra nhập địa chỉ
        if (empty($request->Address1)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập địa chỉ',
            ]);
        }

        //Kiểm tra nhập phone
        if (empty($request->Phone)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập SDT',
            ]);
        }

        //check exist
        $existingUser = User::where('Id', $id)->count();
        if (!$existingUser > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Tài khoản không tồn tại'
            ]);
        } else {
            $existingUser = User::where('Id', $id)->update([
                'Id' => $id,
                'Username' => $request->Username,
                'Password' => Hash::make($request->Password),
                'Email' => $request->Email,
                'Fullname' => $request->Fullname,
                'Address1' => $request->Address1,
                'Address2' => $request->Address2 != null ? $request->Address2 : '',
                'Phone' => $request->Phone,
                'IsAdmin' => false,
                'Status' => 1,
            ]);
        }


        if ($existingUser == null) {
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

    //Update for user
    public function userUpdateUser(Request $request, $id)
    {


        //Kiểm tra đã nhập tên hay chưa
        if (empty($request->Username)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập tên tài khoản',
            ]);
        }

        //Kiểm tra nhập email
        if (empty($request->Email)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập Email',
            ]);
        }
        //Kiểm tra  nhập tên
        if (empty($request->Fullname)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập tên ',
            ]);
        }
        //Kiểm tra nhập địa chỉ
        if (empty($request->Address1)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập địa chỉ',
            ]);
        }

        //Kiểm tra nhập phone
        if (empty($request->Phone)) {
            return json_encode([
                'success' => false,
                'message' => 'Chưa nhập SDT',
            ]);
        }

        //check exist
        $existingUser = User::where('Id', $id)->count();
        if (!$existingUser > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Tài khoản không tồn tại'
            ]);
        } else {
            $existingUser = User::where('Id', $id)->update([
                'Id' => $id,
                'Username' => $request->Username,
                'Email' => $request->Email,
                'Fullname' => $request->Fullname,
                'Address1' => $request->Address1,
                'Address2' => $request->Address2 != null ? $request->Address2 : '',
                'Phone' => $request->Phone,
                'IsAdmin' => false,
                'Status' => 1,
            ]);
        }


        if ($existingUser == null) {
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


    //delete
    public function deleteUser($id)
    {
        $acc = User::find($id);
        if (empty($acc)) {
            return json_encode([
                'success' => false,
                'message' => 'Không tìm thấy tài khoản',
            ]);
        }

        $acc->delete();
        return json_encode([
            'success' => true,
            'message' => 'Xóa thành công',
        ]);
    }
    public function changePassword(Request $request, $accId)
    {
        $user = User::where('Id', $accId)->first();
        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy user'], 400);
        }

        if (Hash::check($request->OldPassword, $user->Password)) {
            $user->Password = Hash::make($request->NewPassword);
            $user->save();
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'Mật khẩu cũ không đúng'], 400);
        }
    }
}
