@extends('layouts.app')

@section('content')
    <h3 class="page-title">Role Management</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success text-white">Add New</a>
    </p>
    @endcan

    <div class="card">

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($roles as $role)
                        <tr data-entry-id="{{ $role->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td field-key='name'>{{ $role->title }}</td>
                            <td field-key='permission'>
                                @foreach ($role->permission as $singlePermission)
                                    <span class="badge bg-info text-white">{{ $singlePermission->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('user_edit')
                                    <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                @endcan
                                @can('user_delete')
                                    <form onclick="return confirm('are you sure')" class="d-inline" action="{{ route('admin.roles.destroy',[$role->id]) }}" method="post">
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