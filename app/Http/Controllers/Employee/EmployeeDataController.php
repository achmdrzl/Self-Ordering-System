<?php

namespace App\Http\Controllers\Employee;
use App\DataTables\EmployeeDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class EmployeeDataController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['role:manager']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeDataTable $dataTable)
    {
        
        $users = User::all();

        $roles = Role::all();

        return view('employee.manager.employee.index', compact('users', 'roles'));
    }

    // public function getEmployeeData(EmployeeDataTable $dataTable, Request $request){
    //      if ($request->ajax()) {
    //         // $role = DB::table('roles')->get();
    //         $users = DB::table('users')
    //         ->join('roles', 'users.id', '=', 'roles.id')
    //         ->select('users.*', 'roles.name')
    //         ->get();
    //         $user
    //         return DataTables::of($users)->make(true);
    //     }
        // $role = DB::table('roles')->get();

        // return Datatables::of($role)
        //     ->addColumn('action', function ($row) {

        //         return '<a href="#edit-'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        //     })
        //     ->editColumn('id', '{{$id}}')
        //     ->make(true);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('employee.manager.employee.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        Toastr::success('Pengguna Berhasil di Tambahkan!', 'Success', ["progressBar" => true,]);

        return redirect()->route('employeeData.index')->with([
            'message' => 'User Created Successfully',
            'type' => 'success', 
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
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('employee.manager.employee.edit', compact('user', 'roles', 'userRole'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        Toastr::info('Kategori Berhasil di Perbarui!', 'Success', ["progressBar" => true,]);

        return redirect()->route('employeeData.index')->with([
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
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['status' => 'Pengguna Berhasil di Hapus!']);
    }
}
