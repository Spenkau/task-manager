<?php

namespace App\Enums;

enum StatusEnum: int
{
    case PLANNED = 0;
    case ACTIVE = 1;
    case CANCELED = 2;
    case FINISHED = 3;
}
