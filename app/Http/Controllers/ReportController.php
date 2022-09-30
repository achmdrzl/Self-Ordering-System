<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Str;


class ReportController extends Controller
{
    public function index()
    {

        $invoices =
            Invoice::groupBy('order_date')
            ->selectRaw('*, sum(total) as grandtotal')
            ->get();

        return view('employee.manager.report.index', compact('invoices'));
    }

    public function setPeriod(Request $request)
    {
        $start = $request->input('startDate');
        $end = $request->input('endDate');

        if($start AND $end){
            $invoices = Invoice::whereBetween('order_date', [$start, $end])->get();
            $total = Invoice::whereBetween('order_date', [$start, $end])->sum('total');

            $payTotal = $invoices->sum('payTotal');
            $payBack = $invoices->sum('PayBack');
        }else{
            $invoices = Invoice::all();
            $total = Invoice::sum('total');
        }

        $customPaper = array(0, 0, 720, 1440);
        $pdf = FacadePdf::loadView('employee.manager.report.reportSalesPDF', compact('invoices', 'total', 'start', 'end', 'payTotal', 'payBack'))->setPaper($customPaper, 'portrait');

        return $pdf->download('INVOICE #' . date("Y/m/d") . '.pdf');

    }
}
