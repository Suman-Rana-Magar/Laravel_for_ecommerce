<link href="{{asset('css/style.css')}}" rel="stylesheet">
@extends('/layouts.master')

@section('title','Detail')

@section('navbar')
@parent

@endsection

<style>
    .contents{
        margin-left: 20px;
    }
    .reviewTitle
    {
        background-color: #e0e1e6;
        padding: 10px 20px;
    }
    .reviews
    {
        background-color: #e3dfdf;
        margin-left: -20px;
        padding: 5px 20px;
    }
    .image
    {
        -webkit-user-drag: none;
    }
</style>

@section('body')
<div class='container mt-5'>
    @if (session('success'))
    <div class="alert alert-success" style="width: 400px; margin: auto;">
        {{ session('success') }}
    </div>
    @endif
    <div class='card'>
        <a href='{{route("products.index")}}' style='margin-left: 20px; color: black; '><i class="fa-solid fa-left-long"></i></a>
        <div class='row'>
            <div class='col-md-6'>
                <div class='main_image p-3 text-center'>
                    <h2>PRODUCT DETAIL</h2>
                    <div class='text-center p-4'> <img style="height: 250px; width: auto;" id='main-image' src='{{asset("storage/" . $product->image)}}'> </div>
                </div>
            </div>
            <div class='main col-md-6'>
                <div class=' mb-4 mt-4'>
                    <h5 class='text-uppercase'>{{$product->title}}</h5>
                    <div class='price d-flex flex-row align-items-center'> <span style='margin-top: 5px; color: #ff0000; font-size: 25px;' class='act-price'><b>Rs.{{$product->selling_price}}</b></span>
                    </div>
                    <!-- <p><s style='color: #4d2600;'>Rs.{{$product->marked_price}}</s> -{{$product->discount}}%</p> -->
                </div>
                <p>{{$product->description}}</p>
                @if($product->quantity > 0)
                <p id='availableQuantity'>Available Quantity: {{ ($product->quantity ) }}</p>
                <form action="{{route('carts.store',$product->id)}}" method="post">
                    @csrf
                    <label for='quantity'>
                        <h5 style='margin-top: 0; margin-bottom: 7px;'>Quantity : </h5>
                    </label>
                    <select id='quantity' name='quantity'>
                        @php
                        $quantity = $product->quantity;
                        @endphp
                        @for($i=1; $i<=$quantity; $i++) <option value="{{$i}}">{{$i}}</option>
                            @endfor
                    </select>
                    @if(Auth::user())
                    <div class='cart mb-4'>
                        <input type='submit' id='addCart' class="btn btn-danger @error('login') is-invalid @enderror" value='ADD TO CART'>
                    </div>
                    @else
                    <div class='cart mb-4'>
                        <input type='submit' id='addCart' class='btn btn-danger' value='ADD TO CART' disabled>
                        <span style="color: red; display: flex; margin-top: 5px;">*Please Login For Adding Items To Cart !</span>
                    </div>
                    @endif
                </form>
                @else
                <span style="color: red; font-size: 20px;">Out Of Stuck !</span>
                @endif
            </div>
        </div>

    </div>
    @if($reviews->isNotEmpty())
    <div class="card mt-2" style="margin-bottom: 10px;">
        <div class="reviewTitle">
            <h4>Reviews and Ratings</h4>
        </div>
        <div class="contents">
            <div class="totalRating">
                <h4 style="margin-top: 5px;">{{ $totalReviews }}/<span style="color: #666666;">10</span></h4>
                <div class>
                    @if($totalReviews <= 2)
                    <img class="image" src="{{ asset('storage/others/angry.png') }}" alt="Happy" height="150" width="auto">
                    @elseif($totalReviews > 2 && $totalReviews <= 4)
                    <img class="image" src="{{ asset('storage/others/slightly_angry.png') }}" alt="Happy" height="150" width="auto">
                    @elseif($totalReviews > 4 && $totalReviews <= 6)
                    <img class="image" src="{{ asset('storage/others/none.png') }}" alt="Happy" height="150" width="auto">
                    @elseif($totalReviews > 6 && $totalReviews <= 8)
                    <img class="image" src="{{ asset('storage/others/slightly_happy.png') }}" alt="Happy" height="150" width="auto">
                    @else
                    <img class="image" src="{{ asset('storage/others/happy.png') }}" alt="Happy" height="150" width="auto">
                    @endif
                    <!-- images here for user satisfaction -->
                </div>
                <p style="color: #404040; margin-bottom: 10px;">{{ $reviewsCount }} Ratings</p>
                <h5 class="reviews">Reviews</h5>
                <!-- foreach from here -->
                @foreach($reviews as $review)
                @php
                $user = $review->user;
                $userName = $user->name;
                @endphp
                <div class="allReviews">
                    <h6 style="font-size: 18px; margin-bottom: 0;">{{ $review->rating }}/10</h6>
                    <p style="font-size: 12.5px; color: #404040; margin-bottom: 5px;">by {{ $userName }}</p>
                    <p style="border-bottom-style: groove; margin-right: 20px; padding-bottom: 5px;">{{ $review->comments }}</p>
                </div>
                @endforeach
                <!-- TO here -->
            </div>
        </div>
    </div>
    @endif
</div>
@endsection