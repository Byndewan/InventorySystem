<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ItemsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Find or create category
        $category = Category::firstOrCreate([
            'name' => $row['category']
        ]);

        return new Item([
            'name'       => $row['name'],
            'category_id' => $category->id,
            'quantity'   => $row['quantity'],
            'unit_price' => str_replace(['Rp ', ','], '', $row['unit_price']),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ];
    }
}
