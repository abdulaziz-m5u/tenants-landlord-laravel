@extends('layouts.app')

@section('content')
    <h3 class="page-title">Property Management</h3>

    <div class="card">
        <div class="card-header">
            Create Property
        </div>

        <div class="card-body">
            <form action="{{ route('admin.properties.update', $property->id) }}" method="post" enctype="multipart/form-data">
                @csrf 
                @method('put')
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $property->name) }}" class="form-control" >
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
                        <label for="address" class="control-label">Address</label>
                        <input type="text" name="address" value="{{ old('address', $property->address) }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('address'))
                            <p class="help-block text-danger">
                                {{ $errors->first('address') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="photo" class="control-label">Photo</label>
                        <input type="file" name="photo" value="{{ old('photo') }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('photo'))
                            <p class="help-block text-danger">
                                {{ $errors->first('photo') }}
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