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
                                <th scope="col" class="px-6 py-3">Description</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                            @foreach ($products as $product)
                                <tr class="odd:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-200 even:dark:bg-gray-700 border-b dark:border-gray-700">
                                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->ItemName }}</th>
                                    <th class="px-6 py-4">{{ $product->ItemPrice }} HUF</th>
                                    <th class="px-6 py-4">{{ $product->ItemDescription }}</th>
                                    <th class="px-6 py-4">{{ $product->Quantity }}</th>
                                    <th class="px-6 py-4 text-left">
                                        <a href="{{ route('products.edit', $product->id) }}" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline" style="color: yellow;">Edit</a>
                                    </th>
                                    <th class="px-6 py-4 text-right">
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 uppercase dark:text-red-500 hover:underline" style="color: #DC2626;">Delete</button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
