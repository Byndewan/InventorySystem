<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalCategories = Category::count();
        $lowStockItems = Item::where('quantity', '<', 10)->count();
        $outOfStockItems = Item::where('quantity', 0)->count();

        $inventoryValue = Item::get()->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        $recentActivities = ItemHistory::with(['item', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($activity) {
                return [
                    'icon' => $this->getActivityIcon($activity->action),
                    'description' => $this->getActivityDescription($activity),
                    'time' => $activity->created_at->diffForHumans(),
                    'user' => $activity->user->name,
                ];
            });

        return view('index', compact('totalItems', 'totalCategories', 'lowStockItems', 'outOfStockItems', 'inventoryValue', 'recentActivities'));
    }

    private function getActivityIcon($action)
    {
        return match ($action) {
            'created' => 'plus-circle',
            'updated' => 'pencil-alt',
            'deleted' => 'trash-alt',
            default => 'info-circle',
        };
    }

    private function getActivityDescription($activity)
    {
        $itemName = $activity->item->name ?? ($activity->item_name ?? 'Unknown Item');

        switch ($activity->action) {
            case 'created':
                return "Menambahkan barang baru: {$itemName}";
            case 'updated':
                return "Mengubah {$activity->field} untuk {$itemName} Dari " . $this->formatValue($activity->old_value) . ' Menjadi ' . $this->formatValue($activity->new_value);
            case 'deleted':
                return "Menghapus barang: {$itemName}";
            default:
                return "Melakukan aksi pada {$itemName}";
        }
    }

    private function formatValue($value)
    {
        if (is_numeric($value)) {
            return number_format($value, 2);
        }
        return $value ?? 'N/A';
    }
}
