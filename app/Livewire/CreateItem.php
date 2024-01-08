<?php

namespace App\Livewire;

use App\Models\Item;
use App\Enums\Liters;
use App\Enums\ItemType;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateItem extends Component
{

    use WithFileUploads;

    public $categories;
    public $liters;

    public $name;
    public $category;
    public $size;
    public $image;
    public $price = 0;
    public $description;
    public $quantity = 0;

    public function mount()
    {
        $this->categories = ItemType::values();
        $this->liters = Liters::values();
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'required',
        'size' => 'required',
        'image' => 'required|image|max:2048',
        'price' => 'required|numeric|between:0,9999999.99|min:0.1',
        'description' => 'required|string|min:20',
        'quantity' => 'required|numeric|between:0,9999|min:1'
    ];

    public function createItem()
    {
        $this->validate();

        $imageName = $this->image->store('images', 'public');

        $newItem = Item::create([
            'name' => $this->name,
            'item_type' => $this->category,
            'liters' => $this->size,
            'image' => $imageName,
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity

        ]);

        dd($newItem);
    }

    public function render()
    {
        return view('livewire.create-item');
    }
}
