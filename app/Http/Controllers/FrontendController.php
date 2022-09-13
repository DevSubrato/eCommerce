<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\About;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Toastr as ToastrToastr;

class FrontendController extends Controller
{
    public function index()
    { 
      $blogs = Blog::orderBy('created_at','desc')->limit(3)->get();     
      $products = Product::all();
      $categories = Category::where('status', 'show')->get();
      return view ('frontend.index',compact('categories','products','blogs'));
    }
    
    public function productdetails($slug)
    {
      $user=Auth::id();
      $product=Product::where('product_slug',$slug)->first()->id;

      $wishlist=Wishlist::where('user_id',$user)->where('product_id',$product)->exists();
      if($wishlist)
      {
        $wishlist_id=Wishlist::where('user_id',$user)->where('product_id',$product)->first()->id;
      }else{
        $wishlist_id="";
      }
      
      $reviews=Rating::where('product_id',$product)->get();
      $product = Product::where('product_slug',$slug)->firstOrFail();
      $related_products= Product::where('product_slug','!=',$slug)->where('category_id',Product::where('product_slug',$slug)->firstOrFail()->category_id)->get();
      return view('frontend.productdetails',compact('product','related_products','wishlist','wishlist_id','reviews'));
    }

    public function categorywiseproducts($category_id)
    {
       $category_name = Category::find($category_id)->category_name;
       $total_prodcuts=Product::count();
       $products = Product::where('category_id', $category_id)->get();
       return view('frontend.categorywiseproducts',compact('products','category_name','total_prodcuts'));
    }

    public function shop ()
    {
      if(isset($_GET['min_value']))
      {
        $min_value=$_GET['min_value'];
        $max_value=$_GET['max_value'];
        $products=Product::whereBetween('product_price',[$_GET['min_value'],$_GET['max_value']])->get();
      }else{
        $min_value="";
        $max_value="";
        $products=Product::all();
      } 
      return view('frontend.shop',compact('products','min_value','max_value'));
    }

    public function all_blogs()
    {
      $blogs = Blog::orderBy('created_at','desc')->paginate(3);
      return view('frontend.blogs',compact('blogs'));
    }
    public function blogs($slug)
    {
      $blog = Blog::where('slug',$slug)->first();
      $comments = Comment::where('blog_id',$blog->id)->with('replies')->get();
      return view('frontend.single_blog',compact('blog','comments'));
    }

    public function about_us  ()
    {
      $abouts = About::orderBy('created_at','asc')->get();
      return view('frontend.about',compact('abouts'));
    }
    public function contact ()
    {
      return view('frontend.contact');
    }

    public function contact_message (Request $request)
    {
      $request->validate([
        'name'=>'required',
        'email'=>'required|email',
        'message'=>'required|max:250',
      ]);

      Contact::insert([
        'name'=> $request->name,
        'email'=> $request->email,
        'message'=> $request->message,
        'created_at'=> Carbon::now(),
      ]);
      Toastr::success('your message send successfully we will contact you soon','success');
      return back();
    }

    public function comment(Request $request,$blog_id)
    {

       $request->validate([
        'comment'=>'required',
       ]);

       Comment::insert([
        'user_id'=>Auth::id(),
        'blog_id'=>$blog_id,
        'comment'=>$request->comment,
        'created_at'=>Carbon::now(),
       ]);
       Toastr::success('Your comment posted successfully','posted');
       return back();
    }

    public function comment_replies(Request $request,$comment_id)
    {
      $request->validate([
        'reply'=>'required',
      ]);

      Comment::insert([
        'user_id'=>Auth::id(),
        'blog_id'=>$request->blog_id,
        'comment_id'=>$comment_id,
        'comment'=>$request->reply,
        'created_at'=>Carbon::now(),
      ]);
      Toastr::success('Your reply added successfully','Success');
      return back();
    }

    public function my_comments()
    {
        $comments = Comment::with('blog','user')->where('user_id',Auth::id())->WhereNull('comment_id')->get();
        return view('comments.index',compact('comments'));
    } 
    
    public function comment_destroy ($comment_id)
    {
       return "ami ekhane";
       die();
        Comment::find($comment_id)->delete();
        Toastr::error('comment deleted successfully','success');
        return back();
    }
    
}

