<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrdersExportController extends Controller
{
    public function export() 
    {
        return Excel::download(new OrdersExport, 'pedidos.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
      ] );
    }
}
