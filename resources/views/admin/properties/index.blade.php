@extends('layouts.app')

@section('content')
    <h3 class="page-title">Property Management</h3>
    @can('property_create')
    <p>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-success text-white">Add New</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.properties.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.properties.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
        </ul>
    </p>

    <div class="card">

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($properties as $property)
                        <tr data-entry-id="{{ $property->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td field-key='name'>{{ $property->name }}</td>
                            <td field-key='address'>{{ $property->address }}</td>
                            <td field-key='photo'>@if($property->photo)<a href="{{ Storage::url($property->photo) }}" target="_blank"><img width="200" src="{{ Storage::url($property->photo) }}"/></a>@endif</td>
                            <td>
                                @can('property_edit')
                                    <a href="{{ route('admin.properties.edit',[$property->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                @endcan
                                @can('property_delete')
                                    <form onclick="return confirm('are you sure')" class="d-inline" action="{{ route('admin.properties.destroy',[$property->id]) }}" method="post">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">Data not Found !</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection