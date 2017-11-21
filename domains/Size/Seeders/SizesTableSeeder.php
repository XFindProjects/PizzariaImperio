<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 0:2:47
 */

namespace Size\Seeders;

use Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzasCategory = Category::where('slug', 'pizza')->first();
        $drinksCategory = Category::where('slug', 'drink')->first();
        $portionsCategory = Category::where('slug', 'portion')->first();

        $pizzasSizes = [
            ['Pequena', 25.00],
            ['Média', 40.00],
            ['Grande', 50],
            ['Big', 55]
        ];
        $drinksSizes = [
            ['Copo', 4.00],
            ['Jarra', 8.00]
        ];
        $portionsSizes = [
            ['Pequena', 20.00],
            ['Grande', 40.00]
        ];

        $this->seed($pizzasCategory, $pizzasSizes);
        $this->seed($drinksCategory, $drinksSizes);
        $this->seed($portionsCategory, $portionsSizes);
    }

    /**
     * @param Model $category
     * @param array $sizes
     */
    private function seed(Model $category, array $sizes)
    {
        $sizes = collect($sizes)->map(function ($size) {
            return collect(['name', 'price'])->combine($size);
        })
            ->each(function ($size) use ($category) {
                $category->sizes()
                    ->create($size->toArray());
            });
    }
}
