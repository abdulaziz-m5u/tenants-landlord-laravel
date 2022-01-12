@extends('layouts.app')

@section('content')
    <h3 class="page-title">User Management</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success text-white">Add New</a>
    </p>
    @endcan

    <div class="card">

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} @can('user_delete') dt-select @endcan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Field Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($users as $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td field-key='name'>{{ $user->name }}</td>
                            <td field-key='email'>{{ $user->email }}</td>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="badge bg-info text-white">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">View</a>
                                @endcan
                                @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                @endcan
                                @can('user_delete')
                                    <form onclick="return confirm('are you sure')" class="d-inline" action="{{ route('admin.users.destroy',[$user->id]) }}" method="post">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection