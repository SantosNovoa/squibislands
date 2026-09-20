<<<<<<< HEAD
@if ($category)
    {!! Form::open(['url' => 'admin/data/item-categories/delete/' . $category->id]) !!}
=======
@if($category)
    {!! Form::open(['url' => 'admin/data/item-categories/delete/'.$category->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the category <strong>{{ $category->name }}</strong>. This is not reversible. If items in this category exist, you will not be able to delete this category.</p>
    <p>Are you sure you want to delete <strong>{{ $category->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Category', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid category selected.
@endif
=======
@else 
    Invalid category selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
