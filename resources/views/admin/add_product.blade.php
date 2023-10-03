@extends('admin.master')
@section('title', 'Add Product')
@section('content')
    <!-- Add Product Section-->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">{{ isset($single_data) ? 'Update Product' : 'Add Product' }}</h6>
                    <form action="{{ isset($single_data) ? route('update_category', $single_data->id) : route('save_product') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($single_data)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label for="p_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="p_name"
                                    value="{{ isset($single_data->p_name) ? $single_data->p_name : '' }}" id="p_name">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="p_categry_id" class="form-label">Product Category</label>
                                <select class="form-select" name="p_categry_id" id="p_categry_id"
                                    aria-label="Floating label select example">
                                    <option selected disabled value="">...Select Category...</option>
                                    @isset($categories)
                                        @foreach ($categories as $category)
                                            <?php $dash = ''; ?>
                                            <option value="{{ $category->id }}"
                                                {{ isset($single_data->p_categry_id) ? ($category->id == $single_data->p_categry_id ? 'selected' : '') : '' }}>
                                                {{ $category->name }}</option>
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
                                <label for="editor" class="form-label">Product Description</label>
                                <textarea name="p_description" id="editor" rows="10" cols="80">{{ isset($single_data->p_description) ? $single_data->p_description : '' }}</textarea>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="p_type_id" class="form-label">Product Type</label>
                                <select class="form-select" name="p_type_id" id="p_type_id"
                                    aria-label="Floating label select example">
                                    <option selected disabled value="">...Select Product Type...</option>
                                    @isset($product_type)
                                        @foreach ($product_type as $p_type)
                                            <option value="{{ $p_type->id }}" {{ isset($single_data->p_type_id) ? (($single_data->p_type_id==$p_type->id)?'selected':'') : '' }}>{{ $p_type->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="row addrow">
                            <div class="mb-3 col-sm-2 var_type">
                                <label for="p_variation" class="form-label">Variation Type</label>
                                <select class="form-select p_variation" name="p_variation[]" id="p_variation"
                                    aria-label="Floating label select example">
                                    <option selected value="size">Size</option>
                                    <option value="color">Color</option>
                                </select>
                            </div>
                            <div class="mb-3 col-sm-1 p_size">
                                <label for="p_var_value" class="form-label">Size</label>
                                <input type="number" class="form-control" name="p_var_value[]" id="p_var_value">    
                            </div>
                            <div class="mb-3 col-sm-1 p_color" style="display: none">       
                            </div>
                            <div class="mb-3 col-sm-2">
                                <label for="p_image" class="form-label">Product Image</label>
                                <input type="file" class="form-control p_image" name="p_image[]" id="p_image">
                                <img class="image-preview" src="#" alt="Image Preview"
                                    style="max-width: 50px; max-height: 50px; display: none;">
                                @isset($single_data->image)
                                    <img src="{{ asset($single_data->image) }}" alt="" height="40px" width="40px">
                                    {{-- <input type="hidden" name="old_image" value="{{$single_data->image}}"> --}}
                                @endisset
                            </div>
                            <div class="mb-3 col-sm-2">
                                <label for="p_price" class="form-label">Price</label>
                                <input type="number" class="form-control" name="p_price[]"
                                    value="{{ isset($single_data->p_price) ? $single_data->p_price : '' }}" id="p_price">
                            </div>
                            <div class="mb-3 col-sm-1">
                                <label for="p_qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" name="p_qty[]"
                                    value="{{ isset($single_data->p_qty) ? $single_data->p_qty : '' }}" id="p_qty">
                            </div>
                            <div class="mb-3 col-sm-2">
                                <label for="p_discout_type" class="form-label">Discount Type</label>
                                <select class="form-select" name="p_discout_type[]" id="p_discout_type"
                                    aria-label="Floating label select example">
                                    <option selected disabled value="">...Select Discount Type...</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="flat">Flat</option>
                                </select>
                            </div>
                            <div class="mb-3 col-sm-1">
                                <label for="p_discout" class="form-label">Discount</label>
                                <input type="number" class="form-control" name="p_discout[]"
                                    value="{{ isset($single_data->p_discout) ? $single_data->p_discout : '' }}"
                                    id="p_discout">
                            </div>
                            <div class="mb-3 mt-4 pt-2 col-sm-1" id="showhide">
                                <button type="button" class="btn btn-success addbtn">+</button>
                            </div>
                        </div>

                        <button type="submit"
                            class="btn btn-primary">{{ isset($single_data) ? 'Update Product' : 'Add Product' }}</button>
                    </form>
                </div>
            </div>



        </div>



    </div>
    <!-- Add Product Section End -->

@endsection
@section('script')
    {{-- table exort code js --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    {{-- ck editor js code --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        // Hide and show plus button on change of product type
        $(document).ready(function() {
            $('#showhide').hide();
            $(document).on('change', '#p_type_id', function() {
                var p_type = $(this).val();
                // alert(p_type);
                var variation_count = $('.p_variation').length;
                // alert(count);
                if ($(this).val() == '1') {
                    $('#showhide').hide();
                    if(variation_count>1){
                        location.reload();
                    }
                } else {
                    $('#showhide').show();
                }
            });
        });
        //add new row on click + button removebtn
        $(document).on('click', '.addbtn', function() {
            $('.addrow').append(
                `<div class="row removerow"><div class="mb-3 col-sm-2 var_type"> <label for="p_variation" class="form-label">Variation Type</label> <select class="form-select p_variation" name="p_variation[]" id="p_variation" aria-label="Floating label select example"> <option selected value="size">Size</option> <option value="color">Color</option> </select> </div><div class="mb-3 col-sm-1 p_size"> <label for="p_var_value" class="form-label">Size</label> <input type="number" class="form-control" name="p_var_value[]" id="p_var_value"> </div> <div class="mb-3 col-sm-1 p_color" style="display:none;">  </div> <div class="mb-3 col-sm-2"> <label for="p_image" class="form-label">Product Image</label> <input type="file" class="form-control p_image" name="p_image[]" id="p_image"><img class="image-preview" src="#" alt="Image Preview" style="max-width: 50px; max-height: 50px; display: none;"> @isset($single_data->image) <img src="{{ asset($single_data->image) }}" alt="" height="40px" width="40px"> {{-- <input type="hidden" name="old_image" value="{{$single_data->image}}"> --}} @endisset </div> <div class="mb-3 col-sm-2"> <label for="p_price" class="form-label">Price</label> <input type="number" class="form-control" name="p_price[]" value="{{ isset($single_data->p_price) ? $single_data->p_price : '' }}" id="p_price"> </div> <div class="mb-3 col-sm-1"> <label for="p_qty" class="form-label">Qty</label> <input type="number" class="form-control" name="p_qty[]" value="{{ isset($single_data->p_qty) ? $single_data->p_qty : '' }}" id="p_qty"> </div> <div class="mb-3 col-sm-2"> <label for="p_discout_type" class="form-label">Discount Type</label> <select class="form-select" name="p_discout_type[]" id="p_discout_type" aria-label="Floating label select example"> <option selected disabled value="">...Select Discount Type...</option> <option value="percentage">Percentage</option> <option value="flat">Flat</option> </select> </div> <div class="mb-3 col-sm-1"> <label for="p_discout" class="form-label">Discount</label> <input type="number" class="form-control" name="p_discout[]" value="{{ isset($single_data->p_discout) ? $single_data->p_discout : '' }}" id="p_discout"> </div> <div class="mb-3 mt-4 pt-2 col-sm-1" id="showhide"> <button type="button" class="btn btn-danger removebtn">-</button> </div></div>`
                );
        });
        //remove click row on click - button
        $(document).on('click', '.removebtn', function() {
            $(this).closest('.removerow').remove();
        });

        // show images on change
        $(".addrow").on("change", ".p_image", function() {
            var input = this;
            var preview = $(input).siblings(".image-preview"); // Get the corresponding image preview

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.attr("src", e.target.result);
                    preview.css("display", "block");
                };

                reader.readAsDataURL(input.files[0]);
            }
        });

        //show input on select of variation  
        $(document).on('change', '.p_variation', function() {
            var section = $(this).closest('.row');
            var selectedValue = $(this).val();

            var pSize = section.children('.p_size');
            var pColor = section.children('.p_color');

            if (selectedValue === 'size') {
                pSize.show();
                pColor.hide();
                pSize.html(`<label for="p_var_value" class="form-label">Size</label> <input type="number" class="form-control" name="p_var_value[]" id="p_var_value">`);
                pColor.children().remove();
            } else if (selectedValue === 'color') {
                pColor.show();
                pSize.hide();
                pColor.html(`<label for="p_var_value" class="form-label">Color</label> <input type="color" class="form-control" name="p_var_value[]" id="p_var_value">`);
                pSize.children().remove();
            }
        });
    </script>

    <script>
        // function ExportToExcel(type, fn, dl) {
        //     var elt = document.getElementById('tbl_cat_id');
        //     var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        //     return dl ?
        //     XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        //     XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        // }
        // // category search from tabel
        // $(document).ready(function(){  
        //     $('#catsearch').keyup(function(){  
        //             search_table($(this).val());  
        //     });  
        //     function search_table(value){  
        //             $('#tbl_cat_id tr').each(function(){  
        //                 var found = 'false';  
        //                 $(this).each(function(){  
        //                     if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
        //                     {  
        //                         found = 'true';  
        //                     }  
        //                 });  
        //                 if(found == 'true')  
        //                 {  
        //                     $(this).show();  
        //                 }  
        //                 else  
        //                 {  
        //                     $(this).hide();  
        //                 }  
        //             });  
        //     }  
        // });  
    </script>
    @include('sweetalert::alert')


@endsection
