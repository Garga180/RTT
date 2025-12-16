<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Place Your Order</h1>

        <form method="POST" action="{{ route('placeOrder') }}">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
            </div>

            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" id="city" name="city" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
            </div>

            <div>
                <label for="zipcode" class="block text-sm font-medium text-gray-700">Zip Code</label>
                <input type="text" id="zipcode" name="zipcode" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
            </div>

            <div>
                <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                <input type="text" id="street" name="street" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
            </div>

            <div>
                <label for="house_number" class="block text-sm font-medium text-gray-700">House Number</label>
                <input type="text" id="house_number" name="house_number"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
            </div>

            <x-primary-button type="submit"
                class="mt-4 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                Place Order
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
