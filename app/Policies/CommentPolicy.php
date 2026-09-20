<?php

namespace App\Policies;

<<<<<<< HEAD
use App\Models\Comment\Comment;
use Illuminate\Support\Facades\Auth;

class CommentPolicy {
    /**
     * Can user create the comment.
     *
     * @param mixed $user
     */
    public function create($user): bool {
=======
use Auth;
use App\Models\Comment;

class CommentPolicy
{
    /**
     * Can user create the comment
     *
     * @param $user
     * @return bool
     */
    public function create($user) : bool
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return true;
    }

    /**
<<<<<<< HEAD
     * Can user delete the comment.
     *
     * @param mixed $user
     */
    public function delete($user, Comment $comment): bool {
        if (Auth::user()->isStaff) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Can user update the comment.
     *
     * @param mixed $user
     */
    public function update($user, Comment $comment): bool {
=======
     * Can user delete the comment
     *
     * @param $user
     * @param Comment $comment
     * @return bool
     */
    public function delete($user, Comment $comment) : bool
    {
            if(Auth::user()->isStaff) {
                return true;
            }
            else {
                return false;
            }
    }

    /**
     * Can user update the comment
     *
     * @param $user
     * @param Comment $comment
     * @return bool
     */
    public function update($user, Comment $comment) : bool
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $user->getKey() == $comment->commenter_id;
    }

    /**
<<<<<<< HEAD
     * Can user reply to the comment.
     *
     * @param mixed $user
     */
    public function reply($user, Comment $comment): bool {
        return $user->getKey();
    }
}
=======
     * Can user reply to the comment
     *
     * @param $user
     * @param Comment $comment
     * @return bool
     */
    public function reply($user, Comment $comment) : bool
    {
        return $user->getKey();
    }
}

>>>>>>> Cylunny/extension/polls-and-forms
