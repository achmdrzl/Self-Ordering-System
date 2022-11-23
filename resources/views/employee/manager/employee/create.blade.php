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
                                                <p class="card-title">Tambah Akun Karyawan Baru</p>
                                                <p class="card-description">
                                                    Harap Lengkapi Seluruh Inputan!
                                                </p>
                                                <form class="forms-sample" action="{{ route('employeeData.store') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name_product">Nama</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" placeholder="Masukkan Nama Karyawan"
                                                            value="{{ old('name') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name_product">Email</label>
                                                        <input type="text" class="form-control" name="email"
                                                            id="email" placeholder="Masukkan Email Karyawan"
                                                            value="{{ old('email') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name_product">Kata Sandi</label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" placeholder="Masukkan Kata Sandi"
                                                            value="{{ old('password') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name_product">Konfirmasi Kata Sandi</label>
                                                        <input type="password" class="form-control" name="confirm-password"
                                                            id="password_confirmation" placeholder="Masukkan Kata Sandi Sekali Lagi"
                                                            value="{{ old('password_confirmation') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category">Posisi Karyawan</label>
                                                        <select type="text" class="form-control" name="roles"
                                                            id="parent" placeholder="Pilih Posisi">
                                                            <option value="">-- Pilih Posisi --</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}">{{ strtoupper($role->name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                                        <a href="{{ route('employeeData.index') }}"
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
