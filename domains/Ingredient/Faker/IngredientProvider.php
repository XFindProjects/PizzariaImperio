<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 23:10:13
 */

namespace Ingredient\Faker;

use Faker\Provider\Base;

class IngredientProvider extends Base
{
    private $ingredients = [
        "Molho",
        "mussarela",
        "alho e óleo",
        "orégano.",
        "alicci e orégano.",
        "molho",
        "bacon",
        "milho",
        "ovos e orégano",
        "atum e orégano.",
        "bacon e orégano.",
        "calabresa",
        "pimenta e orégano.",
        "carne moída e orégano.",
        "ervilha e orégano.",
        "brócolis",
        "catupiry e orégano.",
        "calabresa e orégano.",
        "cheddar e orégano",
        "frango",
        "tomate picado",
        "gorgonzola e manjericão",
        "champignon e orégano.",
        "presunto",
        "batata palha e orégano.",
        "escarola",
        "alho",
        "frango e orégano.",
        "catupiry",
        "milho e orégano",
        "cheddar e orégano.",
        "tomate",
        "gorgonzola e orégano.",
        "lombo",
        "cebola",
        "palmito e orégano.",
        "lombo e abacaxi",
        "milho e orégano.",
        "lombo e orégano.",
        "califórnia(frutas) e orégano.",
        "alicci (peixe em conserva)",
        "parmesão e orégano.",
        "champignon",
        "Massa",
        "molho",
        "carne a bolonhesa",
        "purê de batatas",
        "parmesão e oregano",
        "tomate e manjericão.",
        "catupiry e orégano",
        "atum",
        "provolone e orégano",
        "milho verde e orégano.",
        "mussarela e orégano.",
        "palmito",
        "Mussarela",
        "molho ao sugo",
        "ovos",
        "azeitona e orégano.",
        "provolone e orégano.",
        "bolonhesa",
        "provolone",
        "parmesão",
        "presunto e orégano.",
        "pimentão",
        "barbecue e orégano"
    ];

    public function ingredient()
    {
        $generator = $this->generator;

        return $generator->randomElement($this->ingredients);
    }
}