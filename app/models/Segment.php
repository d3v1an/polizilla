<?php

class Segment extends \Eloquent {
	protected $fillable = [];
	protected $table = 'summary_segments';

	public function summary()
    {
        return $this->hasMany('Summary');
    }
}