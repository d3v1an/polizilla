<?php

class Summary extends \Eloquent {
	protected $fillable = [];

	// Notas relacionadas con un resumen
	public function notes()
    {
        return $this->belongsToMany('Note');
    }
}