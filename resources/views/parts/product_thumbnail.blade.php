<div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
    <!-- Single Prodect -->
    <div class="product">
        <div class="thumb">
            <a href="{{route('productdetails',$product->product_slug)}}" class="image">
                <img src="{{asset('uploads/product_images/'.$product->product_image)}}" alt="Product" />
            </a>
            <span class="badges">
                <span class="new">New</span>
            </span>
            <div class="actions">
                <a ><i class="fa {{(wishlistcheck($product->id)? 'fa-heart text-danger':'fa-heart-o')}} text-danger"></i></a>
                <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
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
            <h5 class="title"><a href="{{route('productdetails',$product->product_slug)}}">{{$product->product_name}}
                </a>
            </h5>
            <span class="price">
                <span class="new">${{$product->product_price}}</span>
            </span>
            <span class="price">
                <span class="new">vendor:{{App\Models\User::find($product->user_id)->name}}</span>
            </span>
        </div>
    </div>
</div>