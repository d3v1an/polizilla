<?php

class Menu extends \Eloquent {
	protected $fillable = [];

	// Un menu pertenece a un tablero
    public function board() 
    { 
        return $this->belongsTo('Board'); 
    }

    // Un menu puede contener multiples menu items
    public function items()
    {
        return $this->hasMany("MenuItem");
    }

    public function delete() {

    	// Eliminamos los menu items relacionados
        if(count($this->items) > 0){
            foreach($this->items as $item)
            {
                $item->delete();
            }
        }

    }
}