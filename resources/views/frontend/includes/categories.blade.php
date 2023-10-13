<div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
@foreach($subcategories as $subcategory)
     
    <a href="" class="dropdown-item">{{$subcategory->name}}</a>
    @if(count($subcategory->subcategory))
        @include('admin.includes.categories',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach
</div>
    {{-- <a href="" class="dropdown-item">Men's Dresses</a>
    <a href="" class="dropdown-item">Women's Dresses</a>
    <a href="" class="dropdown-item">Baby's Dresses</a> --}}
