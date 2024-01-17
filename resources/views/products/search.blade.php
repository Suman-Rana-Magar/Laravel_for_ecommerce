@extends('/layouts/master')

@section('title','Product | Search')
<style>
    .image-container
    {
        width: auto;
        overflow: hidden;
        margin-top: 6px; 
        margin-left: auto;
        margin-right: auto;
        height: 13rem; 
    }
    .img
    {
        max-width: 220px; 
        width: auto; 
        height: 200px;
        transition: .2s;
    }
    .img:hover {
        transform: scale(1.5);
        width: auto;
    }
    #paginate
    {
        margin-top: 20px;
        justify-content: center;
        display: flex;
        align-items: center;
    }
</style>
@section('body')
<div style="margin-left: 40px; height: 40px; width: 100%; margin-bottom: -20px;">
    <p style="font-size: 20px; font-weight: bold; color: yellow; cursor: default">Search>"{{ $search }}"</p>
</div>
@if($searchedProducts->isNotEmpty())

@foreach($searchedProducts as $product)

<div style="margin-left: 40px; display: inline-block;">
        <div style="margin-top: 20px;">
            <div class='card text-center' style='width:250px; height: 400px;'>
                <div class="image-container">
                    <img class='img' src='{{asset("storage/" . $product->image)}}' alt='{{$product->title}}'>
                </div>
                <div class='card-body' style='height: 200px; width: auto; '>
                    <h5 style='margin-top: 0px; margin-bottom: 3px;'>{{Illuminate\Support\Str::limit($product->title, 20)}}</h5>
                    <div style='margin-top: 0; height:50px; width: auto; '>
                        <p style='margin-top: 0; margin-bottom: 3px;'>{{Illuminate\Support\Str::limit($product->description, 50)}}</p>
                    </div>
                    <h6 style='margin-top: 10px; color: #ff0000; font-size: 20px;'>Rs.{{$product->selling_price}}</h6>
                    <!-- <p><s style='color: #4d2600;'>Rs.200</s> -3%</p> -->
                    <a href='{{route("products.show",$product->id)}}'><button class='btn bg-success' style="color: white;">Detail</button></a>
                </div>
            </div>
        </div>
    </div>

@endforeach
@else
<div>
    <h2 style="text-align: center;">No Such Product Found !</h2>
</div>
@endif
<div id="paginate">
{{ $searchedProducts->withQueryString()->links() }}
</div>
@endsection