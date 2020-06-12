<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
// use App\Auth;
use App\Cart;
use App\Category;
use App\ProductColor;
use App\ProductSize;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->cookie('name');
        $products = Product::all();
        if(Auth::user()){
                    $carts = Cart::where('user_id' , Auth::user()->id)->count();
        
                    return view('product' , ['allProducts'=>$products , 'totalCart'=> $carts]  );
        }else{
            
        }




        return view('product' , ['allProducts'=>$products, 'allcart'=>'' ,  'totalCart'=> $carts ?? '0']);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title' , 'price' , 'size' , 'color' , 'description' , 'additional_info' , 'stock' , 'categorie_id']);
        // $data['title'] 
        $product = Product::create($data);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $category = Category::find($product->categorie_id);
        $color = ProductColor::all()->where('product_id', '=' , $id );
        $size = ProductSize::all()->where('product_id', '=' , $id );

        return view('productdetail' ,['product' =>$product , 'category'=>$category , 'colors' => $color, 'sizes' => $size ] );
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
        //
    }
    public function category($cate)
    {   

        $cat = Category::select()->where('domain_name' , $cate)->get();


        $products = array();
        $productse = Product::all(); 
        $i=0;
        foreach($productse as $p){
            foreach($cat as $ca){

                if($p->categorie_id == $ca->id ){
                    $products[$i]=$p;
                    
                }
            
            }

            $i++;



        }

         
        $productse = Product::all();
        if(Auth::user()){
                    $carts = Cart::all()->where('user_id' , Auth::user()->id);
                    $cart = Cart::where('user_id' , Auth::user()->id)->count();
                    

                    // return $carts;
                    return view('product' , ['allProducts'=>$products , 'allcart'=>$carts , 'totalCart' => $cart  ]  );
        }else{
            $carts='';
        }
        return view('product' , ['allProducts'=>$products ,  'allcart'=>$carts , 'totalCart' =>$cart ?? '0'  ]); 
    } 



}
