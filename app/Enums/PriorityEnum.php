<?php

namespace App\Enums;
enum PriorityEnum: int
{
    case IN_PROCESS = 1;
    case LOW = 2;
    case MEDIUM = 3;
    case HIGH = 4;
}
