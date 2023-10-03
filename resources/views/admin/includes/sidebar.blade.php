 <!-- Sidebar Start -->
 <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark" style="width:inherit;">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Amazon</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        
                        <img class="rounded-circle" src="{{Auth()->user()->profile}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{Auth()->user()->name}}</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('dashboard')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Products</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('add_product')}}" class="dropdown-item">Add Product</a>
                            <a href="{{route('manage_product')}}" class="dropdown-item">Manage Product</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-book me-2"></i>Category</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('add_category')}}" class="dropdown-item">Add Category</a>
                        </div>
                    </div>
                    {{-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a> --}}
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Role & Permission</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('role.index')}}" class="dropdown-item">Roles</a>
                            <a href="{{route('permission.index')}}" class="dropdown-item">Permission</a>
                            <a href="{{route('role_has_permission.index')}}" class="dropdown-item">Role has Permission</a>
                            <a href="{{route('assignrole')}}" class="dropdown-item">Assign Role</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->