<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
  public function index()
  {
    $invoices = Invoice::all();
    return view('pages.manage.invoice', compact('invoices'));
  }
  public function getInvoiceofUser($id)
  {
    $userID = DB::table('invoices')->select('Id')->get();
    if ($userID != null) {
      $data = DB::table('invoices')
        ->join('accounts', 'invoices.AccountId', '=', 'accounts.Id')
        ->join('invoice_details', 'invoices.Id', '=', 'invoice_details.InvoiceId')
        ->join('products', 'invoice_details.ProductId', '=', 'products.Id')
        ->select(
          'invoices.Id as Invoice Id',
          'products.Name as Product Name',
          'accounts.Fullname as User',
          'invoices.ShippingAddress',
          'invoices.PhoneShipping',
          'invoice_details.Quantity',
          'invoice_details.Price',
          'products.Image'
        )
        ->where('invoices.AccountId', $id)->get();
      return json_encode(
        $data

      );
    }
  }

  public function getAllInvoice()
  {
    $invoice = Invoice::all();
    return json_encode($invoice);
  }
  public function findInvoice($id)
  {
    $invoice = Invoice::find($id);
    $invoiceDetail = InvoiceDetail::where('InvoiceId', $id)->get();
    return view('pages.update.update_invoice', compact('invoice', 'invoiceDetail'));
  }
  public function addInvoice(Request $request)
  {
    //tìm user đặt hàng 
    $payUser = User::where('id', $request->userId)->first();


    $datetime = Date('Ymdhms');
    $countAllInv = Invoice::all()->count() + 1;
    $finalId = 'INV' . $datetime . $countAllInv;
    //ok xin lỗi
    DB::beginTransaction();
    $invoice = new Invoice();

    // $count = Invoice::count();
    // if ($count < 9) {
    //   $id = 'INVOICE' . '00' . ($count + 1);
    // } else if ($count < 99) {
    //   $id = 'INVOICE' . '0' . ($count + 1);
    // } else {
    //   $id = 'INVOICE' . ($count + 1);
    // }
    $invoice->Id = $finalId;
    $invoice->user_id = $request->userId;
    $invoice->issueDate = Carbon::now('Asia/Ho_Chi_Minh');
    $invoice->PhoneShipping = ($request->PhoneShipping != null ? $request->PhoneShipping : $payUser->Phone);
    $invoice->ShippingAddress = ($request->ShippingAddress != null ? $request->ShippingAddress : $payUser->Address1);
    $invoice->Total = 0;
    $invoice->Discount = 0;
    $invoice->order_statuses_id = 1;
    $invoice->payments_id = 1;
    $lineItem = $request->lineItem;
    $total = 0;
    $invoice->save();
    foreach ($lineItem as $item) {
      //Kiểm tra sô lượng tổn kho
      $check_stock = InvoiceDetailController::update_stock($item['Quantity'], $item['CakeId']);
      $total += $item['Price'] * $item['Quantity'];
      if ($check_stock['status']) {
        //Thêm chi tiết đơn hàng
        InvoiceDetailController::addInvoiceDetail($invoice->Id, $item['Quantity'], (int)$item['Price'], $item['CakeId']);
      } else {
        DB::rollBack();
        return response()->json([
          'message' => 'sản phẩm ' . $check_stock['product']->Name . ' không được quá ' . $check_stock['product']->Stock
        ]);
      }
    }
    //Xóa cart của user Id
    CartController::deleteCartByAccount($request->userId);
    $invoice->Total = $total;
    $invoice->save();
    DB::commit();
    return response()->json([
      'message' => 'Tạo đơn hàng thành công',
      'data' => $invoice
    ]);
  }
  // public function updateInvoice(Request $request, $id)
  // {
  //     $inv=Invoice::find($id);
  //     if($inv!=null)
  //     {
  //         $inv->AccountId=$request->AccountId;    
  //         $inv->Total=$request->Total;
  //         $inv->ShippingAddress=$request->ShippingAddress;
  //         $inv->PhoneShipping=$request->PhoneShipping;
  //         $inv->Discount=$request->Discount;
  //         $inv->Status=$request->Status;
  //         $inv->update();
  //         return json_encode($inv);
  //     }
  //     else
  //     {
  //         return json_encode(['message'=>'Invoice Update Fail'],404);
  //     }
  // }
  public function deleteInvoice($id)
  {
    $inv = Invoice::find($id);
    if ($inv != null) {
      $inv->delete();
      return json_encode(['message' => 'Invoice deleted successfully'], 200);
    } else {
      return json_encode(['message' => 'Invoice not found'], 404);
    }
  }
}