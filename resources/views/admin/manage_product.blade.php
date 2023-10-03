@extends('admin.master')
@section('title', 'Add Product')
@section('content')
    <!-- Add Product Section-->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex">  
                        <h6 class="mb-4 col-sm-4 text-start">Product List</h6>
                        <p class="col-sm-1">Search : </p>
                        <div class="col-sm-7 text-center">
                            <input type="text" name="prosearch" id="prosearch" class="form-control" />
                        </div>  
                   </div>
                    <div class="table-responsive">
                        <table class="table" id="tbl_pro_id">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Product Type</th>
                                    <th scope="col">Descrition</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">create at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($products)
                                    @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        @php
                                            $img = json_decode($product->p_image);
                                            // dd($img[0]);
                                        @endphp
                                        <td><img src="{{$img[0]}}" height="40px" width="40px" alt="no image"></td>
                                        <td>{{$product->p_name}}</td>
                                        <td>{{$product->productType->name}}</td>
                                        <td>
                                            @php        
                                            $prices = json_decode($product->p_price);
                                            if(count($prices)>1){
                                                echo min($prices).' - '.max($prices);
                                            }else{
                                                echo min($prices);
                                            }
                                            @endphp
                                        </td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->created_at}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('pro_edit',$product->id)}}" class="btn btn-success"><button class="btn btn-success btn-sm">Edit</button></a>
                                            <form action="{{route('pro_delete',$product->id)}}" onsubmit="return confirm('Are you sure?');" method="POST">
                                                @csrf
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
            {{-- end category listing code --}}

        </div>



    </div>
    <!-- Add Product Section End -->

@endsection
@section('script')
    {{-- table exort code js --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_pro_id');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
        // product search from tabel
        $(document).ready(function(){  
            $('#prosearch').keyup(function(){  
                    search_table($(this).val());  
            });  
            function search_table(value){  
                    $('#tbl_pro_id tr').each(function(){  
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
