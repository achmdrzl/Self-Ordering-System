@extends('layouts.employee')

@push('style-alt')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
@endpush

@section('content')
    @include('layouts.partials.sidebar')

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            @if (session()->has('message'))
                {!! Toastr::message() !!}
            @endif
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-title">Detail Pengeluaran Tanggal : <span>
                                                    {{ date('d F Y', strtotime($date->spendingDate)) }}</span></p>
                                            <table class="table mb-4 display expandable-table table-responsive-md">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Item</th>
                                                    <th>Kuantiti</th>
                                                    <th>Total Harga</th>
                                                    <th>Waktu Beli</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($spendings as $value)
                                                        <tr>
                                                            <td>
                                                                <div class="badge badge-dark">{{ $loop->iteration }}</div>
                                                            </td>
                                                            <td><div class="badge badge-light">{{ ucfirst($value->item) }}</div></td>
                                                            <td><div class="badge badge-dark">{{ $value->qty }}</div></td>
                                                            <td><div class="badge badge-light">Rp. {{ number_format($value->priceItem) }}</div></td>
                                                            <td>{{ $value->created_at->diffForHumans(null, true).' ago' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ route('spending.index') }}" class="btn btn-primary btn-md">Kembali</a>
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

    @push('script-alt')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    @endpush
