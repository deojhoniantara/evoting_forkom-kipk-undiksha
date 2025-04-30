<?php

namespace App\Imports;

use App\Models\Voter;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class VoterImport implements ToModel
{
    public function model(array $row)
    {
        return new Voter([
            'name' => $row[0],
            'identifier' => $row[1],
            'voting_code' => strtoupper(Str::random(6)),
        ]);
    }
}
