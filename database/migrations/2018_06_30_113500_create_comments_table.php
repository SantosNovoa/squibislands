<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('commenter_id')->nullable();
            $table->string('commenter_type')->nullable();
<<<<<<< HEAD
            $table->index(['commenter_id', 'commenter_type']);
=======
            $table->index(["commenter_id", "commenter_type"]);
>>>>>>> Cylunny/extension/polls-and-forms

            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();

<<<<<<< HEAD
            $table->string('commentable_type');
            $table->string('commentable_id');
            $table->index(['commentable_type', 'commentable_id']);
=======
            $table->string("commentable_type");
            $table->string("commentable_id");
            $table->index(["commentable_type", "commentable_id"]);
>>>>>>> Cylunny/extension/polls-and-forms

            $table->text('comment');

            $table->boolean('approved')->default(true);

            $table->unsignedBigInteger('child_id')->nullable();
            $table->foreign('child_id')->references('id')->on('comments')->onDelete('cascade');

<<<<<<< HEAD
            $table->softDeletes();
=======
			$table->softDeletes();
>>>>>>> Cylunny/extension/polls-and-forms
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
<<<<<<< HEAD
     */
    public function down() {
=======
     *
     * @return void
     */
    public function down()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::dropIfExists('comments');
    }
}
