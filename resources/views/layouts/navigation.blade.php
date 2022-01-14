<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    @can('property_access')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.properties.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Property') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tenants.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Tenant') }}
        </a>
    </li>
    @endcan

    @can('document_access')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.documents.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Document') }}
        </a>
    </li>
    @endcan

    @can('note_access')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.notes.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Note') }}
        </a>
    </li>
    @endcan

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.about') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('About us') }}
        </a>
    </li>

    @can('user_management_access')
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Management Users
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            @can('user_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}" target="_top">
                    Users
                </a>
            </li>
            @endcan
            @can('role_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.roles.index') }}" target="_top">
                    Roles
                </a>
            </li>
            @endcan
            @can('permission_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.permissions.index') }}" target="_top">
                    Permissions
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcan
</ul>