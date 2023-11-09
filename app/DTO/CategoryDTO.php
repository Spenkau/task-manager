<?php

namespace App\DTO;

use App\Enums;
use Illuminate\Http\Request;

class CategoryDTO
{
    public string $name;

    public function __construct($data)
    {
        $this->name = $data['name'];
    }
}
