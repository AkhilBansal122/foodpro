<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockHistoryExport implements FromCollection,WithHeadings
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
            'Sr No',
            'Product Name',
            'Purchase',
            'Sell',
            'Purchase Price',
            'Option',
            "Purchase date"
        ];
    }
}
