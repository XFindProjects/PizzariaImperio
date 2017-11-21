<?php

namespace Pizza\Faker;

use Faker\Provider\Base;

class SlavorProvider extends Base
{
    private $slavors = [
        "Pádova Novo Mundo",
        "Pádova Bacacheri",
        "Pizza pequena",
        "Pizza grande",
        "Pizza big",
        "Pizza gigante",
        "Alho e Óleo",
        "Alicci",
        "Americana",
        "Atum",
        "Bacon",
        "Baiana",
        "Bolonhesa",
        "Brasileira",
        "Brócolis",
        "Calabresa",
        "Calabresa com Catupiry",
        "Calabresa com Cheddar",
        "Calabresa Mineira",
        "Camponesa",
        "Catupiry",
        "Champignon",
        "Crocante",
        "Escarola",
        "Frango",
        "Frango Caipira",
        "Frango com Catupiry",
        "Frango com Cheddar",
        "Gorgonzola",
        "Grega",
        "Havaiana",
        "Humita",
        "Lombo",
        "Lombo Califórnia",
        "Lombo Canadense",
        "Lombo com Catupiry",
        "Lombo com Champignon",
        "Lombo com Cheddar",
        "Lombo Especial",
        "Madalena",
        "Maguerita",
        "Maiale",
        "Marinara",
        "Mexicana",
        "Milho Verde",
        "Mussarela",
        "Napolitana",
        "Palmito",
        "Palmito Especial",
        "Parmegiana",
        "Paulista",
        "Peruana",
        "Portuguesa",
        "Provolone",
        "Q'Delícia",
        "Quatro Queijos",
        "Romana",
        "Siciliana",
        "Texana",
        "Vegetariana",
    ];

    public function slavor()
    {
        $generator = $this->generator;

        return $generator->randomElement($this->slavors);
    }
}