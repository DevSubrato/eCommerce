@extends('layouts.app_frontend')

@section('content') 

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Blog Grid</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Blog Grid</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- Blog Area Start -->
<div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
    <div class="container">
        <div class="row">
            @foreach ($blogs as $blog)
                
            <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="{{route('frontend.blogs',$blog->slug)}}"><img src="{{asset('uploads/blog_photos/'.$blog->image)}}"
                                class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="{{route('frontend.blogs',$blog->slug)}}"><i class="fa fa-calendar"
                                    aria-hidden="true"></i> {{$blog->created_at->format('d M Y')}}</a>
                            <a class="blog-mosion" href="{{route('frontend.blogs',$blog->slug)}}"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                K</a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link"
                                href="{{route('frontend.blogs',$blog->slug)}}">{{$blog->title}}</a></h5>

                        <p>{!! Str::limit(strip_tags($blog->description), 100) !!}</p>

                        <a href="{{route('frontend.blogs',$blog->slug)}}" class="btn btn-primary blog-btn"> Read More<i class="fa fa-arrow-right ml-5px"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- End single blog -->
        </div>

        <!--  Pagination Area Start -->
        {{-- <div class="row pro-pagination-style text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-12">
                {{ $blogs->links() }}
            </div>
        </div> --}}
            <div class="pro-pagination-style text-center" data-aos="fade-up" data-aos-delay="200">
            
                
                    
                    <li class="li">{{ $blogs->links() }}</li>
                    
                    
                
            </div>
        </div>
        <!--  Pagination Area End -->
    </div>
</div>
<!-- Blag Area End -->


@endsection