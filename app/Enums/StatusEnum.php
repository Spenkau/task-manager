<?php

namespace App\Enums;

enum StatusEnum: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
    case PENDING = 2;
    case PERFORMED = 3;
}
