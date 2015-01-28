<?php

class Board extends \Eloquent {
	protected $fillable = [];

	// Un tablero contiene solo una configuracion
    public function config()
    {
        return $this->hasOne("ConfigBoard","board_id");
    }

    // Un tablero puede contener multiples menus
    public function menus()
    {
        return $this->hasMany("Menu");
    }

    // Un tablero contiene un query principal
    public function queries()
    {
        return $this->hasOne("Query","board_id");
    }

    // Tags relacionados
    public function tags() {
        return $this->belongsToMany('Tag');
    }

    // Eliminamos los objetos relacionados
    public function delete() {

    	// Eliminamos el objeto de configuracion
        if($this->config){
            $this->config->delete();
        }

    	// Eliminamos los menus
        if(count($this->menus) > 0){
            foreach($this->menus as $menu)
            {
                $menu->delete();
            }
        }

        // Eliminamos los querys
        if(count($this->querys) > 0){
            foreach($this->querys as $query)
            {
                $query->delete();
            }
        }

        // Eliminamos los querys
        if(count($this->dialogs) > 0){
            foreach($this->dialogs as $dialog)
            {
                $dialog->delete();
            }
        }

        // Eliminamos los tags
        if(count($this->tags) > 0){
            foreach($this->tags as $query)
            {
                $query->delete();
            }
        }

        // Eliminamos el tablero
        return parent::delete();
    }
}