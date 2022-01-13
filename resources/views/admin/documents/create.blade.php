@extends('layouts.app')

@section('content')
    <h3 class="page-title">Document Management</h3>

    <div class="card">
        <div class="card-header">
            Create Document
        </div>

        <div class="card-body">
            <form action="{{ route('admin.documents.store') }}" method="post" enctype="multipart/form-data">
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
                        <label for="document" class="control-label">Document</label>
                        <input type="file" name="document" value="{{ old('document') }}" class="form-control" >
                        <p class="help-block"></p>
                        @if($errors->has('document'))
                            <p class="help-block text-danger">
                                {{ $errors->first('document') }}
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