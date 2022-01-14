@extends('layouts.app')

@section('content')
    <h3 class="page-title">Tenant Management</h3>

    <div class="card">
        <div class="card-header">
            Create Tenant
        </div>

        <div class="card-body">
            <form action="{{ route('admin.tenants.store') }}" method="post">
                @csrf 
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="property" class="control-label">Property</label>
                        <select name="property_id" class="form-control" id="property">
                            @foreach($properties as $propertyId => $propertyName)
                                <option value="{{ $propertyId }}">{{ $propertyName }}</option>
                            @endforeach
                        </select>
                        <p class="help-block"></p>  
                        @if($errors->has('property_id'))
                            <p class="help-block text-danger">
                                {{ $errors->first('property_id') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="name" class="control-label">name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" >
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
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('email'))
                            <p class="help-block text-danger">
                                {{ $errors->first('email') }}
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