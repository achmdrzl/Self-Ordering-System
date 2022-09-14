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
                                <p class="card-title">Categories Data</p>
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary mb-3" href="{{ route('category.create') }}"><i
                                                class="ti-plus btn-icon-append"></i> Add Category</a>
                                        {{-- {{ $role->table() }} --}}
                                        <table id="table-id" cellpadding="5"
                                            class="table expandable-table table-responsive-md" style="width:100%; font-size:1.5rem">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name Category</th>
                                                    <th>Slug</th>
                                                    <th>Images</th>
                                                    <th>Parents</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $category->name_category }}</td>
                                                        <td>{{ $category->slug }}</td>
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
                                                        <td>{{ $category->parent->name_category ?? 'Null' }}</td>
                                                        <td>
                                                            <a href="{{ route('category.edit', $category->id) }}"
                                                                class="btn btn-primary btn-md"
                                                                style="width: 50px; height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                    class="ti-pencil"></i></a>
                                                            <form onclick="return confirm('are you sure?')"
                                                                action="{{ route('category.destroy', $category->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-md" style="width: 50px; height:40px;"><i
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
