<?php

class Query extends \Eloquent {
	protected $fillable = [];

	// Un query pertenece a un tablero
    public function board() 
    { 
        return $this->belongsTo('Board');
    }

    // Un query pertenece a un item de menu
    public function menuItem() 
    { 
        return $this->belongsTo('MenuItem');
    }
}