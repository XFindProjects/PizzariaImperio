<?php

namespace App\Contracts;

interface Slugable
{
    /**
     *  Slug attribute for querying
     */
    public function getSlugSearch();

    /**
     *  Slug Mutator
     */
    public function setSlugAttribute($value);

    /**
     *  Slug incrementer
     */
    public function incrementSlug($slug);
}