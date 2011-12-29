<?php if (Auth::check()) { ?>

<p>You are logged in</p>

<?php } else { 
echo Form::open('register', 'post', array('class' => 'registerForm')); ?>

<label>username:</label> <input type="text" name="username" />
<label>email:</label> <input type="text" name="email" />
<label>password:</label> <input type="password" name="password" /> 
<label>confirm password:</label> <input type="password" name="password_confirmation" />
<input type="submit" value="Register" />

<?php echo Form::close(); 
} ?>
