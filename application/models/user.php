<?php

class User extends Eloquent {
	public static $timestamps = true;
	
	public function validate_add($data) {
		$rules = array(
			'username' => 'alpha_dash|required|unique:users|max:60',
			'email' => 'email|unique:users|max:255',
			'password' => 'confirmed|required|min:6|max:60'
		);
		
		$validate = Validator::make($data, $rules);
		
		if (!$validate->valid()) {
			Session::flash('error', implode("<br/>\n", $validate->errors->all()));
			return false;
		}
		
		$this->username = $data['username'];
		$this->email = $data['email'];
		$this->password = Hash::make($data['password']);
		
		return $this->save();
	}
}
