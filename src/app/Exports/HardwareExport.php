<?php

namespace App\Exports;

use App\Models\Hardware;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HardwareExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection(): \Illuminate\Database\Eloquent\Collection|Collection|array
    {
        return Hardware::with('user')->get();
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->description,
            $row->type,
            $row->brand,
            $row->model,
            $row->serial_number,
            $row->tag,
            $row->user->name,
            $row->user->email,
            ($row->user->type === 'Storage' ? 'In Stock' : 'In Use'),
            $row->spec_os,
            $row->spec_cpu,
            $row->spec_memory,
            $row->spec_storage,
            $row->spec_screen_size,
            $row->spec_others,
            $row->bundle_with,
            $row->note,
            $row->user_id
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Type',
            'Brand',
            'Model',
            'Serial Number',
            'Tag',
            'User',
            'User Email',
            'Availability',
            'Operating System',
            'CPU',
            'Memory',
            'Storage',
            'Screen Size',
            'Others',
            'Bundle With',
            'Notes',
            'User ID'
        ];
    }
}
