@extends('admin.master')
@section('title', 'Role Has Permission')
@section('content')
    <!-- Add Role Section-->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Role Has Permission</h6>
                    <form action="{{ route('role_has_permission.create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label for="role_id" class="form-label">Roles</label>
                                <select class="form-select" name="role_id" id="role_id"
                                    aria-label="Floating label select example">
                                    <option selected disabled value="">...Select Roles...</option>
                                    @isset($roles)
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{isset($selectrole)?($role->id==$selectrole->id?'selected':''):'' }}>{{ $role->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>

                            </div>

                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary col-sm-2">Fetch Permission</button>
                        </div>
                    </form>
                </div>
            </div>
            @isset($selectrole)
                <form action="{{ route('assign_role_permission.store') }}" method="post">
                    @csrf
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <input type="hidden" value="{{ $selectrole->id }}" name="roleid">
                            <div class="d-flex">
                                <h6 class="mb-4 col-sm-4 text-start">Role Has Permission List</h6>
                                
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="tbl_cat_id">
                                    <thead>
                                        <tr>
                                            <th scope="col">permission_name</th>
                                            <th scope="col">create</th>
                                            <th scope="col">read</th>
                                            <th scope="col">update</th>
                                            <th scope="col">delete</th>
                                            <th scope="col">name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission_name as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                @foreach ($item->permissions as $dt)
                                                    <td>
                                                        <input class="form-check-input" type="checkbox" name="permission_id[]"
                    value="{{ $dt->id }}" id="flexCheckDefault" {{$selectrole->hasPermissionTo($dt->name)?'checked':'' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary col-sm-4">Assign permissions</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endisset

        </div>



    </div>
    <!-- Add Role Section End -->

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @include('sweetalert::alert')


@endsection
