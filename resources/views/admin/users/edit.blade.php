@extends('layouts.app')

@section('content')
    <h3 class="page-title">User Management</h3>

    <div class="card">
        <div class="card-header">
            Edit User
        </div>

        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                @csrf 
                @method('put')
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block text-danger">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="email" class="control-label">email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('email'))
                            <p class="help-block text-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                    <label for="password" class="control-label">Password</label>
                        <input type="text" name="password" value="{{ old('password', $user->password) }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('password'))
                            <p class="help-block text-danger">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="role" class="control-label">Role</label>
                        <select name="role[]" class="form-control select2" multiple >
                            @foreach($roles as $roleId => $roleName) 
                                <option {{ in_array($roleId, $user->role->pluck('id')->toArray()) ? 'selected' : null }} value="{{ $roleId }}">{{ $roleName }}</option>
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