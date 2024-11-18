<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-blue-500 dark:bg-blue-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Product name</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Total</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                            @foreach ($cartItems as $cartItem)
                                <tr class="odd:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-200 even:dark:bg-gray-700 border-b dark:border-gray-700">
                                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $cartItem->product->ItemName }}
                                    </th>
                                    <th class="px-6 py-4">{{ number_format($cartItem->product->ItemPrice, 0, '.', ' ') }} HUF</th>
                                    
                                    <th class="px-6 py-4 flex items-center space-x-2">
                                        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="action" value="decrease" class="bg-gray-300 p-2 rounded-md hover:bg-gray-400">-</button>
                                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="w-12 text-center border border-gray-300 rounded-md" readonly> 
                                            <button type="submit" name="action" value="increase" class="bg-gray-300 p-2 rounded-md hover:bg-gray-400">+</button>
                                        </form>
                                    </th>
                                    
                                    <th class="px-6 py-4">{{ number_format($cartItem->product->ItemPrice * $cartItem->quantity, 0, '.', ' ') }} HUF</th>
                                    
                                    <th class="px-6 py-4 text-right">
                                        <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 uppercase dark:text-red-500 hover:underline" style="color: #DC2626;">Delete</button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <p class="text-lg font-semibold uppercase" style="color: white">Total: 
                            <span class="text-green-600">
                                {{ number_format($cartItems->sum(function($item) {
                                    return $item->product->ItemPrice * $item->quantity;
                                }), 0, '.', ' ') }} HUF
                            </span>
                        </p>
                    <div class="mt-6 text-right">
                        <a href="{{route('checkout')}}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
                            Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
