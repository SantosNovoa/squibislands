<?php

namespace App\Traits;

<<<<<<< HEAD
=======
use App\Models\Comment;

use Illuminate\Support\Facades\Config;

>>>>>>> Cylunny/extension/polls-and-forms
/**
 * Add this trait to your User model so
 * that you can retrieve the comments for a user.
 */
<<<<<<< HEAD
trait Commenter {
    /**
     * Returns all comments that this user has made.
     */
    public function comments() {
        return $this->morphMany('App\Models\Comment\Comment', 'commenter');
=======
trait Commenter
{
    /**
     * Returns all comments that this user has made.
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commenter');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Returns only approved comments that this user has made.
     */
<<<<<<< HEAD
    public function approvedComments() {
        return $this->morphMany('App\Models\Comment\Comment', 'commenter')->where('approved', true);
=======
    public function approvedComments()
    {
        return $this->morphMany('App\Models\Comment', 'commenter')->where('approved', true);
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
