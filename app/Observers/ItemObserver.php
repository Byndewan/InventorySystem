<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Log;

class ItemObserver
{
    /**
     * Handle the Item "created" event.
     */
    public function created(Item $item)
    {
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'created',
            'model' => 'Item',
            'model_id' => $item->id,
            'data' => json_encode($item->toArray()),
        ]);
    }

    public function updated(Item $item)
    {
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'model' => 'Item',
            'model_id' => $item->id,
            'data' => json_encode($item->toArray()),
        ]);
    }

    public function deleted(Item $item): void
    {
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'model' => 'Item',
            'model_id' => $item->id,
            'data' => json_encode($item->toArray()),
        ]);
    }

    /**
     * Handle the Item "restored" event.
     */
    public function restored(Item $item): void
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     */
    public function forceDeleted(Item $item): void
    {
        //
    }
}
