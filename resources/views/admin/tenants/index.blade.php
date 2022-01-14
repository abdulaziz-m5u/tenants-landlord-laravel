@extends('layouts.app')

@section('content')
    <h3 class="page-title">Tenant Management</h3>
    @can('property_create')
    <p>
        <a href="{{ route('admin.tenants.create') }}" class="btn btn-success text-white">Add New</a>
    </p>
    @endcan

    <div class="card">

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($tenants as $tenant)
                        <tr data-entry-id="{{ $tenant->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td field-key='name'>{{ $tenant->name }}</td>
                            <td field-key='email'>{{ $tenant->email }}</td>
                            <td>
                                @can('property_delete')
                                    <form onclick="return confirm('are you sure')" class="d-inline" action="{{ route('admin.tenants.destroy',[$tenant->property->id]) }}" method="post">
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