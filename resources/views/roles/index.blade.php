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
                            <h4 class="card-title float-left mt-2">Roles List</h4>
                            @if((auth()->user()->role->permissions()->where('name', 'create')->exists() || auth()->user()->role->id == 1))
                            <a href="{{ route('role.create') }}" class="btn btn-primary float-right veiwbutton" id="userDelete">Add Role</a>
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
                                <table class="table table-stripped table table-hover table-center mb-0 w-100">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $r)
                                        <tr>
                                            <td>{{ $r->name }}</td>
                                            <td>
                                                @if(auth()->user()->role->permissions()->where('name', 'update')->exists() || auth()->user()->role_id == '1')
                                                <a href="{{ route('role.edit', $r->id) }}" class="btn btn-sm btn-outline-warning rounded">
                                                    <i class="fas fa-edit fa-fw"></i>
                                                </a>
                                                @endif
                                                @if(auth()->user()->role->permissions()->where('name', 'delete')->exists() || auth()->user()->role_id == '1')
                                                <a href="#" class="btn btn-sm btn-outline-danger rounded delete" data-id="{{ $r->id }}">
                                                    <i class="fas fa-trash fa-fw"></i>
                                                </a>
                                                @endif
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

    @section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var row = $(this).closest('tr');
                Swal.fire({
                    title: 'Are you sure, you want to delete?',
                    showCancelButton: true,
                    confirmButtonColor: '#009688',
                cancelButtonColor: '#828282',
                    confirmButtonText: 'Confirm',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/role/' + id,
                            type: 'DELETE',
                            success: function() {
                                row.remove();
                            }
                        });
                    }
                });
            });
        });
    </script>

    @endsection
@endsection
