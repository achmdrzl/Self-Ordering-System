    @extends('layouts.employee')

    @push('style-alt')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @endpush

    @section('content')
        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    {!! Toastr::message() !!}
                    {{-- <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show">
                        {{ session()->get('message') }}
                        <button class="close" type="button" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                @endif
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Data Karyawan</p>
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary mb-3" href="{{ route('employeeData.create') }}"
                                            role="button"><i class="ti-plus btn-icon-append"></i> Tambah Karyawan</a>
                                        {{-- {{ $role->table() }} --}}
                                        <table id="table-id" class="table display expandable-table table-responsive-lg"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Posisi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        {{-- for sweetalert --}}
                                                        <input type="hidden" class="delete_id" value="{{ $user->id }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>
                                                            <div class="badge badge-dark">{{ $user->email }}</div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($user->getRoleNames()))
                                                                @foreach ($user->getRoleNames() as $v)
                                                                    <div class="badge badge-info">{{ strtoupper($v) }}</div>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('employeeData.edit', $user->id) }}"
                                                                class="btn btn-primary btn-md"
                                                                style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                    class="ti-pencil"></i> Edit</a>
                                                            <form action="{{ route('employeeData.destroy', $user->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-md btndelete"
                                                                    style="height:40px"><i
                                                                        class="ti-trash"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Content Add New Employee --}}
            <!-- Modal -->
            {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="background: transparent; border:none;">x</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button class="close" type="button" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="modal-body">
                            <form action="{{ route('store.employee') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2"
                                            style="font-weight: bold">Name</span>
                                        <input type="text" id="payTotal" class="form-control" name="name"
                                            placeholder="Input Name" required />
                                    </div>
                                    <div class="col-md-12 input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2"
                                            style="font-weight: bold">Email</span>
                                        <input type="text" id="payTotal" class="form-control" name="email"
                                            placeholder="Example email 'example@email.com' " required />
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2"
                                            style="font-weight: bold">Password</span>
                                        <input type="password" id="payTotal" class="form-control" name="password"
                                            placeholder="Input Password" required />
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2" style="font-weight: bold">Confirm
                                            Password</span>
                                        <input type="password" id="payTotal" class="form-control" name="password_confirmation"
                                            placeholder="Input Password" required />
                                    </div>
                                    <div class="col-md-12 input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2" style="font-weight: bold">Select
                                            Role</span>
                                        <select class="form-select" name="roles" aria-label="Default select example"
                                            required>
                                            <option selected>-- Roles --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ strtoupper($role->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Save</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                style="color: white">Close</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- End Modal --}}
            <!-- content-wrapper ends -->
        @endsection

        @push('script-alt')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

            <script>
                $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $('.btndelete').click(function(e) {
                        e.preventDefault();

                        var deleteid = $(this).closest("tr").find('.delete_id').val();

                        swal({
                                title: "Apakah anda yakin?",
                                text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {

                                    var data = {
                                        "_token": $('input[name=_token]').val(),
                                        'id': deleteid,
                                    };
                                    $.ajax({
                                        type: "DELETE",
                                        url: 'employeeData/' + deleteid,
                                        data: data,
                                        success: function(response) {
                                            swal(response.status, {
                                                    icon: "success",
                                                })
                                                .then((result) => {
                                                    location.reload();
                                                });
                                        }
                                    });
                                } else {
                                    swal("Cancel!", "Undelete Successfully!", "error");

                                }
                            });
                    });

                });
            </script>
        @endpush
