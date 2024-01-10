<?php

namespace App\Livewire;

use App\Models\Item;
use App\Enums\Liters;
use App\Models\Image;
use App\Enums\ItemType;
use Livewire\Component;
use Illuminate\Http\UploadedFile;
use Livewire\WithFileUploads;



class CreateItem extends Component
{

    use WithFileUploads;
    public $categories;
    public $liters;

    public $name;
    public $category;
    public $size;
    public $images = [null];
    public $price = 0;
    public $description;
    public $quantity = 0;

    public function confirmImage()
    {
        $this->images[] = null; // Add a new input field, is same as writing: array_push($this->images, null);
    }

    public function mount()
    {
        $this->categories = ItemType::values();
        $this->liters = Liters::values();
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'required',
        'size' => 'required',
        'images.*' => 'nullable|image|max:2048',
        'price' => 'required|numeric|between:0,9999999.99|min:0.1',
        'description' => 'required|string|min:20',
        'quantity' => 'required|numeric|between:0,9999|min:1'
    ];

    public function createItem()
    {

        //dd($this->name, $this->category, $this->size, $this->images, $this->price, $this->description, $this->quantity);

        $this->validate();
        try {
            $newItem = Item::create([
                'name' => $this->name,
                'item_type' => $this->category,
                'liters' => $this->size,
                'price' => $this->price,
                'description' => $this->description,
                'quantity' => $this->quantity

            ]);


            foreach ($this->images as $image) {
                if ($image) {
                    $imageName = $image->store('images', 'public');
                    Image::create([
                        'url' => $imageName,
                        'item_id' => $newItem->id
                    ]);
                }
            }

        } catch (\Exception $e) {
            session()->flash('error', 'Error saving item: ' . $e->getMessage());
            $this->redirect('/item/create');
        }
    }


    public function render()
    {
        return view('livewire.create-item');
    }
}
