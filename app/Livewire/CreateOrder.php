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



    public function mount(User $user)
    {
        $this->items = Item::all();
    }

    public function updatedSelectedItemId($itemId)
    {
        $item = $this->items->find($itemId);
        $this->price = $item ? $item->price : 0;

    }


    public function render()
    {
        return view('livewire.create-order');
    }
}
