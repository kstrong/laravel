<h2>Edit Item</h2>
<?php 
echo Form::open('items/'.$item->id, 'PUT'); 

echo Form::label('title', 'Title: '); echo Form::text('title', $item->title);
echo Form::label('content', 'Content: '); echo Form::textarea('content', $item->content);
echo Form::hidden('id', $item->id);
echo Form::submit('Save Item');
echo Form::token();

echo Form::close(); 