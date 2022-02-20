<?php

namespace App\Http\Controllers;

use App\Mail\UserResertPasswordMail;
use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;

class AccountController extends Controller
{
    //

    public function getAllAccount()
    {
        $data = Account::all();
        //return response()->json($data, 200);
        return json_encode([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function getAccountDetail($id)
    {
        $acc = Account::find($id);
        if (empty($acc)) {
            return json_encode([
                'success' => false,
                'message' => 'Account not found',
            ]);
        }

        return json_encode([
            'success' => true,
            'data' => $acc,
        ]);
    }

    //add
    public function addAccount(Request $request)
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
        $existingAccount = Account::where('Username', $request->Username)->count();
        if ($existingAccount > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Tên tài khoản đã tồn tại'
            ]);
        }

        $existingAccount = Account::where('Email', $request->Email)->count();
        if ($existingAccount > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Email đã tồn tại'
            ]);
        }

        //Tạo ID
        $datetime = Date('Ymdhms');
        $countAllAccount = Account::all()->count() + 1;
        $originalId = $countAllAccount;
        $finalId = 'ACCOUNT' . $datetime . $originalId;
        //----------------------------------------------------------------


        $newAcc = new Account();
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

    public function accountUpdateAdmin(Request $request, $id)
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

        $existingAccount = Account::where('Email', $request->Email)->count();
        if ($existingAccount > 0) {
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
        $existingAccount = Account::where('Id', $id)->count();
        if (!$existingAccount > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Tài khoản không tồn tại'
            ]);
        } else {
            $existingAccount = Account::where('Id', $id)->update([
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


        if ($existingAccount == null) {
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
    public function accountUpdateUser(Request $request, $id)
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

        $existingAccount = Account::where('Email', $request->Email)->count();
        if ($existingAccount > 0) {
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
        $existingAccount = Account::where('Id', $id)->count();
        if (!$existingAccount > 0) {
            return json_encode([
                'success' => false,
                'message' => 'Tài khoản không tồn tại'
            ]);
        } else {
            $existingAccount = Account::where('Id', $id)->update([
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


        if ($existingAccount == null) {
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
    public function deleteAccount($id)
    {
        $acc = Account::find($id);
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
    //login user
    public function login(Request $request)
    {
        // $rule = [
        //     "Username" => "required",
        //     "Password" => "required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
        // ];
        // $customMessage = [
        //     "Username.required" => "Tên tài khoản không được bỏ trống",
        //     "Password.regex" => "Mật khẩu gồm 8 ký tự và Có 1 chữ viết hoa",
        //     "Password.required" => "Mật khẩu không được bỏ trống",
        // ];
        // $validator = Validator::make($request->all(), $rule, $customMessage);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        $user = User::where('Username', $request->Username)->first();
        if (!$user || !Hash::check($request->Password, $user->Password)) {
            return response(['message' => 'The provided credentials are incorrect.'], 401);
        }
        //Tạo token
        $token = $user->createToken('ShopCakeToken')->plainTextToken;
        $response = [
            'user' => $user,
            'user_token' => $token,
        ];
        //$response = $user;
        return response($response, 200);
    }
    public function formlogin()
    {
        return view('pages.login.login');
    }

    public function login_admin(Request $request)
    {
        $user = User::where('Username', $request->Username)->first();
        if (!$user || !Hash::check($request->Password, $user->Password)) {
            alert()->error('Thất bại', 'Tên tài khoản hoặc mật khẩu không chính xác'); // hoặc có thể dùng alert('Post Created','Something went wrong!', 'error');
            return redirect()->route('form.login');
        } elseif (!$user->IsAdmin) {
            alert()->error('Thất bại', 'Vui lòng đăng nhập bằng tài khoản quản trị viên'); // hoặc có thể dùng alert('Post Created','Something went wrong!', 'error');
            return redirect()->route('form.login');
        }
        $request->session()->put('user', $user);
        return redirect()->route('dashboard');
    }
    public function logout_admin(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('form.login');
    }
    public function register(Request $request)
    {
        $rule = [
            "Email" => "required|unique:users",
            "Username" => "required|unique:users|min:5",
            // "Password" => "regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
            // 'Avatar' => 'mimes:jpeg,png,jpg|max:2048',
        ];

        $customMessage = [
            "Email.unique" => "Email đã tồn tại !",
            "Username.unique" => "Tên tài khoản đã tồn tại !",
            "Username.min" => "Tên tài khoản phải lớn hơn 5 ký tự !",
            "Email.required" => "Email không được bỏ trống !",
            "Username.required" => "Tên tài khoản không được bỏ trống",
            //"Password.regex" => "Mật khẩu gồm 8 ký tự và Có 1 chữ viết hoa",
            // "Avatar.mimes" => "Hình ảnh không đúng định dạng",
            // "Avatar.max" => "Hình ảnh không được lớn quá 2MB"
        ];

        $validator = Validator::make($request->all(), $rule, $customMessage);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = new User;
        $user->Username = $request->Username;
        $user->Password = Hash::make($request->Password);
        $user->Email = $request->Email;
        $user->Fullname = $request->Fullname;
        $user->Address1 = $request->Address1;
        $user->Address2 = $request->Address2 != null ? $request->Address2 : '';
        //$user->Address2='';
        $user->Phone = $request->Phone;

        // if ($request->hasFile('Avatar')) {
        //     $image = $request->file('Avatar');
        //     $name = 'User' . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $image->move($destinationPath, $name);
        //     $HinhAnh = $name;
        // } else {
        //     $HinhAnh = "iconUser.png"; // nếu k thì có thì chọn tên ảnh mặc định ảnh mặc định
        // }
        $user->Avatar = 'defaultuse.png';
        $user->IsAdmin = 0;
        $user->otp = "";
        $user->Status = 1;
        $user->save();
        $token = $user->createToken('ShopCakeToken')->plainTextToken;
        return response()->json(['user' => $user, 'user_token' => $token], 201);
    }

    public function logout(Request $request)
    {
        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($token);
            if (!$accessToken) {
                return response()->json([
                    'message' => 'Logout fail',
                ]);
            }

            $accessToken->delete();
            return response()->json([
                'message' => 'Logout successfully',
            ]);
        }
    }

    public function SendMailResetPassword(Request $request)
    {
        $user = User::where('Email', '=', $request->Email)->first();
        if (!$user) {
            return response()->json(['message' => 'Email không hợp lệ'], 400);
        } else {
            $length = 5;
            $otp = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 4, $length); //54548
            $user->otp = $otp;
            $user->save();
            //Mail::to($user->Email)->send(new UserResertPasswordMail($user));
            return response()->json(['message' => 'Email khôi phục đã được gửi'], 200);
        }
    }
    public function ResetPassword(Request $request)
    {
        // $rule = [
        //     "Password" => "regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
        // ];
        // $customMessage = [
        //     "Password.regex" => "Mật khẩu gồm 8 ký tự và Có 1 chữ viết hoa",

        // ];
        // $validator = Validator::make($request->all(), $rule, $customMessage);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }
        $user = User::where('otp', $request->otp)->first();
        if (!$user) {
            return response()->json(['message' => 'OTP không hợp lệ'], 400);
        } else {
            $user->Password = Hash::make($request->Password);
            $user->otp = null;
            $user->save();
            return response()->json([
                'message' => 'Đã thay đổi mật khẩu thành công', 'user' => $user
            ], 200);
        }
    }
}