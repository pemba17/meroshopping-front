<?php
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return User::select('email','reg_from')
                    ->where('reg_from','facebook')
                    ->get();
    }

    public function headings() :array{
        return[
            'email',
            'reg_from'
        ];
    }
}
