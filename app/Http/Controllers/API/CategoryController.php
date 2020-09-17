<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Category;
use App\Post;
use Validator;
   
class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryList()
    {
        $categoryList = Category::where('parent_id',null)->with('children')->get()->toArray();
        return $this->sendResponse($categoryList, 'Category fetch successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productList(Request $rquest)
    {
        $getRequest = $rquest->all();
          $productsList = Post::where('category_id',$getRequest['category_id'])->with(['Category.children' => function($query){
            return $query->where('status','Active')->get()->toArray();
            }])->get()->toArray();

        return $this->sendResponse($productsList, 'Products fetch successfully.');
    }

}