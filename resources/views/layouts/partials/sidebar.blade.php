<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Point of Sales</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
        <div class="info">
            <a href="#" class="d-block">User</a>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fa fa-th"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @role('admin')
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        Users Management
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.roles_permission') }}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Role Permission</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endrole

            @if (auth()->user()->can('show products') || auth()->user()->can('delete products') || auth()->user()->can('create products') || auth()->user()->can('edit products'))
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        Product Management
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Product</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>
                    ​
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>
</div>
</aside>