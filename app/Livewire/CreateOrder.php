<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;

class CreateOrder extends Component
{
    public $items;
    public $user;

    public $orderItems = [[]];

    public $totalPcs = 0;
    public $totalAmount = 0;

    public function updated($propertyName)
    {
        if (preg_match('/orderItems\.(\d+)\.(item_id|quantity)/', $propertyName, $matches)) {
            $index = $matches[1];
            $this->updateOrderItem($index);
        }
    }

    private function updateOrderItem($index)
    {
        $item = $this->orderItems[$index] ?? null;
        if ($item && isset($item['item_id'])) {
            $selectedItem = $this->items->find($item['item_id']);
            if ($selectedItem) {
                $this->orderItems[$index]['price'] = $selectedItem->price;
                $quantity = $this->orderItems[$index]['quantity'] ?? 0;
                $this->orderItems[$index]['total'] = $selectedItem->price * $quantity;
            }
        }
        $this->calculateTotals();
    }

    private function calculateTotals()
    {
        $this->totalPcs = 0;
        $this->totalAmount = 0;

        foreach ($this->orderItems as $item) {
            if (isset($item['quantity'])) {
                $this->totalPcs += $item['quantity'];
            }
            if (isset($item['total'])) {
                $this->totalAmount += $item['total'];
            }
        }
    }


    public function mount(User $user)
    {
        $this->items = Item::all();
        $this->user = $user;
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
        $this->calculateTotals();
    }


    public function clearRow()
    {
        $this->reset(['selectedItemId', 'quantity', 'price']);
    }

    public function removeOrderItem($index)
    {
        if (count($this->orderItems) > 1) {
            unset($this->orderItems[$index]);
            $this->orderItems = array_values($this->orderItems); // Reindex array
            $this->calculateTotals();
        } else {

            session()->flash('message', 'At least one item is required.');
        }
    }

    public function saveOrder()
    {
        $order = new Order([
            'user_id' => $this->user->id,
            'total_items' => $this->totalPcs,
            'total_amount' => $this->totalAmount
        ]);

        $order->save();



        foreach ($this->orderItems as $orderItem) {
            if (isset($orderItem['item_id']) && isset($orderItem['quantity'])) {
                // Attach the item to the order with the additional pivot data (quantity)
                $order->items()->attach($orderItem['item_id'], ['quantity' => $orderItem['quantity']]);
            }
        }

        // Reset order items after saving
        $this->orderItems = [[]];
        $this->calculateTotals();

        // Redirect or return response
        // return redirect()->route('orders.show', $order->id);
    }


    public function render()
    {
        return view('livewire.create-order');
    }
}
