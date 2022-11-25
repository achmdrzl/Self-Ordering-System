<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Spending;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spendings =
            Spending::groupBy('spendingDate')
            ->selectRaw('*, sum(priceItem) as grandtotal')
            ->orderByRaw('spendingDate DESC')
            ->get();

        return view('employee.manager.spending.index', compact('spendings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'item' => 'required',
            'qty' => 'required',
            'priceItem' => 'required',
        ]);

        $input = $request->all();
        $total = count($request->item);
        foreach ($request->item as $key => $value) {
            Spending::create(
                [
                    'item' => $request->item[$key],
                    'kode' => 'ST_' . date('ymd'),
                    'qty' => $request->qty[$key],
                    'priceItem' => $request->priceItem[$key],
                    'spedingDate' => $request->spendingDate
                ]
            );
        }
        Toastr::success('Penambahan Data Pengeluaran Berhasil!', 'Success', ["progressBar" => true,]);

        return redirect()->route('spending.index')->with([
            'message' => 'Penambahan Data Pengeluaran Berhasil',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Spending $spendings, $id)
    {

        $spendings = Spending::where('kode', $id)->get();
        $date = Spending::where('kode', $id)->first();

        return view('employee.manager.spending.show', compact('spendings', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
