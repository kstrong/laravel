<h2>New Item</h2>
<?php 
echo Form::open('items'); 

echo Form::label('title', 'Title: '); echo Form::text('title', Input::old('title'));
echo Form::label('content', 'Content: '); echo Form::textarea('content', Input::old('content'));
echo Form::submit('Save Item');
echo Form::token();

echo Form::close(); 