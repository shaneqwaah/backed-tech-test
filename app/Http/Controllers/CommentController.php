<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResponseController;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends ResponseController
{
    public function addCommentToBlog(Request $r)
    {
        //validates all required fields
        $validator = Validator::make($r->all(), [
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'comment' => 'required',
            'blog_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $blog = Blog::find($r->blog_id);
        if ($blog) {
            $comment = Comment::create($r->all());
            if ($comment) {
                return $this->sendResponse($comment, 'Comment has been added to blog');
            }
        } else {
            return $this->sendError('Blog with id: ' . $r->blog_id . ' does not exist');
        }

    }

    public function editComment(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'blog_id' => 'required|integer',
            'comment_id' => 'required|integer',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $comment = Comment::where('id', $r->comment_id);
        if ($comment->first()) {
            if (Blog::where('id', $r->blog_id)->first()) {
                DB::transaction(function () use ($comment, $r) {
                    $comment->update([
                        'title' => $r->title ? $r->title : $comment->first()->title,
                        'name' => $r->name ? $r->name : $comment->first()->name,
                        'email' => $r->email ? $r->email : $comment->first()->email,
                        'comment' => $r->comment ? $r->comment : $comment->first()->comment,
                        'blog_id' => $r->blog_id ? $r->blog_id : $comment->first()->blog_id,
                    ]);
                });
                return $this->sendResponse($comment->first(), 'Comment has been edited successfullty');

            } else {
                return $this->sendError('Blog with id: ' . $r->blog_id . ' does not exist');

            }

        } else {
            return $this->sendError('Comment with id: ' . $r->comment_id . ' does not exist');

        }

    }

    public function deleteComment(Request $r, $comment_id)
    {
        $comment = Comment::where('id', $comment_id);
        if ($comment->first()) {
            DB::transaction(function () use ($comment, $r) {
                $comment->delete();
            });
            return $this->sendResponse('', 'Comment has been successfully deleted');

        } else {
            return $this->sendError('Comment with id: ' . $comment_id . ' does not exist');

        }

    }

}
