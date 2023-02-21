<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout() {
        $categories = Category::all();
        $paymentMethod = 1;

        $carts = session()->get('cart');//get data from `cart` session
        //Check quantity product vs quantity in cart
        foreach ($carts as $item) {
            $productID = $item['product_id'];
            $quantityInput =  $item['quantity'];
            $product = Product::findOrFail($productID);
            $quantityDB = $product->quantity;
            // if ($quantityInput > $quantityDB) {
            //     return redirect()->back()->with('error', 'Quá số lượng trong kho hoặc đã hết hàng vui lòng kiểm tra lại trước khi thanh toán')->withInput();
            // }
        }
        $total = 0;
        if(isset($carts) && count($carts)) {
            foreach ($carts as $item) {
                $total += $item['quantity'] * $item['price'];
            }
        }

    return view('checkout', compact('categories', 'carts', 'paymentMethod', 'total'));
    }

    public function placeOrder(Request $request) {

    DB::beginTransaction();

    try {
        $carts = session()->get('cart') ?? []; // check giỏ hàng trống hay không
        //xử lý kiểm tra quantity( số lượng )
        foreach ($carts as $item) {
            $prod_id = $item['product_id'];
            $qty_input =  $item['quantity'];
            $product = Product::findOrFail($prod_id);
            $qty_db = $product->quantity;

            if ($qty_input > $qty_db) {
                return redirect()->back()->with('error', 'Quá số lượng trong kho hoặc đã hết hàng vui lòng kiểm tra lại')->withInput();
            }
        }

        //Add data from cart to Order
        $order = new \App\Models\Order();
        $order->user_id = auth()->id();
        $order->payment_method_id = 1;
        // $order->shipping_method = $paymentmethod->id;
        $order->fullname = $request->input('name') ?? auth()->user()->name;
        $order->email = $request->input('email') ?? auth()->user()->email;
        $order->phone = $request->input('phone') ?? auth()->user()->phone;
        $order->address = $request->input('address') ?? auth()->user()->address;
        $order->status = 1;
        $order->save();

        foreach ($carts as $item) {
            \App\Models\OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
            // to-od handle quantity after checkout,
            $prod = Product::where('id', $item['product_id'])->first();
            $prod->quantity = $prod->quantity - $item['quantity'];
            $prod->update();
        }
        DB::commit();
        $request->session()->pull('cart');

        return redirect()->route('home');
    } catch (Exception $exception) {
        DB::rollBack();
        dd($exception->getMessage());
        return redirect()->back()->with('error', $exception->getMessage())->withInput();
    }
    }
}
