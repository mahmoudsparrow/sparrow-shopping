<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class ShoppingController extends Controller
{
    public function shopping()
    {
        $products = Product::all();
        return view('shopping')->with('products', $products);
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        Session::put('cart', $cart);
//        dd($request->session()->get('cart'));
        //return view('shopping');
        return redirect()->route('shopping');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if (!$cart->totalQty) {
            return view('shopping-cart', ['products' => null]);
        }
        global $totalPrice;
        foreach ($cart->items as $item) {
            $totalPrice += $item['price'];
//            dd($item['price']);
        }
        $cart->totalPrice = $totalPrice;
        Session::put('cart', $cart);
        return View('shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    // remove an item from the cart
    public function removeFromCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($product, $product->id);
        Session::put('cart', $cart);
//        dd($request->session()->get('cart'));
        //return view('shopping');
        return redirect()->route('getCart');
    }

    // remove all similar items from the cart
    public function removeAllItems($id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeAllItems($product, $product->id);
        Session::put('cart', $cart);
        return redirect()->route('getCart');
    }

    // remove or delete all the cart
    public function removeAllCart()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeAllItem();
        Session::put('cart', $cart);
        return redirect()->route('getCart');
    }

    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shopping-cart');
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
//        $email = "sparrow@gmail.com";
//        $stripe = [
//            'publishable' => 'pk_test_4daohFdCjxAKesGAPAB4d2IA',
//            'secret' => 'sk_test_SEDHMWY0BnW8UFLboRcAUQBG'
//        ];
        return view('checkout', ['total' => $cart->totalPrice, 'tkn' => null]);
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shopping-cart');
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_SEDHMWY0BnW8UFLboRcAUQBG');
        $token = Input::get('stripeToken');
        try {
            $customer = Customer::create(array(
                "email" => Auth::user()->email
            ));
//            $stripe = Stripe::make(env('STRIPE_SECRET'), Constant::STRIPE_VERSION);
//            $card = $stripe->cards()->create($customer->id, $token);

            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $token, // obtained with Stripe.js
                "description" => $customer->email
            ));
//            dd("p s");die();
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('shopping')->with('success', 'Successfully purchased products');
    }

    public function check(){
//        $email = Input::get('email');
//        $password = Input::get('password');
//        $user->email = $email;
//        $user->password = $password;

//        $theUser = User::all()->find($data = array('email' => $email, 'password' => $password));
//        $theUser = User::where('email', '=', $email)->count() > 0;

//        user::where('email','sparrwo@yahoo.com')->where('password','123456')->get();
//        if (User::where('email', $email)->where('password','123456')->get()) {
//            $theUser = User::where('email', '=', $email)->where('password', '=', $password)->get();
//            $theUser = User::where('email', $email)->where('phone', '01114379992')->where('name', 'Mahmoud Mostafa')->get();
//            return $theUser;
        $theUser = User::where('id', '>', '0')->get();
        return $theUser;
//        }
//        return view('test')->with('theUser', $theUser);

    }
}
