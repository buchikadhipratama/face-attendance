@extends('layout.master')

@push('plugin-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                {{-- update session --}}
                @if (session('update'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('update') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- delete session --}}
                @if (session('delete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('delete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-body">
                    <h6 class="card-title">Data Table</h6>
                    <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official
                            DataTables Documentation </a>for a full list of instructions and other options.</p>
                    <div class="table-responsive">
                        <table id="branchTable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Branch Name</th>
                                    <th>Branch_id</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $branch->branch_name }}</td>
                                        <td>{{ $branch->id }}</td>
                                        <td>{{ $branch->alamat }}</td>
                                        <td>{{ $branch->phone }}</td>
                                        <td>
                                            @if ($branch->status == 1)
                                                Active
                                            @else
                                                Not Active
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary editBranch">
                                                edit
                                            </button>
                                            <button type="button" class="btn btn-danger deleteBranch" data-toggle="modal"
                                                data-target="#deleteBranch">Delete
                                            </button>
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


    {{-- modal --}}
    <div class="modal fade" id="editBranch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="FormUpdateBranch" action="/datamaster/user/update" method="POST" id="FormEditBranch">
                    @csrf
                    <input type="hidden" name="id" id="idBranch">
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="branch_name">Name</label>
                                <input type="text" class="form-control" autocomplete="off" id="branch_name"
                                    name="branch_name" placeholder="name">
                            </div>
                            <div class="form-group">
                                <label for="branch_address">Branch Address</label>
                                <input type="text" class="form-control" id="branch_address" name="branch_address"
                                    placeholder="Branch Address">
                            </div>
                            <div class="form-group">
                                <label for="branch_phone">Phone Number</label>
                                <input type="text" class="form-control" id="branch_phone" name="branch_phone"
                                    placeholder="Phone Number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input id="UpdateBranch" type="submit" class="btn btn-primary " value="Update Data">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this data?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="deleteForm" action="/datamaster/branch/delete" method="POST" id="deleteForm">
                        @csrf
                        <input type="hidden" name="id" id="IdDel">
                        <fieldset disabled>
                            <div class="mb-3">
                                <label for="Dname">Name</label>
                                <input type="text" class="form-control" id="Dname" name="Dname">
                            </div>
                            <div class="mb-3">
                                <label for="DemailAddress" class="form-label">Email</label>
                                <input type="DemailAddress" id="DemailAddress" class="form-control"
                                    placeholder="Disabled input">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input id="btnDelete" type="submit" class="btn btn-danger" value="Delete">
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        var table = $('#branchTable').DataTable();
        // editing data
        table.on('click', '.editBranch', function() {
            $tr = $(this).closest('tr');
            if ($(this).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#branch_name').val(data[1]);
            $('#branch_address').val(data[3]);
            $('#branch_phone').val(data[4]);
            $('#idBranch').val(data[2]);

            $('#editBranch').modal('show');
        });
        $('#UpdateBranch').click(function() {
            $('#FormEditBranch').submit();
        });

        // deleting data
        table.on('click', '.deleteBranch', function() {
            $tr = $(this).closest('tr');
            if ($(this).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);

            $('#Dname').val(data[1]);
            $('#DemailAddress').val(data[3]);
            $('#Drole option:contains(' + data[4] + ')').prop("selected", true);
            $('#IdDel').val(data[2]);

            $('#deleteBranchModal').modal('show');
        });
        $('#btnDelete').click(function() {
            $('#deleteForm').submit();
        });


    });
</script>


@push('plugin-scripts')
    {{-- <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
