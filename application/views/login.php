<?php if (Auth::check()) { ?>

<p>You are logged in</p>

<?php } else { 
echo Form::open('login'); ?>

username: <input type="text" name="username" />
password: <input type="password" name="password" />
<input type="submit" value="Login" />
<?php echo HTML::link('register', 'Register'); ?>
<?php echo Form::close(); } ?>
