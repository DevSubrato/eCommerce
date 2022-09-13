@extends('layouts.app_frontend')

@section('content') 
    
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Blog Details</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Blog Details</li>
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
                <div class="col-lg-8 col-md-12 offset-lg-2">
                    <div class="blog-posts">
                        <div class="single-blog-post blog-grid-post">
                            <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                <img class="img-fluid" src="{{asset('uploads/blog_photos/'.$blog->image)}}" alt="blog" />
                            </div>
                            <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                                <div class="blog-athor-date">
                                    <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                            aria-hidden="true"></i> {{$blog->created_at->format('d,M,Y')}}</a>
                                    <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i>
                                        1.5 K</a>
                                </div>
                                <h4 class="blog-title">{{$blog->title}}</h4>
                                <p data-aos="fade-up">
                                    {!! $blog->description !!}
                                </p>
                            </div>
                        </div>
                        <!-- single blog post -->
                    </div>
                    <div class="blog-single-tags-share d-sm-flex justify-content-between">
                        <div class="blog-single-share mb-xs-15px d-flex" data-aos="fade-up" data-aos-delay="200">
                            <ul class="social">
                                <li class="m-0">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </li>
                            </ul>
                            <span class="title"><a class="ml-10px" href="#"> 2 <i class="fa fa-comments m-0"></i></a></span>
                        </div>
                    </div>
                    {{-- <div class="blog-nav">
                        <div class="row">
                            <div class="col-6">
                                <a class="nav-left" href="#"><i class="fa fa-angle-left"></i></a>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <a class="nav-right" href="#"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div> --}}

                    <div class="comment-area">
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">Comments ({{$blog->comments->count()}})</h2>
                        <div class="review-wrapper">
                            @foreach ($blog->comments as $comment)     
                            <div class="single-review" data-aos="fade-up" data-aos-delay="200">
                                <div class="review-img">
                                    <img src="{{asset('uploads/profile_photos/'.$comment->user->profile_photo)}}" alt="" />
                                </div>
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-left">
                                            <div class="review-name">
                                                <h4 class="title">{{$comment->user->name}} </h4>
                                                <span class="date">{{$comment->created_at->format('d M Y')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-bottom">
                                        <p>
                                            {{$comment->comment}}
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>

                            @if($comment->replies)
                            
                            @foreach ($comment->replies as $reply)
                            <div class="single-review child-review" data-aos="fade-up" data-aos-delay="200">
                                <div class="review-img">
                                    <img src="{{asset('uploads/profile_photos/'.$reply->user->profile_photo)}}" alt="" />
                                </div>
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-left">
                                            <div class="review-name">
                                                <h4 class="title">{{$reply->user->name}} </h4>
                                                <span class="date">{{$reply->created_at->format('d M Y')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-bottom">
                                        <p>{{$reply->comment}}</p>
                                        {{-- <div class="review-left">
                                            <a href="#">Reply <i class="fa fa-arrow-right"></i></a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            <div class="p-3">
                                <form action="{{route('comment.replies',$comment->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="reply" class="form-control">
                                        <input type="hidden" name="blog_id" value="{{$comment->blog_id}}">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="submit" value="reply" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @auth
                    <div class="blog-comment-form">
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">Leave a Comment</h2>
                        <form action="{{route('comment.store',$blog->id)}}" method="POST">
                        <div class="row">
                                @csrf
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                    <div class="single-form">
                                        <textarea name="comment" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                    <button class="btn btn-primary btn-hover-dark border-0 mt-30px" type="submit">Post Comment
                                        <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <h3 class="text-center text-danger">Login for comment</h3>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <!-- Blag Area End -->
@endsection