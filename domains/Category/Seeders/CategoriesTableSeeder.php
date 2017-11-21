<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 23:32:54
 */

namespace Category\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Pizza',
            'Drink',
            'Portion'
        ];

        foreach ($categories as $category) {
            \Category\Models\Category::create([
                'name' => $category
            ]);
        }
    }
}
