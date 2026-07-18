<?php

namespace App;

enum WorkoutSessionStatus:string
{
    case Running = 'running';

    case Completed = 'completed';

    case Abandoned = 'abandoned';

    case Cancelled = 'cancelled';
}
