<?php

namespace App\Enums;

enum RelationEnum: string
{
    case ALL = 'all';

    case CHILDREN = 'children';

    case PARENT = 'parent';
}
