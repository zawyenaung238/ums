@extends('layouts.master')
@section('content')

<div class="page-wrapper" style="min-height: 706px;">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Add Role</h3> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('role.store') }}" id="roleCreate" method="post" class=" form-row mb-4 align-items-center">
                    @csrf
                    <div class="col-6">
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Role Name">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary ml-3">Create Role</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9 roles_class">
                <div class="table-responsive">
                  <table class="table table-striped custom-table">
                    <tbody>
                        @foreach ($features as $f)
                          <tr>
                              <td>{{ $f->name }}</td>
                              <td>
                                  @foreach ($f->permissions as $p)
                                  <label class="form-check form-check-inline">
                                      <input class="form-check-input mx-3" form="roleCreate" name="permissions[]" type="checkbox" id="checkbox_{{ $p->id }}" value="{{ $p->id }}">
                                      <span class="form-check-label" for="checkbox_{{ $p->id }}">{{ $p->name }}</span>
                                  </label>
                                  @endforeach
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


@section('script')

@endsection

@endsection
