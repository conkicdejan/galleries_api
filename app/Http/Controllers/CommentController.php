<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $newComment = new Comment($validated);
        $newComment->user()->associate(Auth::user());
        $newComment->save();

        $newComment = $newComment->load('user');

        return response()->json($newComment);
    }

    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();
        return response($comment);
    }
}
