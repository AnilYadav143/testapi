<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <tr>
        <th scope="row">{{ $i+1 }}</th>
        <td><img src="{{isset($single_data)?'../'.$subcategory->image:$subcategory->image}}" height="40px" width="40px" alt="no image"></td>
        <td>{{$dash}}{{$subcategory->name}}</td>
        <td>{{$subcategory->description}}</td>
        <td>{{$subcategory->created_at}}</td>
        <td class="d-flex">
            <a href="{{route('cat_edit',$subcategory->id)}}" class="btn btn-success"><button class="btn btn-success btn-sm">Edit</button></a>
            <form action="{{route('cat_delete',$subcategory->id)}}" onsubmit="return confirm('Are you sure?');" method="POST">
                @csrf
                    <button class="btn btn-danger btn-lg">Delete</button>
            </form>
        </td>
    </tr>
    @if(count($subcategory->subcategory))
        @include('admin.subCategoryList',['subcategories' => $subcategory->subcategory,'i'=>$i+1])
    @endif
    @php $i=$i+2 @endphp
@endforeach