@extends('admin.master')
@section('title', 'Add Role')
@section('content')
    <!-- Add Role Section-->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">{{isset($single_data)?'Update Role':'Add Role'}}</h6>
                    <form action="{{isset($single_data)?route('role.update',$single_data->id):route('role.store')}}" method="POST">
                        @csrf
                        @isset($single_data)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label for="name" class="form-label">Role</label>
                                <input type="text" class="form-control" name="name" value="{{isset($single_data->name)?$single_data->name:''}}" id="name">
                            </div>
                            
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary col-sm-2">{{isset($single_data)?'Update Role':'Add Role'}}</button>
                        </div> 
                    </form>
                </div>
            </div>

           
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex">  
                        <h6 class="mb-4 col-sm-4 text-start">Roles List</h6>
                        <p class="col-sm-1">Search : </p>
                        <div class="col-sm-7 text-center">
                            <input type="text" name="rolesearch" id="rolesearch" class="form-control" />
                        </div>  
                   </div>
                    <div class="table-responsive">
                        <table class="table" id="tbl_cat_id">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">create at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($roles)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($roles as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('role.edit',$item->id)}}" class="btn btn-success"><button class="btn btn-success btn-sm">Edit</button></a>
                                            <form action="{{route('role.destroy',$item->id)}}" onsubmit="return confirm('Are you sure?');" method="POST">
                                                @csrf
                                                @isset($item)
                                                    @method('delete')
                                                @endisset
                                                    <button class="btn btn-danger btn-lg">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                                
                            </tbody>
                        </table>
                        <button onclick="ExportToExcel('xlsx')" class="btn btn-success">Export table to excel</button>
                    </div>
                </div>
            </div>
            {{-- end Role listing code --}}

        </div>



    </div>
    <!-- Add Role Section End -->

@endsection
@section('script')
    {{-- ck editor js code --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    {{-- table exort code js --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_cat_id');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
        // Role search from tabel
        $(document).ready(function(){  
            $('#rolesearch').keyup(function(){  
                    search_table($(this).val());  
            });  
            function search_table(value){  
                    $('#tbl_cat_id tr').each(function(){  
                        var found = 'false';  
                        $(this).each(function(){  
                            if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                            {  
                                found = 'true';  
                            }  
                        });  
                        if(found == 'true')  
                        {  
                            $(this).show();  
                        }  
                        else  
                        {  
                            $(this).hide();  
                        }  
                    });  
            }  
        });  
    </script>
    @include('sweetalert::alert')


@endsection
