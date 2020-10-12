<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Excel;
use App\Imports\VehiclesImport;

class VehicleController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function import()
    {
        return (new VehiclesImport)->import('vehicles.xlsx');
    }
}
