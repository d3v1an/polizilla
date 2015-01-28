<?php

class MenuItem extends \Eloquent {
	protected $fillable = [];

	// Un menu item pertenece a un menu padre
    public function menu() { 
        return $this->belongsTo('Menu'); 
    }

    // Tags relacionados
    public function tags() {
        return $this->belongsToMany('Tag');
    }

    // Eliminamos los objetos relacionados
    public function delete() {

        // Eliminamos los tags
        $this->tags()->detach();

        // Eliminamos el tablero
        return parent::delete();
    }
}