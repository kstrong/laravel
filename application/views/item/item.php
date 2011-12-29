<h2><?php echo $item->title; ?></h2>
<i>created by: <?php echo $item->user->username; ?></i>
<?php if (Auth::user() == $item->user): ?>
<a class="edit" href="<?php echo URL::to('items/'.$item->id.'/edit'); ?>">edit</a>
<a class="edit" href="javascript:void(0);" onclick="$('#deleteform').submit()">delete</a>
<?php echo Form::open("items/{$item->id}", "DELETE", array("id" => "deleteform")); ?>
<?php echo Form::token(); ?>
<?php echo Form::close(); ?>
<?php endif; ?>
<p><?php echo nl2br($item->content); ?></p>
