<?php

class ConfigBoard extends \Eloquent {
	protected $fillable = [];

	// Un dialogo pertenece a un tablero
	public function board() 
    { 
        return $this->belongsTo('Board');
    }
}