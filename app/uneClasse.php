<?php

namespace App;

class leplusprochede {

    public $values;

    public function __construct(array $values)
    {
        $this->values           = $values;
    }

    /**
     * Vérifie qu'il n'y que des chiffres dans le tableau d'entrée
     * Transforme les chiffres qui sont des chaînes de caractères, en int
     * Supprime les string, tableaux, etc...
     *
     * @return array
     */
    public function check_value(): array {
        var_dump($this);

        if ($this->count() !== 0) {
            $tmp = [];

            foreach ($this->values as $key => $value) {
                if(is_numeric($value)) {
                    $tmp[] = (int)$value;
                }
            }
            unset($this->values);
            $this->values = array_merge($tmp);

            return $this;
        } else {
            return [$this->count()];
        }
    }

    /**
     * Supprimer les doublons de chaques chiffres
     * Réindexe les $key du tableau
     *
     * @return array
     */
    public function unique(): array {
        $this->values = array_merge(array_unique($this->values));

        return $this->values;
    }

    public function abs_value(array $values): array {
        $abs = [];
        foreach ($values as $value) {
            $abs[] = abs($value);
        }

        return $abs;
    }

    /**
     * Compter le nombre de valeurs
     * Vérifier que le nombre de valeurs est compris entre 0 et 10000
     *
     * @return int
     */
    private function count(): int {
        $count = count($this->values);

        if ($count === 0 || $count >= 10000)
            $count = 0;

        return $count;
    }
}