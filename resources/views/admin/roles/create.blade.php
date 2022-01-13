@extends('layouts.app')

@section('content')
    <h3 class="page-title">Roles Management</h3>

    <div class="card">
        <div class="card-header">
            Create Role
        </div>

        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="post">
                @csrf 
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('title'))
                            <p class="help-block text-danger">
                                {{ $errors->first('title') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="permission" class="control-label">Role</label>
                        <select name="permission[]" class="form-control select2" multiple >
                            @foreach($permissions as $permissionId => $permissionTitle) 
                                <option value="{{ $permissionId }}">{{ $permissionTitle }}</option>
                            @endforeach
                        </select>
                        <p class="help-block"></p>
                        @if($errors->has('role'))
                            <p class="help-block text-danger">
                                {{ $errors->first('role') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection