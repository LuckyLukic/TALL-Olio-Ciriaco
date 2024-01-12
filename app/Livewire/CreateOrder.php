<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\User;
use Livewire\Component;

class CreateOrder extends Component
{
    public $items;
    public $user;

    public $selectedItemId;
    public $price = 0;

    public $quantity = 0;

    public $total = 0;

    public $orderItems = [null];

    public function updatedQuantity($value)
    {
        $this->total = $this->price > 0 ? $value * $this->price : 0;
    }


    public function mount(User $user)
    {
        $this->items = Item::all();
    }

    public function updatedSelectedItemId($itemId)
    {
        $item = $this->items->find($itemId);
        $this->price = $item ? $item->price : 0;
        $this->total = $this->price > 0 ? $this->quantity * $this->price : 0;
    }

    protected $rules = [
        'selectedItemId' => 'required',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
    ];

    public function addOrderItem()
    {
        $this->validate();

        $this->orderItems[] = [
            'item_id' => $this->selectedItemId,
            'quantity' => $this->quantity,

        ];
        $this->orderItems[] = null;
    }

    //     $this->reset(['selectedItemId', 'quantity', 'price']);
    // }

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
