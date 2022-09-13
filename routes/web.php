<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SslCommerzPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.index');
// });
Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/product/details/{slug}', [FrontendController::class, 'productdetails'])->name('productdetails');
Route::get('/category/wise/{id}', [FrontendController::class, 'categorywiseproducts'])->name('categorywiseproducts');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('about-us', [FrontendController::class, 'about_us'])->name('about.us');
Route::post('/contact/message', [FrontendController::class, 'contact_message'])->name('contact.message');
Route::get('/all/blogs', [FrontendController::class, 'all_blogs'])->name('all.blogs');
Route::get('/blogs/{slug}', [FrontendController::class, 'blogs'])->name('frontend.blogs');
Route::post('/comment/{blog_id}', [FrontendController::class, 'comment'])->name('comment.store');
Route::post('/comments/{comment_id}', [FrontendController::class, 'comment_replies'])->name('comment.replies');

Route::get('/my/comments', [FrontendController::class, 'my_comments'])->name('my.comments');
Route::post('comments/delete/{comment_id}', [FrontendController::class, 'comment_destroy'])->name('comment.destroy');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/email/offer', [HomeController::class, 'email_offer'])->name('emailoffer');
Route::get('/single/email/offer/{id}', [HomeController::class, 'single_email_offer'])->name('singlemailoffer');
Route::post('/check/email/offer/', [HomeController::class, 'check_email_offer'])->name('checkemailoffer');
Route::get('/location', [HomeController::class, 'location'])->name('location');
Route::post('/location/update', [HomeController::class, 'location_update'])->name('location.update');
Route::get('/my/orders', [HomeController::class, 'my_orders'])->name('my.order');
Route::get('/invoice/download', [HomeController::class, 'invoice_download'])->name('invoice.download');
Route::get('/myorder/details/{order_id}', [HomeController::class, 'myorder_details'])->name('myorder.details');
Route::get('/all/orders', [HomeController::class, 'all_orders'])->name('all.orders');
Route::get('/order/details/{order_id}', [HomeController::class, 'order_details'])->name('order.details');
Route::get('/mark.delivered/{order_id}', [HomeController::class, 'mark_delivered'])->name('mark.delivered');
Route::post('/rating/{order_details_id}', [HomeController::class, 'rating'])->name('rating');



Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/name/change', [ProfileController::class, 'profile_namechange'])->name('profile.namechange');
Route::post('/profile/password/change', [ProfileController::class, 'profile_password_change'])->name('profile.password_change');
Route::post('/profile/photo/change', [ProfileController::class, 'photochange'])->name('profile.photochange');


Route::get('/product/wishlist/{slug}', [WishlistController::class, 'insert'])->name('product.wishlist');
Route::get('/product/wishlist/remove/{wishlist_id}', [WishlistController::class, 'destroy'])->name('product.remove');

Route::get('/AddFromWishlist/{wishlist_id}', [CartController::class, 'addfromwishlist'])->name('addfromwishlist');
Route::post('add/to/cart/{product_id}', [CartController::class, 'addtocart'])->name('addtocart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/single/cart/remove/{id}', [CartController::class, 'removesinglecart'])->name('removesinglecart');
Route::post('/cart/update', [CartController::class, 'cartupdate'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'placeorder'])->name('placeorder');
Route::post('/get/city/list', [CheckoutController::class, 'get_city_list'])->name('get_city_list');

Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');
Route::post('/contacts/delete/{id}', [ContactController::class, 'contacts_destroy'])->name('contacts.destroy');


Route::get('/all/comments', [CommentController::class, 'all_comments'])->name('all.comments');
Route::post('/comments/delete/{$comment_id}', [CommentController::class, 'comment_delete'])->name('comment.delete');


Route::resource('/vendor', VendorController::class);
Route::resource('/coupon', CouponController::class);
Route::resource('/product', ProductController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/wishlist', WishlistController::class);
Route::resource('/blog', BlogController::class);
Route::resource('/about', AboutController::class);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// Route::get('/github/redirect',[GithubController::class,'github_redirect'])->name('github.redirect');
// Route::get('/github/callback',[GithubController::class,'github_callback'])->name('github.callback');