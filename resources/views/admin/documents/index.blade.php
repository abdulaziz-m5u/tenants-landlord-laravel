@extends('layouts.app')

@section('content')
    <h3 class="page-title">Document Management</h3>
    @can('document_create')
    <p>
        <a href="{{ route('admin.documents.create') }}" class="btn btn-success text-white">Add New</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.documents.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.documents.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
      </ul>
    </p>

    <div class="card">

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Property</th>
                        <th>User</th>
                        <th>Document</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($documents as $document)
                        <tr data-entry-id="{{ $document->id }}">
                            <td>{{ $loop->iteration }}</td>
                                <td field-key='property'>{{ $document->property->name ?? '' }}</td>
                                <td >{{ $document->user->name ?? "" }}</td>
                                <td field-key='document'>@if($document->document)<a href="{{ Storage::url($document->document) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='name'>{{ $document->name }}</td>
                            <td>
                                @can('document_edit')
                                    <a href="{{ route('admin.documents.edit',[$document->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                @endcan
                                @can('document_delete')
                                    <form onclick="return confirm('are you sure')" class="d-inline" action="{{ route('admin.documents.destroy',[$document->id]) }}" method="post">
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