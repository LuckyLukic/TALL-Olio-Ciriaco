<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\User;
use Livewire\Component;

class CreateOrder extends Component
{
    public $items;
    public $user;

    public function mount(User $user)
    {
        $this->items = Item::all();
    }


    public function render()
    {
        return view('livewire.create-order');
    }
}
