<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'vision',
        'mission'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Add validation rules
    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'vision' => 'required|string',
            'mission' => 'required|string'
        ];
    }
}
