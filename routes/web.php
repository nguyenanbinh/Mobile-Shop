<?php

use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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


Route::get('addToCart/{productID}', function ($productID) {
    $cart = session()->get('cart');
    $product = Product::find($productID); //tìm tới  của sản phẩm đó

    if (isset($cart[$productID])) {
        $cart[$productID]['quantity']++;//sau khi đã có sản phẩm đó rồi người dùng thêm lần nữa sẽ tự động tăng lên 1 sản phẩm nữa
    } else {
        $cart[$productID] = [
            'product_id' => $product->id, //lấy id của sản phẩm
            'name' => $product->name, //tên sản phẩm
            'price' => $product->price, //giá sản phẩm
            'image' =>  $product->images->first()->path, //hình ảnh đại diện
            'quantity' => 1//(Số lượng sản phẩm) số lượng khi kích vào sẽ tự động thêm là 1 sp vào tránh người dùng click nhiều lần
        ];
    }
    session()->put('cart',$cart);
    return response()->json([
        'code' => 200,
        'message' => 'success',
        'pId' => $productID,
        'cart' => ($cart),
        'totalItem' => count($cart) > 0 ? count($cart) : 0
    ], 200);
})->name('addToCart');

Route::get('/cart', function() {
    $cart = session()->get('cart');
    $total = 0;
    if(isset($cart) && count($cart)) {
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
    }
    return view('cart', compact('cart', 'total'));
})->name('cart');

Route::get('countCart', function() {
    $cart = session()->get('cart');
    $cartCount = isset($cart) ? count($cart) : 0;
    $altHtml = '<h4>Empty Cart</h4>';
    $html = '';
//     if($cartCount) {
//     foreach ($cart as $key => $value) {
//         $html .= '
//                     <div class="product-widget">
//                         <div class="product-img">
//                             <img src="'. \Illuminate\Support\Facades\Storage::url($cart[$key]['image']).'" alt="">
//                         </div>
//                         <div class="product-body">
//                             <h3 class="product-name"><a href="#">'.$cart[$key]['name'].'</a></h3>
//                             <h4 class="product-price"><span class="qty">1x</span>$'.$cart[$key]['price'].'</h4>
//                         </div>
//                         <button class="delete"><i class="fa fa-close"></i></button>
//                     </div>
//               ';
//     }
// }

//     $html = $cartCount > 0 ? $html : $altHtml;
    // dd($html);
    return response()->json(['cartCount' => $cartCount, 'listItem' => $html]);
});

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Categories

Route::get('product-list', [ProductController::class, ''])->name('front.product-list');
Route::get('category/{id}/products', [ProductController::class, 'getProductsByCateID'])->name('front.cate-product-list');

Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware('check_empty_cart');

Route::get('place-order', [CheckoutController::class, 'placeOrder'])->name('place-order');
