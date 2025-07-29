<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Item::with('category')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Category', 'Quantity', 'Unit Price'];
    }

    public function map($item): array
    {
        return [$item->id, $item->name, $item->category->name, $item->quantity, 'Rp ' . number_format($item->unit_price, 2)];
    }
}
