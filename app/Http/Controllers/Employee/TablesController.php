<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Brian2694\Toastr\Facades\Toastr;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('no_table', 'DESC')->get();

        return view('employee.manager.tables.index', compact('customers'));
    }

    public function getTables()
    {
        $tables = Customer::all();
        return response()->json([
            'status' => 200,
            'tables' => $tables
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.manager.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest $request)
    {
        $this->validate($request, [
            'no_table' => 'required', 'unique:customers,no_table'
        ]);

        $input = $request->all();
        $customer = Customer::create($input);
        Toastr::success('Nomor Meja Berhasil di Tambahkan!', 'Success', ["progressBar" => true,]);

        return redirect()->route('tables.index')->with([
            'message' => 'New Table Created Successfully',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Customer::find($id);

        return view('employee.manager.tables.edit', compact('table'));
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
        $this->validate($request, [
            'no_table' => 'required|unique:customers,no_table'
        ]);

        $input = $request->all();
        $table = Customer::find($id);
        $table->update($input);

        Toastr::info('Nomor Meja Berhasil di Perbarui!', 'Success', ["progressBar" => true,]);

        return redirect()->route('tables.index')->with([
            'message' => 'User Updated Successfully',
            'type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $tables, $id)
    {
        if ($tables->status == 'unactive') {
            $tables->update([
                'status' => 'Free'
            ]);
            return response()->json(['status' => 'Nomor Meja Aktif!']);
        } else {
            $tables->update([
                'status' => 'unactive'
            ]);

            return response()->json(['status' => 'Nomor Meja Tidak Aktif!']);
        }
    }

    public function printTable($id)
    {
        $table = Customer::where('id', $id)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('http://localhost:8000/set/' . $table->no_table));
        // $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('https://www.ogani-shop.my.id/set/' . $table->no_table));

        $customPaper = array(0, 0, 720, 1440);
        $pdf = FacadePdf::loadView('employee.manager.tables.printTable', compact('table', 'qrcode'))->setPaper($customPaper, 'portrait');

        return $pdf->download('Table - ' . strtoupper($table->no_table) . '.pdf');
    }
}
