@extends('layouts.app')

@section('content')
    <h3 class="page-title">Note Management</h3>
    @can('note_create')
    <p>
        <a href="{{ route('admin.notes.create') }}" class="btn btn-success text-white">Add New</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.notes.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.notes.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
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
                        <th>Note Text</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($notes as $note)
                        <tr data-entry-id="{{ $note->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td field-key='property'>{{ $note->property->name ?? '' }}</td>
                            <td field-key='user'>{{ $note->user->name ?? '' }}</td>
                            <td field-key='note_text'>{!! $note->note_text !!}</td>
                            <td>
                                @can('note_edit')
                                    <a href="{{ route('admin.notes.edit',[$note->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                @endcan
                                @can('note_delete')
                                    <form onclick="return confirm('are you sure')" class="d-inline" action="{{ route('admin.notes.destroy',[$note->id]) }}" method="post">
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