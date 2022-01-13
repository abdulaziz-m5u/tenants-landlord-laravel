@extends('layouts.app')

@section('content')
    <h3 class="page-title">Role Management</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success text-white">Add New</a>
    </p>
    @endcan

    <div class="card">

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr data-entry-id="{{ $permission->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td field-key='name'>{{ $permission->title }}</td>
                            <td>
                                @can('user_edit')
                                    <a href="{{ route('admin.permissions.edit',[$permission->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                @endcan
                                @can('user_delete')
                                    <form onclick="return confirm('are you sure')" class="d-inline" action="{{ route('admin.permissions.destroy',[$permission->id]) }}" method="post">
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