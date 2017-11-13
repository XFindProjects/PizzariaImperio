<?php

namespace App\Traits;

trait CreateSlug
{
    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }


    public function incrementSlug($slug)
    {
        $searchAttribute = $this->getSlugSearch() ?? 'name';

        $max = static::where($searchAttribute, $this->$searchAttribute)->latest('id')->value('slug');

        if (is_numeric($max[-1])) {
            return preg_replace_callback('/(\d+)$/', function($match) {
                return $match[1] + 1;
            }, $max);
        }

        return "{$slug}-2";
    }
}