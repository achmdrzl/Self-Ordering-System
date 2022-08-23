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
                  <p class="card-title">Create Category</p>
                  <a class="btn btn-primary mb-3" href="{{route('category.index')}}"><i class="ti-back-left btn-icon-append"></i> Go Back</a>
                  <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <p class="card-description">
                            Complete the following form!
                        </p>
                        @foreach($categories as $category)
                        <form class="forms-sample" action="{{route('category.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nameCategory">Name Category</label>
                                <input type="text" class="form-control" name="name_category" id="nameCategory" placeholder="Name Category" value="{{$category->name_category}}">
                            </div>
                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <select type="text" class="form-control" name="category_id" id="parent" placeholder="Name Category">
                                    <option value="">-- Choose Parent --</option>
                                    <option value="{{$category->category_id}}">{{$category->name_category}}"</option>
                                    {{-- @foreach($categories as $id => $category)
                                        <option value="{{$id}}">{{$category}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </div>
                        </form>
                        @endforeach
                        </div>
                    </div>
                    </div>
                  </div>
                  </div>
                </div>               
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->

    @endsection
