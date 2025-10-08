<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponse;

    public function getAllBlogs(){
        $blogs=Blog::select('id','image','short_description','title')->latest()->get();

        if($blogs->isEmpty()){
            return $this->error([],'No Blog found yet.',422);
        }
        return $this->success($blogs,'All Bogs',200);
    }

    public function blogDetails($id)  {
        $blog=Blog::select('id','category_id','author','published_date','image','long_description','title')->with('category:id,name')->find($id);

        if(!$blog){
            return $this->error([],'Did not found details of the blog.',422);
        }

        return $this->success($blog,'blog details',200);
    }
}
