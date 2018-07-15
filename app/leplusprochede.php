<?php

namespace App;

class lePlusProcheDe {

    public $values = [];
    public $max_number_value;

    public function __construct(array $values, int $max_number_value = 10000)
    {
        $this->values           = $values;
        $this->max_number_value = $max_number_value;
    }

    /**
     * Vérifie qu'il n'y que des chiffres dans le tableau d'entrée
     * Transforme les chiffres qui sont des chaînes de caractères, en int
     * Supprime les string, tableaux, etc...
     *
     * @return lePlusProcheDe
     */
    public function check_value(): lePlusProcheDe {

        if ($this->count() !== 0) {
            $tmp = [];

            foreach ($this->values as $key => $value) {
                if(is_numeric($value)) {
                    $tmp[] = (int)$value;
                }
            }
            unset($this->values);
            $this->values = array_merge($tmp);
        } else {
            $this->values = [0];
        }
        return $this;
    }

    /**
     * Supprimer les doublons de chaques chiffres
     * Réindexe les $key du tableau
     *
     * @return lePlusProcheDe
     */
    public function unique(): lePlusProcheDe {
        $this->values = array_merge(array_unique($this->values));

        return $this;
    }

    /**
     * Créer un tableau associant l’écart de la valeur par rapport à 0 et sa valeur absolue
     *
     * @return lePlusProcheDe
     */
    public function absolue(): lePlusProcheDe {
        $abs = [];
        foreach ($this->values as $key => $value) {
            $abs[] = abs($value);
        }
        $this->absolue = $abs;

        return $this;
    }

    /**
     * Recréé un tableau pour trouver la plus proche de 0 en bouclant
     * Si l’écart (par rapport à 0) est plus petit que le précédent, on l’écrase.
     *
     * @return lePlusProcheDe
     */
    public function diff(): lePlusProcheDe {
        $tab_final = [];

        foreach($this->absolue as $key => $ecart) {
            $count = count($tab_final); // on vérifie si le tableau est vide

            if($count == 0) { // s'il est vide, on injecte la 1ere valeur qui passe
                $tab_final[0] = $ecart;
            }

            // si le dernier element du tab_final est supérieur a l'ecart, on crash le tab final et on injecte la nouvelle valeur
            if($tab_final[0] > $ecart) {
                $tab_final = [];
                $tab_final[] = $ecart;
            }
        }

        $this->tab_final = $tab_final;

        return $this;
    }

    /**
     * On vérifie l’écart si il est positif, ou négatif.
     * On doit vérifier si une clé positive existe, sinon on prend la négative
     *
     * @return lePlusProcheDe
     */
    public function pos_or_neg(): lePlusProcheDe {
        $ecartok = $this->tab_final[0]; // on recupere notre dernier ecart dans $ecartok

        $this->ecart = (in_array($this->tab_final[0], $this->values))? $ecartok: -$ecartok;

        return $this;
    }

    /**
     * Compter le nombre de valeurs
     * Vérifier que le nombre de valeurs est compris entre 0 et $max_number_value
     *
     * @return int
     */
    private function count(): int {
        $count = count($this->values);

        if ($count === 0 || $count >= $this->max_number_value)
            $count = 0;

        return $count;
    }
}