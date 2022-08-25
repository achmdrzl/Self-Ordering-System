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
                  <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <p class="card-title">Edit Category</p>
                        <p class="card-description">
                            Complete the following form!
                        </p>
                        <form class="forms-sample" action="{{route('category.update', $category->id)}}" method="POST">
                          
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="nameCategory">Name Category</label>
                                <input type="text" class="form-control" name="name_category" id="nameCategory" placeholder="Name Category" value="{{ old('name_category', $category->name_category) }}">
                            </div>
                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <select type="text" class="form-control" name="category_id" id="parent" placeholder="Name Category">
                                    <option value="">-- Choose Parent --</option>
                                    @foreach($categories as $id => $categoryName)
                                        <option {{$category->category_id === $id ? 'selected' : null }} value="{{$id}}">{{$categoryName}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="photo">Upload Images</label>
                              <div class="needsclick dropzone" id="photoDropzone">
                                
                              </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('category.index')}}" class="btn btn-light">Cancel</a>
                            </div>
                        </form>
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

    @push('style-alt')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush

    @push('script-alt')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.photoDropzone = {
            url: "{{ route('category.storeImg') }}",
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
              $('form').find('input[name="photo"]').remove()
              $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="photo"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
              }
            },
            init: function () {
                @if(isset($category) && $category->photo)
                    var file = {!! json_encode($category->photo) !!}
                        this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, "{{ $category->photo->getUrl() }}")
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input class="mt-5" type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }
                return _results
            }
        }
    </script>
    @endpush

