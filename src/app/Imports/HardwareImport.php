<?php

namespace App\Imports;

use App\Models\Hardware;
use JsonException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;

class HardwareImport implements ToModel, WithUpserts, WithUpsertColumns, WithHeadingRow
{
    public function uniqueBy(): string
    {
        return 'serial_number';
    }

    /**
     * @throws JsonException
     */
    public function model(array $row): Hardware
    {
        return new Hardware([
            'user_id' => $row['user_id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'type' => $row['type'],
            'brand' => $row['brand'],
            'model' => $row['model'],
            'serial_number' => $row['serial_number'],
            'tag' => $row['tag'],
            'spec_os' => $row['operating_system'],
            'spec_cpu' => $row['cpu'],
            'spec_memory' => $row['memory'],
            'spec_storage' => $row['storage'],
            'spec_screen_size' => $row['screen_size'],
            'spec_others' => $row['others'],
            'bundle_with' => json_decode($row['bundle_with'], false, 512, JSON_THROW_ON_ERROR),
            'note' => $row['note'],
        ]);
    }

    public function upsertColumns(): array
    {
        return [
            'user_id',
            'name',
            'description',
            'type',
            'brand',
            'model',
            'tag',
            'spec_os',
            'spec_cpu',
            'spec_memory',
            'spec_storage',
            'spec_screen_size',
            'spec_others',
            'bundle_with',
            'note',
        ];
    }
}
