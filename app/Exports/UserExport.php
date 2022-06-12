<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class UserExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    public function collection(){
        return User::all();
    }
    
    public function headings(): array{
        return ['Id', 'Nom utilisateur', 'Email', 'Date de création', 'Date de mise à jour'];
    }

    public function map($user): array{
        return [
            $user->id,
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->created_at),
            Date::dateTimeToExcel($user->updated_at),      
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
