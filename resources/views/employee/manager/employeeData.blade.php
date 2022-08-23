    @extends('layouts.employee')

    @section('content')

    @include('layouts.partials.sidebar')

     <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Employees Data</p>
                  <div class="row">
                    {{-- <button type="button" class="btn btn-primary mb-3"><i class="ti-plus btn-icon-append"></i> Tambah Role</button> --}}
                    <div class="col-12">
                       {{-- {{ $role->table() }} --}}
                      <table id="employee-table" class="table display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Email</th>
                              <th>Roles</th>
                              <th>Create At</th>
                              <th>Update At</th>
                              {{-- <th>Action</th> --}}
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                      </table>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->

    @endsection

    @push('scripts')
      {{$dataTable->scripts()}}
    @endpush