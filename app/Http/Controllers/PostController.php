<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller
{
    public function index()
    {
        $product = Post::with('Category')->latest()->paginate(10);
        return view('posts.index',compact('product'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(){
        $category = Category::where('parent_id','=',null)->pluck('name','id')->toArray();
        return view('posts.create',compact('category'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return redirect()->back();
        }
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('post.edit')->withPost($post)->withCategories($categories);
    }

    public function store(Request $request)
    {   
         
         $this->validate($request, array(
            'category_id' => 'required',
            'product_name' => 'required',
            'product_image' => 'required|max:5270',
             'product_description' => 'required',
            'price' => 'required|numeric',
        ));

       
        $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
        request()->product_image->move(public_path('product_image'), $imageName);

        $product = new Post();
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_image = $imageName;
        $product->product_description = $request->product_description;
        $product->price = $request->price;
        $product->save();

         return redirect('product')->with('message', 'Product Added Successfully!');
    }


    public function destroy($id)
    {    
        Post::find($id)->delete();
        return redirect('product')->with('message', 'Successfully Product Delete!');
    }

}
