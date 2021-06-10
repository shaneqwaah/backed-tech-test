<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResponseController;
use Illuminate\Support\Facades\DB;

class BlogController extends ResponseController
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $blogs = DB::select('select * from blogs where deleted_at is NULL ');

        return $this->sendResponse($blogs,'Successfully retrieved all blogs');
    }
}
