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
                    <a class="btn btn-primary mb-3" href="{{route('category.create')}}"><i class="ti-plus btn-icon-append"></i> Add Category</a>
                    <div class="col-12">
                       {{-- {{ $role->table() }} --}}
                      <table id="table-id" class="table display expandable-table table-responsive-md" style="width:100%">
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
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->name_category}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->img_category}}</td>
                                <td>{{$category->parent->name_category ?? 'Null' }}</td>
                                <td>
                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary btn-sm"><i class="ti-pencil"></i></a>
                                    <form action="{{route('category.destroy', $category->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="ti-trash"></i></button>
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

    {{-- @push('scripts')
      {{$dataTable->scripts()}}
    @endpush --}}