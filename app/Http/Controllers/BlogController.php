<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResponseController;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogController extends ResponseController
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $blogs = DB::select('select * from blogs where deleted_at is NULL ');

        return $this->sendResponse($blogs,'Successfully retrieved all blogs');
    }

    public function blogWithComments($id): \Illuminate\Http\JsonResponse
    {
        $blogWithComments = Blog::where('id',$id);


        if ($blogWithComments->first()) {
            $getBlogsAndComments = $blogWithComments->with(['comments'])->get();
            return $this->sendResponse($getBlogsAndComments,'Successfully retrieved all blogs');
        } else {
            return $this->sendError('No blog with id: '.$id.' found');
        }

    }

}
