<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Account;


use Illuminate\Http\Request;


class CartController extends Controller
{

    function getCartofUser($id)
    {
        $userID = DB::table('carts')->select('Id')->get();
        if ($userID != null) {
            $data = DB::table('carts')
                ->join('accounts', 'carts.AccountId', '=', 'accounts.Id')
                ->join('products', 'carts.ProductId', '=', 'products.Id')
                ->select('carts.Id', 'products.Name', 'products.Price', 'carts.Quantity', 'products.Stock', 'products.Image')
                ->where('carts.AccountId', $id)->get();
            return json_encode(
                $data,
            );
        }
    }

    public function getAllCart()
    {
        $carts = Cart::all();
        return json_encode($carts);
    }
    public function findCart($id)
    {
        $carts = Cart::find($id);
        return json_encode($carts);
    }
    public function addCart(Request $request)
    {
        $cart = Cart::where('user_id', $request->userId)
            ->where('ProductId', $request->ProductId)->first();
        if ($cart == null) {
            $cart = new Cart;
            $cart->user_id = $request->userId;
            $cart->ProductId = $request->ProductId;
            $cart->Quantity = $request->Quantity;
            $cart->save();
        } else {
            $cart->Quantity += $request->Quantity;
            $cart->save();
        }

        return json_encode($cart, 200);
    }
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($cart != null) {
            $cart->Quantity = $request->Quantity;
            $cart->update();
            return json_encode($cart);
        } else {
            return json_encode(['message' => 'Cart Update Fail'], 404);
        }
    }

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        if ($cart != null) {
            $cart->delete();
            return json_encode(['message' => 'Cart deleted successfully'], 200);
        } else {
            return json_encode(['message' => 'Cart not found'], 500);
        }
    }

    public static function deleteCartByAccount($accId)
    {

        $cart = Cart::where('user_id', $accId)->get();

        if (!$cart->isEmpty()) {
            foreach ($cart as $item) {
                $item->delete();
            }
            return json_encode(['message' => 'Cart deleted successfully'], 200);
        } else {
            return json_encode(['message' => 'Cart not found'], 500);
        }
    }
    public function updateCartQuantity(Request $request, $id)
    {
        $cart = Cart::find($id);

        if ($cart != null) {
            $cart->Quantity += $request->Quantity;
            $cart->update();
            return json_encode(['message' => 'Cart updated successfully'], 200);
        } else {
            return json_encode(['message' => 'Cart not found'], 500);
        }
    }
}