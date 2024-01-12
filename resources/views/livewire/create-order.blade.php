<div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">New Order | {{ $user->name }} {{ $user->surname }}
    </h2>
    <div class="mb-8">
        <div class="grid grid-cols-6 gap-4 text-xs font-medium text-gray-700 uppercase bg-gray-50 px-6 py-3">
            <div class="col-span-2">Item</div>
            <div>Quantity</div>
            <div>Price</div>
            <div>Total</div>
            <div>Action</div>
        </div>
        <form wire:submit='createItem' class="grid grid-cols-6 gap-4 px-4 py-4 bg-white">
            @foreach ($orderItems as $key => $value)
                <div class="col-span-2">
                    <select id="item{{ $key }}" wire:model.live='orderItems.{{ $key }}.item_id'
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Select Item</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="number" name="quantity{{ $key }}"
                        wire:model.live="orderItems.{{ $key }}.quantity"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required="">
                </div>
                <div>
                    <input type="number" name="price{{ $key }}"
                        wire:model="orderItems.{{ $key }}.price"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required="">
                </div>
                <div>
                    <input type="number" name="total{{ $key }}"
                        wire:model="orderItems.{{ $key }}.total"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        readonly>
                </div>
                <div class="flex space-x-2">
                    <button @if (empty($orderItems[$key])) disabled @endif wire:click.prevent='addOrderItem'
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full ">Add</button>
                    <button
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">Clear</button>
                </div>
            @endforeach
            <div class="col-span-1 col-end-7">
                <button type="submit"
                    class=" items-center w-full px-5 py-2.5 mt-4 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-indigo-900 hover:bg-indigo-800">Save
                    Order</button>
            </div>
        </form>
    </div>

</div>
</div>
