<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use DB;

class ClientsImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
       foreach($rows as $key=>$row){
                DB::table('clients1')
                ->insert([
                    'email'=>$row['email'],
                    'reg_from'=>$row['reg_from']
                ]);
        }
    }
}
