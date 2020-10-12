<?php
namespace App\Imports;

use App\Vehicle;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class VehiclesImport extends ToModel
{
    use Importable;
    protected $guarded = [];
}
