    @extends('layouts.employee')

    @section('content')
        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show">
                        {{ session()->get('message') }}
                        <button class="close" type="button" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Foods Data</p>
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary mb-3" href="{{ route('products.create') }}"><i
                                                class="ti-plus btn-icon-append"></i> Add product</a>
                                        {{-- {{ $role->table() }} --}}
                                        <table id="table-id" cellpadding="5"
                                            class="table display expandable-table table-responsive-md" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name product</th>
                                                    <th>Category</th>
                                                    <th>Price</th>
                                                    <th>Images</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $product->name_product }}</td>
                                                        <td>{{ $product->category->name_category }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>
                                                            @if ($product->gallery)
                                                                <a href="{{ $product->gallery->first()->getUrl() }}"
                                                                    target="_blank">
                                                                    <img src="{{ $product->gallery->first()->getUrl() }}"
                                                                        width="250px" height="250px">
                                                                </a>
                                                            @else
                                                                <span class="badge badge-warning">No Image</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                          <a href="{{ route('products.show', $product->id) }}"
                                                              class="btn btn-warning btn-md text-white" style="width: 50px; height:40px; display:inline-flex; align-items:center; justify-content: center;"><i class="ti-eye"></i></a>
                                                            <a href="{{ route('products.edit', $product->id) }}"
                                                                class="btn btn-primary btn-md" style="width: 50px; height:40px; display:inline-flex; align-items:center; justify-content: center;"><i class="ti-pencil"></i></a>
                                                            <form onclick="return confirm('are you sure?')"
                                                                action="{{ route('products.destroy', $product->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-md" style="width: 50px; height:40px"><i
                                                                        class="ti-trash"></i></button>
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
            <!-- content-wrapper ends -->
        @endsection

        @push('style-alt')
            <style>
                .table #table-id tbody td div {
                    width: 160px;
                    height: 50px;
                    overflow: hidden;
                    word-wrap: break-word;
                }

                .dataTables tbody tr {
                    min-height: 35px;
                    /* or whatever height you need to make them all consistent */
                }

                #table-id tbody>tr>td {
                    white-space: nowrap;
                }
            </style>
        @endpush
