<?php

namespace App;

class uneClasse{

    public $content;

    // Son constructeur avec un contenu à passer en argument

    public function __construct($content){

        $this->content = $content;

    }

    // Méthode qui va faire une sorte de nettoyage du contenu

    public function nettoie(){

        $this->content = ucfirst(trim(strip_tags($this->content)));

        return $this;

    }

    // Méthode qui va découper le contenu (50 carac.) pour une présentation par exemple
    public function coupe(){

        $this->content = substr($this->content, 0, 50).'...';

        return $this;

    }

    // Méthode qui va faire une sorte de petite mise en page du contenu
    public function prepare(){

        // Bien sûr, il faut utiliser le css plutôt que faire ainsi, mais on est dans la démo là 🙂
        $this->content = '<p style="border: 1px #000 solid; padding: 5px;">'.$this->content.'</p>';

        return $this;

    }

    // Méthode qui va renvoyer le contenu sous sa forme actuelle (avec un titre h1 ou non)
    public function affiche($titre = ''){

        // si titre ou non
        if(isset($titre) AND $titre != '')
            return '<h1>'.$titre.'</h1>'.$this->content;
        else
            return $this->content;

    }

}