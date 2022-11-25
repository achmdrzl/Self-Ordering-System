<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Spending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Str;


class ReportController extends Controller
{
    public function index()
    {
        $reports = DB::table('spendings')
            ->join('invoices', 'spendings.spendingDate', '=', 'invoices.order_date')
            ->select('invoices.*', 'spendings.item', 'spendings.priceItem', DB::raw('SUM(invoices.total) as totalIncome'), DB::raw('SUM(spendings.priceItem) as totalSpend') )
            ->groupBy('invoices.order_date')
            ->get();
        
        return view('employee.manager.report.index', compact('reports'));
    }


    // SELECT invoices.*, SUM(invoices.total) AS totalIncome, spendings.item, SUM(spendings.priceItem) AS totalSpend, spendings.qty FROM invoices JOIN spendings ON spendings.spendingDate = invoices.order_date WHERE spendings.spendingDate BETWEEN "2022-11-22" AND "2022-11-26" GROUP BY spendings.spendingDate;


    public function setPeriod(Request $request)
    {
        $start = $request->input('startDate');
        $end = $request->input('endDate');

        if ($start and $end) {
            // Rincian Pesanan Restoran
            $invoices = Invoice::whereBetween('order_date', [$start, $end])->get();
            $total = Invoice::whereBetween('order_date', [$start, $end])->sum('total');
            $totalPay = Invoice::whereBetween('order_date', [$start, $end])->sum('payTotal');

            // Rincian Pengeluaran Restoran
            $spendings = Spending::whereBetween('spendingDate', [$start, $end])->get();
            $total2 = Spending::whereBetween('spendingDate', [$start, $end])->sum('priceItem');
            $qty = Spending::whereBetween('spendingDate', [$start, $end])->sum('qty');

            // Rincian Pendapatan Restoran
            $reports = DB::table('spendings')
            ->join('invoices', 'spendings.spendingDate', '=', 'invoices.order_date')
            ->select('invoices.*', 'spendings.item',
                'spendings.priceItem',
                DB::raw('SUM(invoices.total) as totalIncome'),
                DB::raw('SUM(spendings.priceItem) as totalSpend')
            )
            ->whereBetween('invoices.order_date', [$start, $end])
            ->groupBy('invoices.order_date')
            ->get();

            $payTotal = $invoices->sum('payTotal');
            $payBack = $invoices->sum('PayBack');
        } else {
            $invoices = Invoice::all();
            $total = Invoice::sum('total');

            $spendings = Spending::all();
            $total2 = Spending::sum('priceItem');
            $qty = Spending::sum('qty');
        }

        $customPaper = array(0, 0, 720, 1440);
        $pdf = FacadePdf::loadView('employee.manager.report.reportSalesPDF', compact('invoices', 'spendings', 'reports', 'total', 'total2',  'start', 'end', 'totalPay', 'payTotal', 'payBack', 'qty'))->setPaper($customPaper, 'portrait');

        return $pdf->download('INVOICE #' . date("Y/m/d") . '.pdf');
    }
}
