<div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">New Order | {{ $user->name }} {{ $user->surname }}
    </h2>
    <form wire:submit='createItem'>
        <div class="grid gap-4 sm:grid-cols-6 sm:gap-6">


            <div class="col-span-2">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item</label>
                <select id="category" wire:model='category'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option selected="">Select Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label for="quantity"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                <input type="number" name="quantity" id="quantity" wire:model='quantity'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required="">
            </div>
            <div class="w-full">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                <input type="number" name="price" id="price" wire:model='price'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required="">
            </div>
            <div class="w-full">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total</label>
                <input type="number" name="price" id="price" wire:model='price'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    readonly>
            </div>
            {{-- <div>
                <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                <select id="size" wire:model='size'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option selected="">Select category</option>
                    @foreach ($liters as $size)
                        <option value="{{ $size }}">{{ $size }}</option>
                    @endforeach
                </select>
            </div>

            @foreach ($images as $key => $value)
                <div class="sm:col-span-2">
                    <label for="image{{ $key }}"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image</label>
                    <div class="flex items-center space-x-4">
                        <input type="file" name="image{{ $key }}" id="image{{ $key }}"
                            wire:model="images.{{ $key }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Max 2Mb">
                        <div x-data="{ show: @entangle('images') }"">
                            <button wire:click.prevent="confirmImage" type="button"
                                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                Confirm
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="w-full">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                <input type="number" name="price" id="price" wire:model='price'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required="">
            </div>
            <div class="w-full">
                <label for="quantity"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                <input type="number" name="quantity" id="quantity" wire:model='quantity'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required="">
            </div>
            <div class="sm:col-span-2">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" rows="8" wire:model='description'
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Your description here"></textarea>
            </div> --}}
        </div>
        <button type="submit"
            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-indigo-900 hover:bg-indigo-800">
            Save Order
        </button>

    </form>
</div>
