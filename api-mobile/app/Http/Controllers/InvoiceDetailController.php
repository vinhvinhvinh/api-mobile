<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class InvoiceDetailController extends Controller
{
    public function getAllInvoicedetail()
    {
        $invD = InvoiceDetail::all();
        return json_encode($invD);
    }
    public function findInvoiceDetail($id)
    {
        $invD = InvoiceDetail::find($id);
        return json_encode($invD);
    }
    public static function update_stock($quantity, $product_id)
    {
        $product = Product::find($product_id);
        if ($quantity > $product->Stock) {
            return [
                'status' => false,
                'product' => $product
            ];
        } else {
            $product->Stock -= $quantity;
            $product->save();
            return [
                'status' => true,
            ];
        }
    }
    public static function addInvoiceDetail($invoiceId, $quantity, $unitprice, $product_id)
    {
        $invoiceDetail = new InvoiceDetail;
        $invoiceDetail->InvoiceId = $invoiceId;
        $invoiceDetail->ProductId = $product_id;
        $invoiceDetail->Quantity = $quantity;
        $invoiceDetail->Unitprice = (int)$unitprice;
        $invoiceDetail->Intomoney = (int)$quantity * $unitprice;
        $invoiceDetail->save();
    }
    public function deleteInvoiceDetail($id)
    {
        $cart = Cart::find($id);
        if ($cart != null) {

            $cart->delete();
            return json_encode(['message' => 'Cart deleted successfully'], 200);
        } else {
            return json_encode(['message' => 'Cart not found'], 404);
        }
    }
}