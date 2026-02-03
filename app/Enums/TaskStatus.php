<?php

namespace App\Enums;

enum TaskStatus: String
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}
