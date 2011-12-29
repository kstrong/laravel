<?php

class Item extends Eloquent {
	public static $timestamps = true;

	public function user() {
		return $this->belongs_to('User');
	}

	public function validate($data) {
		$rules = array('title' => 'required|max:255');

		$validate = Validator::make($data, $rules);

		if (!$validate->valid()) {
			Session::flash('error', implode("<br/>\n", $validate->errors->all()));
			return false;
		}

		return true;
	}
}
