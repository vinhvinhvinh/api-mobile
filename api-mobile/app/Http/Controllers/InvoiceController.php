<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
  public function index(){
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
    $invoiceDetail = InvoiceDetail::where('InvoiceId',$id)->get();
    return view('pages.update.update_invoice',compact('invoice','invoiceDetail'));
  }
  public function addInvoice(Request $request)
  {
    DB::beginTransaction();
    $invoice = new Invoice();
    $count = Invoice::count();
    if ($count < 9) {
      $id = 'Invoice' . '00' . ($count + 1);
    } else if ($count < 99) {
      $id = 'Invoice' . '0' . ($count + 1);
    } else {
      $id = 'Invoice' . ($count + 1);
    }
    $invoice->Id = $id;
    $invoice->user_id = $request->user_id;
    $invoice->issueDate = Carbon::now('Asia/Ho_Chi_Minh');
    $invoice->Total = 0;
    $invoice->Discount = 0;
    $invoice->order_statuses_id = $request->order_statuses_id;
    $invoice->payments_id = $request->payments_id;
    $lineItem = $request->lineItem;
    $total = 0;
    $invoice->save();
    foreach ($lineItem as $item) {
      $check_stock = InvoiceDetailController::update_stock($item['Quantity'], $item['id']);
      $total += $item['unitprice'] * $item['Quantity'];
      if ($check_stock['status']) {
        InvoiceDetailController::addInvoiceDetail($invoice->Id, $item['Quantity'], (int)$item['unitprice'], $item['id']);
      } else {
        DB::rollBack();
        return response()->json([
          'message' => 'sản phẩm ' . $check_stock['product']->Name . ' không được quá ' . $check_stock['product']->Stock
        ]);
      }
    }
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
