<?php

return [

<<<<<<< HEAD
    /*
=======
    /**
>>>>>>> Cylunny/extension/polls-and-forms
     * To extend the base Comment model one just needs to create a new
     * CustomComment model extending the Comment model shipped with the
     * package and change this configuration option to their extended model.
     */
<<<<<<< HEAD
    'model'        => App\Models\Comment\Comment::class,

    /*
     * You can customize the behaviour of these permissions by
     * creating your own and pointing to it here.
     */
    'permissions'  => [
=======
    'model' => App\Models\Comment::class,

    /**
     * You can customize the behaviour of these permissions by
     * creating your own and pointing to it here.
     */
    'permissions' => [
>>>>>>> Cylunny/extension/polls-and-forms
        'create-comment'    => 'App\Policies\CommentPolicy@create',
        'delete-comment'    => 'App\Policies\CommentPolicy@delete',
        'edit-comment'      => 'App\Policies\CommentPolicy@update',
        'reply-to-comment'  => 'App\Policies\CommentPolicy@reply',
    ],

<<<<<<< HEAD
    /*
=======
    /**
>>>>>>> Cylunny/extension/polls-and-forms
     * The Comment Controller.
     * Change this to your own implementation of the CommentController.
     * You can use the \Laravelista\Comments\CommentControllerInterface.
     */
<<<<<<< HEAD
    'controller'   => 'App\Http\Controllers\Comments\CommentController',

    /*
=======
    'controller' => 'App\Http\Controllers\Comments\CommentController',
    
	/**
>>>>>>> Cylunny/extension/polls-and-forms
     * Set this option to `true` to enable soft deleting of comments.
     *
     * Comments will be soft deleted using laravels "softDeletes" trait.
     */
<<<<<<< HEAD
    'soft_deletes' => true,
=======
    'soft_deletes' => true
>>>>>>> Cylunny/extension/polls-and-forms

];
