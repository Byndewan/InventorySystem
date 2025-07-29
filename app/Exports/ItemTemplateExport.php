<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class ItemTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return ['Name', 'Category', 'Quantity', 'Unit Price'];
    }

    public function array(): array
    {
        return [['Laptop ASUS', 'Electronics', 15, 8500000], ['', '', '', '']];
    }
}
