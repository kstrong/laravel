<?php if (Auth::check()) {
	echo HTML::link('items/new', 'Create Item');
	echo '<br/><br/>';
}

foreach ($items as $item){ 
	//echo HTML::link_to_item($item->title, array($item->id));
	echo HTML::link('items/'.$item->id, $item->title);
	echo "<hr/>";
}
