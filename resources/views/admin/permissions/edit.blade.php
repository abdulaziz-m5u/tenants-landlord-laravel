@extends('layouts.app')

@section('content')
    <h3 class="page-title">Permissions Management</h3>

    <div class="card">
        <div class="card-header">
            Update Permission
        </div>

        <div class="card-body">
            <form action="{{ route('admin.permissions.update', $permission->id) }}" method="post">
                @csrf 
                @method('put')
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $permission->title) }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('title'))
                            <p class="help-block text-danger">
                                {{ $errors->first('title') }}
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