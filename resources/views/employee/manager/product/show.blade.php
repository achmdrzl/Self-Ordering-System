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
                                                <p class="card-title">Detail Menu : <span>{{$product->name_product}}</span></p>
                                                <table class="table table-hover mb-4">
                                                    <tr>
                                                        <th>Gambar Menu Makanan</th>
                                                        <td colspan="6"></td>
                                                    </tr>
                                                    <tr>
                                                        @forelse ($product->getMedia('gallery') as $gallery)
                                                            <th>
                                                                <div class="col-lg-4 col-md-4 col--sm-6">
                                                                    <a href="{{ $gallery->getFullUrl() }}" target="_blank">
                                                                        <img src="{{ $gallery->getFullUrl() }}"
                                                                            alt="Image Products" class="img-fluid" >
                                                                    </a>
                                                                </div>
                                                            </th>
                                                        @empty
                                                            <th><span class="badge bagde-warning">Tidak Ada Gambar</span></th>
                                                        @endforelse
                                                    </tr>
                                                    <tr>
                                                        <th>Deskripsi Menu Makanan</th>
                                                        <td colspan="6">{{ $product->description }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Details Product</th>
                                                        <td colspan="6">{{ $product->details }}</td>
                                                    </tr>
                                                    <tr></tr>
                                                </table>
                                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-md">Kembali</a>
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
