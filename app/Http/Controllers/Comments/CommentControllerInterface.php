<?php

namespace App\Http\Controllers\Comments;

<<<<<<< HEAD
use App\Models\Comment\Comment;
use Illuminate\Http\Request;

interface CommentControllerInterface {
=======
use Illuminate\Http\Request;
use App\Models\Comment;

interface CommentControllerInterface
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Creates a new comment for given model.
     */
    public function store(Request $request);

    /**
     * Updates the message of the comment.
     */
    public function update(Request $request, Comment $comment);

    /**
     * Deletes a comment.
     */
    public function destroy(Comment $comment);

    /**
     * Creates a reply "comment" to a comment.
     */
    public function reply(Request $request, Comment $comment);
<<<<<<< HEAD
}
=======
}
>>>>>>> Cylunny/extension/polls-and-forms
