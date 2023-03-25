<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class CartController extends Controller
{

    protected $cart;
    public function __construct(CartRepository $cart){
        $this->cart = $cart;
    }
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('front.cart',['cart' =>  $this->cart, ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required ', 'int', 'exists:products,id'],
            'quantity' => ['nullable ', 'int', 'min:1'],

        ]);

        $prooduct = Product::findOrFail($request->post('product_id'));
        $cart->add($prooduct ,$request->post('quantity'));

        return redirect()->route('cart.index')
        ->with('success' , 'Product added to cart!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $request->validate([
            'quantity' => ['required ', 'int', 'min:1'],

        ]);

        $this->cart->update($id ,$request->post('quantity'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( CartRepository $cart , $id)
    {

        $cart->delete($id);
    }
}
