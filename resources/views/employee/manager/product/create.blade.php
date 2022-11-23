    @extends('layouts.employee')

    @section('content')
        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
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
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-title">Tambah Menu Makanan Baru</p>
                                                <p class="card-description">
                                                    Harap Lengkapi Seluruh Inputan!
                                                </p>
                                                <form class="forms-sample" action="{{ route('products.store') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name_product">Nama Menu Makanan</label>
                                                        <input type="text" class="form-control" name="name_product"
                                                            id="name_product" placeholder="Masukkan Nama Menu Makanan"
                                                            value="{{ old('name_product') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category">Kategori Menu</label>
                                                        <select type="text" class="form-control" name="category_id"
                                                            id="parent" placeholder="Name product">
                                                            <option value="">-- Pilih Kategori Menu --</option>
                                                            @foreach ($categories as $id => $categoryName)
                                                                <option value="{{ $id }}">{{ $categoryName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="price">Harga Menu Makanan</label>
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" placeholder="Masukkan Harga Menu Makanan"
                                                            value="{{ old('price') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Deskripsi Menu Makanan</label>
                                                        <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                                                            placeholder="Masukkan Deskripsi Menu Makanan" value="{{ old('description') }}">{{ old('description') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="details">Detail Menu Makanan</label>
                                                        <textarea class="form-control" name="details" id="details" cols="30" rows="5" placeholder="Masukkan Detail Menu Makanan"
                                                            value="{{ old('details') }}">{{ old('details') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gallery">Unggah Gambar Menu Makanan</label>
                                                        <div class="needsclick dropzone" id="galleryDropzone"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                                        <a href="{{ route('products.index') }}"
                                                            class="btn btn-light">Batal</a>
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
                var uploadedGalleryMap = {}
                Dropzone.options.galleryDropzone = {
                    url: "{{ route('products.storeImg') }}",
                    maxFilesize: 2, // MB
                    acceptedFiles: '.jpeg,.jpg,.png,.gif',
                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(file, response) {
                        $('form').append('<input type="hidden" name="gallery[]" value="' + response.name + '">')
                        uploadedGalleryMap[file.name] = response.name
                    },
                    removedfile: function(file) {
                        file.previewElement.remove()
                        var name = ''
                        if (typeof file.file_name !== 'undefined') {
                            name = file.file_name
                        } else {
                            name = uploadedGalleryMap[file.name]
                        }
                        $('form').find('input[name="gallery[]"][value="' + name + '"]').remove()
                    },
                    init: function() {
                        @if (isset($product) && $product->gallery)
                            var files =
                                {!! json_encode($product->gallery) !!}
                            for (var i in files) {
                                var file = files[i]
                                this.options.addedfile.call(this, file)
                                this.options.thumbnail.call(this, file, file.original_url)
                                file.previewElement.classList.add('dz-complete')
                                $('form').append('<input type="hidden" name="gallery[]" value="' + file.file_name + '">')
                            }
                        @endif
                    },
                    error: function(file, response) {
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
