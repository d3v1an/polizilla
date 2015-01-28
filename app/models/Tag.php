<?php

class Tag extends \Eloquent {
	protected $fillable = [];
	public $timestamps = false;

	public function board() {
		return $this->belongsToMany('Board');
	}

	public function menuItem() {
		return $this->belongsToMany('MenuItem','menu_item_id');
	}
}