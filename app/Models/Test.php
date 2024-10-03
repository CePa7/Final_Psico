<?php

// app/Models/Test.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'age',
        'previous_treatment',
        'stress_level',
        'stress_factors',
        'symptom_intensity',
        'symptom_frequency',
        'support_network',
        'traumatic_events',
        'self_harm',
        'suicidal_thoughts',
        'medications',
        'relaxation_methods',
    ];
}

