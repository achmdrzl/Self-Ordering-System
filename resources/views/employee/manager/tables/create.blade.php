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
                                                <p class="card-title">Tambah No. Meja Baru</p>
                                                <p class="card-description">
                                                    Harap Lengkapi Seluruh Inputan!
                                                </p>
                                                <form class="forms-sample" action="{{ route('tables.store') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="no_tables">Nomor Meja</label>
                                                        <input type="number" class="form-control" name="no_table"
                                                            id="no_tables" placeholder="Masukkan Nomor Meja"
                                                            value="{{ old('no_tables') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                                        <a href="{{ route('tables.index') }}"
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

