@extends('layouts.employee')

@section('content')
    @include('layouts.partials.sidebar')

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            @if (session()->has('message'))
                {!! Toastr::message() !!}
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Tinjauan Pengeluaran</p>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-primary mb-3" data-bs-toggle="modal" href="#exampleModal"
                                        role="button"><i class="ti-plus btn-icon-append"></i> Tambah Pengeluaran</a>
                                    <table id="table-ud" cellpadding="5"
                                        class="table display expandable-table table-responsive-md table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($spendings as $item)
                                                <tr>
                                                    <th>
                                                        <div class="badge badge-dark">
                                                            {{ date('d F Y', strtotime($item->spendingDate)) }}</div>
                                                    </th>
                                                    <td>
                                                        <div class="badge badge-light" style="font-weight: bold">Rp.
                                                            {{ number_format($item->grandtotal) }}</div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('spending.show', $item->kode) }}"
                                                            class="btn btn-info btn-md text-white"
                                                            style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                class="ti-eye"></i> Detail</a>
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
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Masukkan Pengeluaran Harian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background: transparent; border:none;">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('spending.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2"
                                            style="font-weight: bold">Tanggal</span>
                                        <input type="text" id="payTotal" class="form-control" name="spendingDate"
                                            value="{{ date('d F Y', strtotime(date('d-m-Y'))) }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="field_wrapper">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"
                                                style="font-weight: bold">Items</span>
                                            <input type="text" id="payTotal" class="form-control" name="item[]"
                                                placeholder="Masukkan Nama Item" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"
                                                style="font-weight: bold">Kuantiti</span>
                                            <input type="number" id="payTotal" class="form-control" name="qty[]"
                                                placeholder="Masukkan Kuantiti" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2" style="font-weight: bold">Total
                                                Harga
                                            </span>
                                            <input type="number" id="payTotal" class="form-control" name="priceItem[]"
                                                placeholder="Masukkan Total Harga" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" id="addBtn" class="btn btn-primary"><i
                                                class="ti-plus btn-icon-append"></i></button>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Simpan  </button>
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

        <script>
            $(document).ready(function() {
                var maxField = 15; //Input fields increment limitation
                var addButton = $('#addBtn'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML =
                    `<div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"
                                                style="font-weight: bold">Items</span>
                                            <input type="text" id="payTotal" class="form-control" name="item[]"
                                                placeholder="Masukkan Nama Item" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"
                                                style="font-weight: bold">Kuantiti</span>
                                            <input type="number" id="payTotal" class="form-control" name="qty[]"
                                                placeholder="Masukkan Kuantiti" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2" style="font-weight: bold">Harga
                                                Item</span>
                                            <input type="number" id="payTotal" class="form-control" name="priceItem[]"
                                                placeholder="Masukkan Harga Item" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="remove_button btn btn-danger"><i
                                                class="ti-minus btn-icon-append"></i></a>
                                    </div>
                                </div>
                            </div>`;
                var x = 1; //Initial field counter is 1

                //Once add button is clicked
                $(addButton).click(function() {
                    //Check maximum number of input fields
                    if (x < maxField) {
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('').parent('').remove(); //Remove field html
                    x--; //Decrement field counter

                    if (x == 1) {
                        swal("Warning", "Tidak Bisa Menghapus Lagi!", "warning");
                    }
                });
            });
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
