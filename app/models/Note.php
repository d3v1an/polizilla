<?php

class Note extends \Eloquent {

	protected $table = 'noticiasDia';
	protected $primaryKey = 'idEditorial';

	protected $fillable = [];

	public function summary()
    {
        return $this->belongsToMany('Summary');
    }
}