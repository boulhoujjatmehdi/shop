<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\User;
use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs=Blog::all();
        foreach($blogs as $item){
            $item['author']=User::find($item->user_id)->pluck('last_name');
        }
        
        
        
        if(Auth::user()){$carts = Cart::where('user_id' , Auth::user()->id)->count();}
        return view('blog', ['blogs' => $blogs , 'totalCart'=>$carts ?? '0']);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        $author = User::find($blog->user_id)->pluck('last_name');
        if(Auth::user()){$carts = Cart::where('user_id' , Auth::user()->id)->count();}
        return view('blog-detail' , ['blog'=>$blog , 'totalCart'=>$carts ?? '0' ,'author'=> $author[0] ]);
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
}
