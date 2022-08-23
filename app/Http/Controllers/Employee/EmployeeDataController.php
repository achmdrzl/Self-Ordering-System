<?php

namespace App\Http\Controllers\Employee;
use App\DataTables\EmployeeDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class EmployeeDataController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:manager']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeDataTable $dataTable)
    {
        // if (request()->ajax()) {
        //     $roles = Role::query();
        //     return DataTables::of($roles)
        //         ->make(true);
        // }

        // $role = DB::table('roles')->get();
        // return DataTables::of($role)->make(true);
        return $dataTable->render('employee.manager.employeeData');
        // return view('employee.manager.employeeData', ['role' => $role]);
    }

    public function getEmployeeData(EmployeeDataTable $dataTable, Request $request){
         if ($request->ajax()) {
            // $role = DB::table('roles')->get();
            $users = DB::table('users')
            ->join('roles', 'users.id', '=', 'roles.id')
            ->select('users.*', 'roles.name')
            ->get();
            return DataTables::of($users)->make(true);
        }
        // $role = DB::table('roles')->get();

        // return Datatables::of($role)
        //     ->addColumn('action', function ($row) {

        //         return '<a href="#edit-'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        //     })
        //     ->editColumn('id', '{{$id}}')
        //     ->make(true);
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
        //
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
