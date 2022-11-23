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
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Data Meja Restoran</p>
                                <div class="row">
                                    <div class="col-12">
                                        @if (Auth::user()->hasRole('manager'))
                                            <a class="btn btn-primary mb-3" href="{{ route('tables.create') }}"><i
                                                    class="ti-plus btn-icon-append"></i> Tambah Meja</a>
                                        @endif
                                        @livewire('tables-list')
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
            {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

            <script>
                // Tables Archive
                window.addEventListener('show-delete-confirm', event => {
                    swal({
                        title: "Apakah anda yakin?",
                        text: "Setelah dinon-Aktifkan, Pelanggan tidak dapat Memesan Melalui Meja Ini!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('deleteConfirmed')
                        } else {
                            swal("Cancel!", "Command Successfully!", "error");

                        }
                    })
                })

                window.addEventListener('tableDeleted', event => {
                    swal("Success", "Table Unactive Successfully", "success");
                    location.reload();
                })

                // Tables Show
                window.addEventListener('show-table-confirm', event => {
                    swal({
                        title: "Apakah anda yakin?",
                        text: "Setelah di Aktifkan, Pelanggan dapat kembali Memesan Melalui Meja Ini!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('showConfirmed')
                        } else {
                            swal("Cancel!", "Command Successfully!", "error");

                        }
                    })
                })

                window.addEventListener('tableShowed', event => {
                    swal("Success", "Table Actived Successfully", "success");
                    location.reload();
                })
            </script>
        @endpush
