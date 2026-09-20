<?php

namespace App\Events;

<<<<<<< HEAD
use App\Models\Comment\Comment;
use Illuminate\Queue\SerializesModels;

class CommentUpdated {
=======
use Illuminate\Queue\SerializesModels;
use App\Models\Comment;

class CommentUpdated
{
>>>>>>> Cylunny/extension/polls-and-forms
    use SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
<<<<<<< HEAD
     */
    public function __construct(Comment $comment) {
=======
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $this->comment = $comment;
    }
}
