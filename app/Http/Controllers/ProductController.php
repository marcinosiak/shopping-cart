<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cart;
use App\Product;
use App\Order;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
use Auth;

class ProductController extends Controller
{
    /**
     * wyświetla wszystkie książki na gołwnej stronie
     * @return [type] [description]
     */
    public function getIndex()
    {
      $products = Product::all();
      return view('shop.index', ['products' => $products]);
    }

    /**
     * dodaje produkt do koszyka
     * @param  Request $request [description]
     * @param  int  $id  - id książki w bazie
     * @return przekierowanie do widoku wszystkich książek
     */
    public function getAddToCart(Request $request, $id)
    {
      $product = Product::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product, $product->id);

      $request->session()->put('cart', $cart);
      //dd($request->session()->get('cart'));
      return redirect()->route('product.index');
    }

    /**
     * Wyświetla koszyk z produktami
     * @return [type] [description]
     */
    public function getCart()
    {
      //koszyk jest pusty
      if (!Session::has('cart')) {
          return view('shop.shopping-cart');
      }

      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    /**
     * Wyświetla formularz dla karty kredytowej
     * @return zwraca widok formularza karty z ceną do zapłaty
     */
    public function getCheckout()
    {
      //koszyk jest pusty
      if (!Session::has('cart')) {
        return view('shop.shopping-cart');
      }

      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $total = $cart->totalPrice;
      return view('shop.checkout', ['total' => $total]);
    }


    public function postCheckout(Request $request)
    {
      //koszyk jest pusty
      if (!Session::has('cart')) {
        return redirect()->route('shop.shoppingCart');
      }

      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      Stripe::setApiKey('sk_test_CuHOLCWWQZtcW6A7uc16TkrS');

      try {
        $charge = Charge::create(array(
          "amount" => $cart->totalPrice * 100,
          "currency" => "usd",
          "source" => $request->input('stripeToken'), // obtained with Stripe.js
          "description" => "Test Charge"
        ));

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->payment_id = $charge->id;

        Auth::user()->orders()->save($order);

      } catch (\Exception $e) {
        return redirect()->route('checkout')->with('error', $e->getMessage());
      }

      Session::forget('cart');
      return redirect()->route('product.index')->with('success', 'Successfully purchased płyty!');
    }

}
