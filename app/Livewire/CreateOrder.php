<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\User;
use Livewire\Component;

class CreateOrder extends Component
{
    public $items;
    public $user;

    public $orderItems = [[]];

    public function updated($propertyName)
    {
        if (preg_match('/orderItems\.(\d+)\.(item_id|quantity)/', $propertyName, $matches)) {
            $index = $matches[1];
            $this->updateOrderItem($index);
        }
    }

    private function updateOrderItem($index)
    {

        logger("Updating order item at index: $index");

        $item = $this->orderItems[$index] ?? null;
        if ($item && isset($item['item_id'])) {
            $selectedItem = $this->items->find($item['item_id']);
            if ($selectedItem) {
                $this->orderItems[$index]['price'] = $selectedItem->price;
                $quantity = $this->orderItems[$index]['quantity'] ?? 0;
                $this->orderItems[$index]['total'] = $selectedItem->price * $quantity;
            }
        }
    }


    public function mount(User $user)
    {
        $this->items = Item::all();
    }

    protected $rules = [
        'orderItems.*.item_id' => 'required|exists:items,id',
        'orderItems.*.quantity' => 'required|numeric|min:1',
        'orderItems.*.price' => 'required|numeric|min:0.1',
        'orderItems.*.total' => 'required|numeric|min:0.1'
    ];

    public function addOrderItem()
    {
        $this->validate();


        $this->orderItems[] = [];
    }


    public function clearRow()
    {
        $this->reset(['selectedItemId', 'quantity', 'price']);
    }

    public function removeOrderItem($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems); // Reindex array
    }


    public function render()
    {
        return view('livewire.create-order');
    }
}
