<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;

class FileController extends Controller
{
    public function export() 
    {
        return Excel::download(new ClientsExport, 'clients.xlsx');
        echo "Done";
    }

    public function import(Request $request){
        Excel::import(new ClientsImport,$request->file('file'));
    }

}
