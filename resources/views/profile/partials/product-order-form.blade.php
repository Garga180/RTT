<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Place order to update your stock</h2>

                <form action="{{ route('place.stock.order') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="ItemName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product name</label>
                        <input type="text" name="ItemName" id="ItemName" required class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 text-gray-800 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="ItemPrice" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (HUF)</label>
                        <input type="number" name="ItemPrice" id="ItemPrice" required class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 text-gray-800 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="ItemDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="ItemDescription" id="ItemDescription" rows="3" required class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 text-gray-800 dark:text-gray-100"></textarea>
                    </div>

                    <div>
                        <label for="Quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                        <input type="number" name="Quantity" id="Quantity" required class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 text-gray-800 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 text-gray-800 dark:text-gray-100">
                    </div>

                    <div>
                        <x-primary-button type="submit">{{ __('Place your order') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
