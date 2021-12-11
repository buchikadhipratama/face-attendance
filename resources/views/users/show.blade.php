@extends('layout.master')

@push('plugin-styles')
    {{-- <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" /> --}}
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
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th class="">user_id</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->status == 1)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td class="">{{ $user->id }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->roles['role_name'] }}</td>
                                            <td>
                                                @if ($user->status == 1)
                                                    Active
                                                @else
                                                    Not Active
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary edit">
                                                    edit
                                                </button>
                                                <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                    data-target="#delete">Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="updateForm" action="/datamaster/user/update" method="POST" id="formEdit">
                    @csrf
                    <input type="hidden" name="id" id="idUser">
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" autocomplete="off" id="name" name="name"
                                    placeholder="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="emailAddress" name="emailAddress"
                                    placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option selected disabled>Select your age</option>
                                    @foreach ($roles as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input id="btnUpdate" type="submit" class="btn btn-primary " value="Update Data">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form class="deleteForm" action="/datamaster/user/delete" method="POST" id="deleteForm">
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
                            <div class="mb-3">
                                <label for="Drole" class="form-label">Role</label>
                                <select id="Drole" class="form-select">
                                    @foreach ($roles as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->role_name }}</option>
                                    @endforeach
                                </select>
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
        var table = $('#datatable').DataTable();
        // editing data
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            if ($(this).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#name').val(data[1]);
            $('#emailAddress').val(data[3]);
            $('#role option:contains(' + data[4] + ')').prop("selected", true);
            $('#idUser').val(data[2]);

            $('#editModal').modal('show');
        });
        $('#btnUpdate').click(function() {
            $('#formEdit').submit();
        });

        // deleting data
        table.on('click', '.delete', function() {
            $tr = $(this).closest('tr');
            if ($(this).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();

            $('#Dname').val(data[1]);
            $('#DemailAddress').val(data[3]);
            $('#Drole option:contains(' + data[4] + ')').prop("selected", true);
            $('#IdDel').val(data[2]);

            $('#deleteModal').modal('show');
        });
        $('#btnDelete').click(function() {
            $('#deleteForm').submit();
        });


    });
</script>

@push('plugin-scripts')
    {{-- <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
