<?php

namespace App\Http\Controllers\Item;

use App\Exports\ItemsExport;
use App\Exports\ItemTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\ItemsImport;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $totalItems = Item::count();
        $inStockItems = Item::where('quantity', '>=', 10)->count();
        $lowStockItems = Item::whereBetween('quantity', [1, 9])->count();
        $outOfStockItems = Item::where('quantity', 0)->count();

        $items = Item::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%$search%")->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        })
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('items.index', compact('items', 'search', 'totalItems', 'inStockItems', 'lowStockItems', 'outOfStockItems'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new ItemsExport(), 'items.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            Excel::import(new ItemsImport(), $request->file('file'));
            return back()->with('success', 'Barang berhasil diimpor.');
        } catch (\Exception $e) {
            return back()->with('error', 'Impor Gagal: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new ItemTemplateExport(), 'items_import_template.xlsx');
    }
}
