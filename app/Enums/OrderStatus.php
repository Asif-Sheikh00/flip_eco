<?php

namespace App\Enums;

enum OrderStatus : int
{
    case PENDING    = 1;
    case PROCESSING = 2;
    case CANCELLED  = 3;
    case DELIVERED  = 4;
    case COMPLETED  = 5;
    case ACCEPTED   = 6;
    case REJECTED   = 7;
}
