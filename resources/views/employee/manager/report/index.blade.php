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
                <div class="col-lg-12 col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Tinjauan Keuangan Restoran</p>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-primary mb-3" data-bs-toggle="modal" href="#exampleModal"
                                        role="button"><i class="ti-printer btn-icon-append"></i> Cetak Laporan</a>
                                    <table id="table-ud" cellpadding="5"
                                        class="table display expandable-table table-responsive-md table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Total Pesanan Harian</th>
                                                <th>Total Pengeluaran Harian</th>
                                                <th>Total Pendapatan Harian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $item)
                                                    <tr>
                                                        <th>
                                                            <div class="badge badge-dark">
                                                                {{ date('d F Y', strtotime($item->order_date)) }}</div>
                                                        </th>
                                                        <td>
                                                            <div class="badge badge-light" style="font-weight: bold">Rp.
                                                                {{ number_format($item->totalIncome) }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-light" style="font-weight: bold">Rp.
                                                                {{ number_format($item->totalSpend) }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-light" style="font-weight: bold">Rp.
                                                                {{ number_format($item->totalIncome-$item->totalSpend) }}</div>
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

        {{-- Modal Content Start to End Report --}}
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atur Periode Waktu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background: transparent; border:none;">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('set.time.period') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2" style="font-weight: bold">Mulai Dari</span>
                                <input type="date" id="payTotal" class="form-control" name="startDate"
                                    placeholder="Input Start Date" required />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2" style="font-weight: bold">Sampai Dengan</span>
                                <input type="date" id="payTotal" class="form-control" name="endDate"
                                    placeholder="Input End Date" required />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="ti-printer btn-icon-append"></i>
                            Cetak</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="color: white">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal --}}

        <!-- content-wrapper ends -->
    @endsection

    @push('script-alt')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    @endpush

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
