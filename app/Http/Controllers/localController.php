<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\Subsruber;
use Exception;

class localController extends Controller
{
    public function index(){
        if(Auth::user()){$carts = Cart::where('user_id' , Auth::user()->id)->count();}
        else{ $carts = 0; }

        $products = Product::orderby('updated_at' , 'asc')->get(); 

        return view('index' , ['totalCart' =>$carts , 'Products' => $products] );
    }
    public function addSubscription(Request $request){
        $data = $request->only('email');
        try{
            Subsruber::create($data);
            $request->session()->flash('sub' , 'succefuly subscription');
            

        }catch(Exception $e){
            $request->session()->flash('sub' , 'this email was already added');
        }
        
        return back();
    }
}
