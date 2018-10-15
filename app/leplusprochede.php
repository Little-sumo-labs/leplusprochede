<?php
namespace App;

/**
 * Permet de déterminer, dans un tableau, la valeur la plus proche de 0
 *
 * Class lePlusProcheDe
 * @author Guillaume RICHARD <g.jf.richard@gmail.com>
 * @package App
 */
class lePlusProcheDe {
    /**
     * @var array $values
     */
    public $values = [];
    /**
     * @var int $max_number_value
     */
    public $max_number_value;

    /**
     * lePlusProcheDe constructor.
     *
     * @param array $values
     * @param int $max_number_value
     */
    public function __construct(array $values, int $max_number_value = 10000)
    {
        $this->values           = $values;
        $this->max_number_value = $max_number_value;
    }

    /**
     * Vérifie les informations du tableau d'entrée
     * Les chiffres qui sont des chaînes de caractères, sont transformé en int
     * les string, tableaux, booléens (etc...), sont supprimé
     *
     * @return lePlusProcheDe
     * @throws \Exception
     */
    public function check_value(): lePlusProcheDe {
        $tmp = [];

        $this->is_array_empty($this->values);
        $this->is_array_max($this->values);

        foreach ($this->values as $key => $value) {
            try{
                if(is_numeric($value)) {
                    $tmp[] = (int)$value;
                } else {
                    $keyTab = $key+1;
                    throw new \Exception("La valeur n°$keyTab du tableau n'est pas un nombre");
                }
            } catch(Exception $e){
                print_r($e);
            }
        }
        unset($this->values);
        $this->values = array_merge($tmp);

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
     * Vérifie si le tableau proposé en paramètres dans la classe est vide (ou non)
     *
     * @throws \Exception
     */
    private function is_array_empty() {
        try{
            if(empty($this->values) ){
                throw new \Exception("Le tableau est vide");
            }
        } catch(Exception $e){
            print_r($e);
        }
    }

    /**
     * Vérifi si le tableau est plus grand qu'un certain nombre de caractères
     * @throws \Exception
     */
    private function is_array_max() {
        try{
            if( count($this->values) > $this->max_number_value ){
                throw new \Exception("Le tableau est trop grand");
            }
        } catch(Exception $e){
            print_r($e);
        }
    }
}