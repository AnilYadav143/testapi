<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}" {{isset($single_data->parent_id)?($subcategory->id==$single_data->parent_id?'selected':''):''}}>{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->subcategory))
        @include('admin.subCategoryList-option',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach