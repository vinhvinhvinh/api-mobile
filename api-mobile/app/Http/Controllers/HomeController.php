<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function index()
    {
        //Sản phẩm bán chạy
        $bestSelling=DB::select('select products.*, SUM(invoice_details.Quantity) as so_luong_ban_duoc
        FROM products, invoice_details
        WHERE products.Id=invoice_details.ProductId
        GROUP BY products.Id
        ORDER BY SUM(invoice_details.Quantity) DESC LIMIT 5');

        //Số bánh tiêu thụ được trong 1 ngày
        $cakePerDay = DB::select('select SUM(invoice_details.Quantity) as tong_san_pham
        from invoice_details, invoices
        WHERE invoice_details.InvoiceId=invoices.Id and DATE(invoices.IssueDate)=DATE(NOW()) and MONTH(invoices.IssueDate)=MONTH(NOW()) and YEAR(invoices.IssueDate)=YEAR(NOW())
        ');

        //Số hóa đơn bán trong ngày
        $invPerDay = DB::select('select COUNT(invoices.Id) as tong_hoa_don
        from invoices
        WHERE DATE(IssueDate)=DATE(NOW()) and MONTH(IssueDate)=MONTH(NOW()) and YEAR(IssueDate)=YEAR(NOW())');

        //Khách hàng tiềm năng
        $potential =  DB::select('select users.*, COUNT(invoices.Id) as so_luong_hoa_don ,SUM(invoices.Total) as tong_tien_thanh_toan from users, invoices
        where users.id=invoices.user_id
        group by users.id
        order by COUNT(invoices.Id) desc LIMIT 5');

        //Doanh thu trong ngay
        $revenuePerDay = DB::select('select SUM(invoices.Total) as doanh_thu_ngay
        from invoices
        WHERE DATE(invoices.IssueDate)=DATE(NOW()) and MONTH(invoices.IssueDate)=MONTH(NOW()) and YEAR(invoices.IssueDate)=YEAR(NOW())');
        //Doanh thu tháng
        $revenuePerMonth = DB::select('select SUM(invoices.Total) as doanh_thu_thang
        from invoices
        WHERE MONTH(invoices.IssueDate)=MONTH(NOW()) and YEAR(invoices.IssueDate)=YEAR(NOW())');
        //dd($revenuePerMonth);
        //dd($revenuePerDay);
        return view('pages.manage.dashboard',compact('bestSelling','cakePerDay','invPerDay','potential','revenuePerDay','revenuePerMonth'));
    }

}
