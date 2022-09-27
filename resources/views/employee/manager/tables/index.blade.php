    @extends('layouts.employee')

    @section('content')
        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    {{-- <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show">
                        {{ session()->get('message') }}
                        <button class="close" type="button" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    {!! Toastr::message() !!}
                @endif
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Data Tables</p>
                                <div class="row">
                                    <div class="col-12">
                                        @if (Auth::user()->hasRole('manager'))
                                            <a class="btn btn-primary mb-3" href="{{ route('tables.create') }}"><i
                                                    class="ti-plus btn-icon-append"></i> Add Tables</a>
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
                window.addEventListener('show-delete-confirm', event => {
                    swal({
                        title: "Apakah anda yakin?",
                        text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('deleteConfirmed')
                        } else {
                            swal("Cancel!", "Undelete Successfully!", "error");

                        }
                    })
                })

                window.addEventListener('tableDeleted', event => {
                    swal("Success", "Table Deleted Successfully", "success");
                })
            </script>
        @endpush
