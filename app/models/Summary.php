<?php

class Summary extends \Eloquent {
	protected $fillable = [];

	// Notas relacionadas con un resumen
	public function notes()
    {
        return $this->belongsToMany('Note');
    }

    public function segment()
    {
    	return $this->belongsTo('Segment','summary_segment_id');
    }
}