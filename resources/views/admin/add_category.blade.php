@extends('admin.master')
@section('title', 'Add Category')
@section('content')
    <!-- Add Product Section-->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">{{isset($single_data)?'Update Category':'Add Category'}}</h6>
                    <form action="{{isset($single_data)?route('update_category',$single_data->id):route('save_category')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($single_data)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name" value="{{isset($single_data->name)?$single_data->name:''}}" id="category_name">

                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="parent_id" class="form-label">Parent Category</label>
                                <select class="form-select" name="parent_id" id="parent_id"
                                    aria-label="Floating label select example">
                                    <option selected disabled value="">...Select Category...</option>
                                    @isset($categories)
                                        @foreach ($categories as $category)
                                            <?php $dash = ''; ?>
                                            <option value="{{ $category->id }}" {{isset($single_data->parent_id)?($category->id==$single_data->parent_id?'selected':''):''}}>{{ $category->name }}</option>
                                            @if (count($category->subcategory))
                                                @include('admin.subCategoryList-option', [
                                                    'subcategories' => $category->subcategory,
                                                ])
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>

                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="category_image" class="form-label">Category Image</label>
                                <input type="file" class="form-control" name="category_image" id="category_image">
                                @isset($single_data->image)
                                    <img src="{{asset($single_data->image)}}" alt="" height="40px" width="40px">
                                    {{-- <input type="hidden" name="old_image" value="{{$single_data->image}}"> --}}
                                @endisset

                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="description" class="form-label">Category Description</label>
                                <textarea name="description" id="editor" rows="10" cols="80">{{isset($single_data->description)?$single_data->description:''}}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{isset($single_data)?'Update Category':'Add Category'}}</button>
                    </form>
                </div>
            </div>

            {{-- @if ($errors->any())
                <div>
                    @foreach ($errors->all() as $error)
                        <li class="alert alert-danger">{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            @if (\Session::has('error'))
                <div>
                    <li class="alert alert-danger">{!! \Session::get('error') !!}</li>
                </div>
            @endif

            @if (\Session::has('success'))
                <div>
                    <li class="alert alert-success">{!! \Session::get('success') !!}</li>
                </div>
            @endif --}}

            {{-- category listing code start --}}
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex">  
                        <h6 class="mb-4 col-sm-4 text-start">Category List</h6>
                        <p class="col-sm-1">Search : </p>
                        <div class="col-sm-7 text-center">
                            <input type="text" name="catsearch" id="catsearch" class="form-control" />
                        </div>  
                   </div>
                    <div class="table-responsive">
                        <table class="table" id="tbl_cat_id">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Descrition</th>
                                    <th scope="col">create at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($categories)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td><img src="{{isset($single_data)?'../'.$category->image:$category->image}}" height="40px" width="40px" alt="no image"></td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->description}}</td>
                                        <td>{{$category->created_at}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('cat_edit',$category->id)}}" class="btn btn-success"><button class="btn btn-success btn-sm">Edit</button></a>
                                            <form action="{{route('cat_delete',$category->id)}}" onsubmit="return confirm('Are you sure?');" method="POST">
                                                @csrf
                                                    <button class="btn btn-danger btn-lg">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $dash = ''; ?>
                                    @if (count($category->subcategory))
                                        @include('admin.subCategoryList', [
                                            'subcategories' => $category->subcategory,
                                            'i'=>$i,
                                        ])
                                    @endif
                                    @php $i++ @endphp
                                    @endforeach
                                @endisset
                                
                            </tbody>
                        </table>
                        <button onclick="ExportToExcel('xlsx')" class="btn btn-success">Export table to excel</button>
                    </div>
                </div>
            </div>
            {{-- end category listing code --}}

        </div>



    </div>
    <!-- Add Product Section End -->

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
        // category search from tabel
        $(document).ready(function(){  
            $('#catsearch').keyup(function(){  
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
