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
            $row->id,
            $row->name,
            $row->email,
            $row->department,
            $row->job_title,
            $row->company,
            $row->location->name,
            $row->location->country,
            $row->desk,
            $row->type,
            ($row->state === 1 ? 'On Job' : 'Left'),
            (string)$row->permission_level,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Department',
            'Job Title',
            'Company',
            'Office',
            'Country',
            'Desk',
            'Type',
            'State',
            'Permission Level',
        ];
    }
}
