<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UsersImport implements ToModel, WithUpserts, WithUpsertColumns, WithHeadingRow
{
    public function uniqueBy(): string
    {
        return 'email';
    }

    public function model(array $row): User
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'type' => $row['type'],
            'company' => $row['company'],
            'department' => $row['department'],
            'desk' => $row['desk'],
            'location_id' => $row['location_id'],
            'job_title' => $row['job_title'],
            'state' => $row['state'] === 'On Job' ? 1 : 0,
        ]);
    }

    public function upsertColumns(): array
    {
        return [
            'name',
            'type',
            'company',
            'department',
            'job_title',
            'location_id',
            'desk',
            'state',
        ];
    }
}
