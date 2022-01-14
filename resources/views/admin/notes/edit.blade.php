@extends('layouts.app')

@section('content')
    <h3 class="page-title">Note Management</h3>

    <div class="card">
        <div class="card-header">
            Edit Note
        </div>

        <div class="card-body">
            <form action="{{ route('admin.notes.update', $note->id) }}" method="post">
                @csrf 
                @method('put')
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="property" class="control-label">Property</label>
                        <select name="property_id" class="form-control" id="property">
                            @foreach($properties as $propertyId => $propertyName)
                                <option {{ $propertyId == $note->property_id ? "selected" : null}} value="{{ $propertyId }}">{{ $propertyName }}</option>
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
                        <label for="note" class="control-label">name</label>
                        <textarea name="note_text" class="form-control" rows="5">{{ old('name', $note->note_text) }}</textarea>
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block text-danger">
                                {{ $errors->first('name') }}
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