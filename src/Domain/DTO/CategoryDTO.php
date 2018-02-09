<?php

namespace App\Domain\DTO;

class CategoryDTO
{
    public $level;
    public $title;
    public $parent;
    public $children = [];
}