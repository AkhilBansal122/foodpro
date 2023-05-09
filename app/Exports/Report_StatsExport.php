<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Report_StatsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $allData;

    public function __construct($data=null) 
    {
        $this->allData = $data;
    }

   
    public function collection()
    {
        return collect($this->allData);
    }

    public function headings() :array
    {
        return [
            'Transaction Id',
            'Order Id',
            'Product Category',
            'Product Sub-Category',
            'Date of the Transaction',
            'Customer Name',
            "Mobile No.",
            "Jewellery style",
            "Polish Type"
        ];
    }

}
