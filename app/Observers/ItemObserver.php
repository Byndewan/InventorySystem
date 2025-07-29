<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\ItemHistory;
use Illuminate\Support\Facades\Auth;

class ItemObserver
{
    public function created(Item $item)
    {
        ItemHistory::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'action' => 'created',
            'field' => null,
            'old_value' => null,
            'new_value' => json_encode($item->toArray()),
        ]);
    }

    public function updated(Item $item)
    {
        $changes = $item->getChanges();
        $original = $item->getOriginal();

        foreach ($changes as $field => $newValue) {
            if (in_array($field, ['created_at', 'updated_at'])) {
                continue;
            }

            ItemHistory::create([
                'item_id' => $item->id,
                'user_id' => Auth::id(),
                'action' => 'updated',
                'field' => $field,
                'old_value' => $original[$field] ?? null,
                'new_value' => $newValue,
            ]);
        }
    }

    public function deleted(Item $item)
    {
        ItemHistory::create([
            'item_id' => $item->id,
            'item_name' => $item->name,
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'field' => null,
            'old_value' => json_encode($item->toArray()),
            'new_value' => null,
        ]);
    }
}
