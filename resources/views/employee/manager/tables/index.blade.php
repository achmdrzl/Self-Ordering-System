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
