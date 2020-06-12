<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cart;
use App\Product;
Use Exception;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        if(Auth::user()){
                    $carts = Cart::all()->where('user_id' , Auth::user()->id);
                    $totalCart = Cart::where('user_id' , Auth::user()->id)->count();
                
                    $cartPropduct = array();
                    $i=1;
                    $total = 0;
                    foreach($products as $item){

                        foreach($carts as $cart){
                                if($item->id == $cart->product_id){
                                $cartPropduct[$i] = $item; 
                                $cartPropduct[$i]->stock = $cart->quantity; 
                                $cartPropduct[$i]->size = $cartPropduct[$i]->price * $cartPropduct[$i]->stock;
                                $total += $cartPropduct[$i]->price * $cartPropduct[$i]->stock;
                                $i++;
                            }
                        }
                    }         
                    return view('cart' , ['allProducts'=>$products , 'allcart'=>$cartPropduct , 'total'=>$total , 'totalCart'=>$totalCart]  );
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


                    $data = $request->only(['user_id' , 'product_id' , 'quantity' , 'from']);

                    try {
                    if($data['from'] == 'products' ){

                        $data['user_id'] = Auth::user()->id ;
                        $data['quantity'] = 1 ;
                        $product = Cart::create($data);
                        $request->session()->flash('status', 'Item was added');
                        $request->session()->flash('scolor' , 'green' );
                        return back();}
                     
                    } catch (Exception  $e) {

                    $request->session()->flash('status', 'this product was already added');
                    $request->session()->flash('scolor' , 'red' );
                    return back();
                    }
                    
                    
                    
                    
                    
                    
                    if($data['from'] == 'cart' ){
                        
                        $request->validate([
                            'quantity'=>'required|integer|min:1|max:30'
                        ]);

                        $cart = Cart::where('user_id',  $data['user_id'] )->where('product_id', $data['product_id'])->update(['quantity' => $data['quantity']]);;

                        return redirect('cart');
                        
                    }
                    

                    return back();




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Cart::where('user_id' , Auth::user()->id)->where('product_id' , $id)->delete();
        return redirect('cart');
    }
}
