<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection(): Collection
    {
        return User::with('location')->get();
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->email,
            $row->type,
            $row->company,
            $row->location->country,
            $row->department,
            $row->job_title,
            $row->location->name,
            $row->desk,
            $row->location_id,
            ($row->state === 1 ? 'On Job' : 'Left'),
            (string)$row->permission_level,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Type',
            'Company',
            'Country',
            'Department',
            'Job Title',
            'Office',
            'Desk',
            'Location ID',
            'State',
            'Permission Level'
        ];
    }
}
