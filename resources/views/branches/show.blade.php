@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Table</h6>
                    <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official
                            DataTables Documentation </a>for a full list of instructions and other options.</p>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Branch Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $branch->branch_name }}</td>
                                        <td>{{ $branch->alamat }}</td>
                                        <td>{{ $branch->phone }}</td>
                                        <td>{{ $branch->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
