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
                                <p class="card-title">Foods Data</p>
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary mb-3" href="{{ route('products.create') }}"><i
                                                class="ti-plus btn-icon-append"></i> Add Product</a>
                                        {{-- {{ $role->table() }} --}}
                                        <table id="table-id" cellpadding="5"
                                            class="table display expandable-table table-responsive-md" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name Product</th>
                                                    <th>Category</th>
                                                    <th>Price</th>
                                                    <th>Images</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <input type="hidden" class="delete_id" value="{{ $product->id }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $product->name_product }}</td>
                                                        <td>{{ $product->category->name_category }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>
                                                            @if ($product->gallery)
                                                                <a href="{{ $product->gallery->first()->getUrl() }}"
                                                                    target="_blank">

                                                                    <img src="{{ $product->gallery->first()->getUrl() }}">
                                                                </a>
                                                            @else
                                                                <span class="badge badge-warning">No Image</span>
                                                            @endif
                                                        </td>
                                                        <th>
                                                            <div
                                                                class="badge badge-{{ $product->status === 'unactive' ? 'danger' : 'success' }}">
                                                                {{ strtoupper($product->status) }}</div>
                                                        </th>
                                                        <td>
                                                            <a href="{{ route('products.show', $product->id) }}"
                                                                class="btn btn-info btn-md text-white"
                                                                style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                    class="ti-eye"></i> Detail</a>
                                                            <a href="{{ route('products.edit', $product->id) }}"
                                                                class="btn btn-primary btn-md"
                                                                style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                    class="ti-pencil"></i> Edit</a>
                                                            @if ($product->status === 'unactive')
                                                                <form
                                                                    action="{{ route('products.destroy', $product->id) }}"
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
                                                                    action="{{ route('products.destroy', $product->id) }}"
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
                                        url: 'products/' + deleteid,
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
                                        url: 'products/' + deleteid,
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
