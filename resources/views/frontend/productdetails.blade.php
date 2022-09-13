@extends('layouts.app_frontend')

@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Products</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('frontend')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{$product->product_name}}</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Product Details Area Start -->
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        {{-- @foreach (App\Models\Product_Sample_Images::where('product_id',$product->id)->get() as $sample_image) --}}
                        @foreach($product->product_sample_images as $sample_image)

                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto"
                                src="{{asset('uploads/product_sample_images/'.$sample_image->product_sample_images_name)}}"
                                alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container zoom-thumbs mt-3 mb-3">
                    <div class="swiper-wrapper">
                        {{-- @foreach (App\Models\Product_Sample_Images::where('product_id',$product->id)->get() as $sample_image) --}}
                        @foreach($product->product_sample_images as $sample_image)
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto"
                                src="{{asset('uploads/product_sample_images/'.$sample_image->product_sample_images_name)}}"
                                alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content">
                    @if(session('stockout'))
                        <div class="alert alert-danger">
                            {{session('stockout')}}
                        </div>
                    @endif
                    <h2>{{$product->product_name}}</h2>
                    <h4>Avaiable stock : <span class="text-danger">{{$product->product_stock}}</span></h4>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut">${{$product->product_price}}</li>
                        </ul>
                    </div>
                    <style>
                        .ratings {
                            display: flex;
                            align-items: flex-start;
                            margin-bottom: 4px
                        }

                        .ratings .rating-wrap {
                            font-size: 14px;
                            line-height: 1;
                            position: relative;
                            color: #e4e4e4;
                            white-space: nowrap
                        }

                        .ratings .rating-wrap::before {
                            font-family: FontAwesome;
                            content: "    "
                        }

                        .ratings .rating-wrap .star {
                            position: absolute;
                            top: 0;
                            left: 0;
                            overflow: hidden;
                            color: #ffde00
                        }

                        .ratings .rating-wrap .star::before {
                            font-family: FontAwesome;
                            content: "    "
                        }

                        .ratings .rating-num {
                            font-size: 14px;
                            line-height: 1;
                            margin-left: 6px;
                            color: #9f9e9e
                        }
                    </style>
                    <span class="ratings">
                        <span class="rating-wrap">
                            <span class="star" style="width: {{rating_percentage($product->id)}}%"></span>
                        </span>
                        <span class="rating-num">( {{number_of_review($product->id)}} )</span>
                    </span>
                    <p class="mt-30px mb-0">{{$product->short_description}} </p>
                    <form action="{{route('addtocart',$product->id)}}" method="POST">
                        <div class="pro-details-quality">
                            @csrf
                            <div class="cart-plus-minus">   
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                            </div>
                            <div class="pro-details-cart">
                                @auth
                                <button class="add-cart" type="submit"> Add To
                                    Cart</button>
                                @else
                                <a href="" data-bs-toggle="modal" data-bs-target="#loginActive" class="add-cart" type="submit"> Add To
                                    Cart</a>
                                @endauth
                            </div>
                    </form>
                    @auth
                    @if($wishlist)
                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                        <a href="{{route('product.remove',$wishlist_id)}}"><i class="fa fa-heart text-danger"></i></a>
                    </div>
                    @else
                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                        <a href="{{route('product.wishlist',$product->product_slug)}}"><i class="fa fa-heart"></i></a>
                    </div>
                    @endif
                    @else
                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                        <a data-bs-toggle="modal" data-bs-target="#loginActive"><i class="pe-7s-like"></i></a>
                    </div>
                    @endauth

                </div>
                <div class="pro-details-sku-info pro-details-same-style  d-flex">
                    <span>SKU: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="#">{{ $product->product_code }}</a>
                        </li>
                    </ul>
                </div>
                <div class="pro-details-categories-info pro-details-same-style d-flex">
                    <span>Categories: </span>
                    <ul class="d-flex">
                        <li>
                            <a
                                href="{{route('categorywiseproducts',$product->category->id)}}">{{ $product->category->category_name }}</a>
                        </li>
                        {{-- <li>
                                <a href="{{route('categorywiseproducts',$product->category_id)}}">{{ App\Models\Category::find($product->category_id)->category_name }}</a>
                        </li> --}}
                    </ul>
                </div>
                <div class="pro-details-social-info pro-details-same-style d-flex">
                    <span>Share: </span>
                    <ul class="d-flex">
                        <li>
                            <a target="_blank" href="http://www.facebook.com/sharer.php?u={{url()->full()}}"><i
                                    class="fa fa-facebook"></i></a>

                        </li>
                        <li>
                            <a href="http://twitter.com/share?url={{url()->full()}}&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/share?url={{url()->full()}}" target="_blank"><i
                                    class="fa fa-google"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-bs-toggle="tab" href="#des-details2">Information</a>
                <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                <a data-bs-toggle="tab" href="#des-details3">Reviews ({{number_of_review($product->id)}})</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper text-start">
                        <ul>
                            <li><span>Weight</span> 400 g</li>
                            <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                            <li><span>Materials</span> 60% cotton, 40% polyester</li>
                            <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                        </ul>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>

                            Lorem ipsum dolor sit amet, consectetur adipisi elit, incididunt ut labore et. Ut enim
                            ad minim veniam, quis nostrud exercita ullamco laboris nisi ut aliquip ex ea commol
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                            qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste
                            natus error sit voluptatem accusantiulo doloremque laudantium, totam rem aperiam, eaque
                            ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                            explicabo. Nemo enim ipsam voluptat quia voluptas sit aspernatur aut odit aut fugit, sed
                            quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                            quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                            quia non numquam eius modi tempora incidunt ut labore

                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="review-wrapper">
                                @forelse ($reviews as $review)
                                <div class="single-review">
                                    <div class="review-img">
                                        <img style="height: 50px; width: 50px" class="rounded-circle img-fluid" src="{{asset('uploads/profile_photos/'.$review->user->profile_photo)}}" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>{{$review->user->name}}</h4>
                                                </div>
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: {{ $review->rating *20}}%"></span>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                {{$review->review}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="alert alert-danger text-center">
                                        No Review Yet
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product details description area end -->

<!-- Related product Area Start -->
<div class="related-product-area pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30px0px line-height-1">
                    <h2 class="title m-0">Related Products</h2>
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
            <div class="new-product-wrapper swiper-wrapper">
                @forelse($related_products as $related_product)
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="{{route('productdetails',$related_product->product_slug)}}" class="image">
                                <img src="{{asset('uploads/product_images/'.$related_product->product_image)}}"
                                    alt="Product" />
                                {{-- <img class="hover-image" src="assets/images/product-image/6.jpg"
                                    alt="Product" /> --}}
                            </a>
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="pe-7s-search"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 100%"></span>
                                </span>
                                <span class="rating-num">( 5 Review )</span>
                            </span>
                            <h5 class="title"><a
                                    href="{{route('productdetails',$related_product->product_slug)}}">{{$related_product->product_name}}
                                </a>
                            </h5>
                            <span class="price">
                                <span class="new">${{$related_product->product_price}}</span>
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-danger">
                    <h3 class="text-center">No Related Product To Show</h3>
                </div>
                @endforelse

            </div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>
<!-- Related product Area End -->



@endsection

