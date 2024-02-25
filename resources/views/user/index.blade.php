@extends('layouts.master')
@section('content')
    {{-- message --}}
    {{-- {!! Toastr::message() !!} --}}


    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">User List</h4>
                            @if(auth()->user()->role->hasPermission('create') || auth()->user()->role_id == '1')
                            <a href="{{ route('user.create') }}" class="btn btn-primary float-right veiwbutton" id="userDelete">Add User</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="table table-stripped table table-hover table-center mb-0 w-100" id="UsersList">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Role Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @section('script')
    <script>
        $(document).ready(function() {
           var table  = $('#UsersList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: "{{ '/user/datatable/ssd' }}",
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });

            $(document).on('click', '.delete', function(e){
                e.preventDefault();

                var id = $(this).data("id");

                Swal.fire({
                title: 'Are you sure, you want to delete?',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : '/user/' + id,
                            type : 'DELETE',
                            success : function(){
                                table.ajax.reload();
                            }
                        })
                    }
                })
            })
        });
    </script>

    @endsection
@endsection
