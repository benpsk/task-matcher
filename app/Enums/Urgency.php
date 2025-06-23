<?php

namespace App\Enums;

enum Urgency: string
{
    case high = 'High';
    case medium = 'Medium';
    case low = 'Low';
}
