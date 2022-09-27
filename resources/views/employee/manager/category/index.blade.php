    @extends('layouts.employee')

    @section('content')
        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    {{-- <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show">
                        {{ session()->get('message') }}
                        <button class="close" type="button" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    {!! Toastr::message() !!}
                @endif
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Categories Data</p>
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary mb-3" href="{{ route('category.create') }}"><i
                                                class="ti-plus btn-icon-append"></i> Add Category</a>
                                        {{-- {{ $role->table() }} --}}
                                        <table id="table-id" cellpadding="5"
                                            class="table expandable-table table-responsive-md"
                                            style="width:100%; font-size:1.5rem">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name Category</th>
                                                    <th>Images</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <input type="hidden" class="delete_id" value="{{ $category->id }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $category->name_category }}</td>
                                                        <td>
                                                            @if ($category->photo)
                                                                <a href="{{ $category->photo->getUrl() }}" target="_blank">
                                                                    <img src="{{ $category->photo->getUrl() }}"
                                                                        class="img-lg" width="1150px" height="250px">
                                                                </a>
                                                            @else
                                                                <span class="badge badge-warning">No Image</span>
                                                            @endif
                                                        </td>
                                                        <th>
                                                            <div
                                                                class="badge badge-{{ $category->status === 'unactive' ? 'danger' : 'success' }}">
                                                                {{ strtoupper($category->status) }}</div>
                                                        </th>
                                                        <td>
                                                            <a href="{{ route('category.edit', $category->id) }}"
                                                                class="btn btn-primary btn-md"
                                                                style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                    class="ti-pencil"></i> Edit</a>
                                                            @if ($category->status === 'unactive')
                                                                <form
                                                                    action="{{ route('category.destroy', $category->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-md btnactive"
                                                                        style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                            class="ti-cloud-down"></i> Show</button>
                                                                </form>
                                                            @else
                                                                <form
                                                                    action="{{ route('category.destroy', $category->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-md btnunactive"
                                                                        style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                            class="ti-cloud-up"></i> Archive</button>
                                                                </form>
                                                            @endif
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
            <!-- content-wrapper ends -->
        @endsection

        @push('script-alt')
            <script>
                $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $('.btnunactive').click(function(e) {
                        e.preventDefault();

                        var deleteid = $(this).closest("tr").find('.delete_id').val();

                        swal({
                                title: "Apakah anda yakin?",
                                text: "Setelah dinonaktifkan, Pelanggan Tidak akan Bisa Memesan Product Ini Lagi!",
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
                                        url: 'category/' + deleteid,
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
                                    swal("Cancel!", "Perintah dibatalkan!", "error");

                                }
                            });
                    });

                    $('.btnactive').click(function(e) {
                        e.preventDefault();

                        var deleteid = $(this).closest("tr").find('.delete_id').val();

                        swal({
                                title: "Apakah anda yakin?",
                                text: "Setelah diaktifkan, Pelanggan akan Bisa Memesan Product Ini Lagi!",
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
                                        url: 'category/' + deleteid,
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
                                    swal("Cancel!", "Perintah dibatalkan!", "error");

                                }
                            });
                    });

                });
            </script>
        @endpush
