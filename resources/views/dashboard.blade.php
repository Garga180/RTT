<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <h2 class="text-2xl font-semibold mb-6">Available Products</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                            @foreach($products as $product)
                                <div class="bg-white dark:bg-gray-800 shadow-md hover:shadow-lg transition-shadow rounded-lg overflow-hidden">
                                    
                                    
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img class="object-cover w-30 h-30" src="{{ asset($product->image_url) }}" alt="Picture">
                                    </div>
                                                
                                    
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $product->ItemName }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                            Description: {{ $product->ItemDescription }}
                                        </p>
                                        <p class="text-xl font-bold text-gray-900 dark:text-gray-200 mt-4">
                                            Price: {{ $product->ItemPrice }} HUF
                                        </p>

                                        
                                        <div class="flex items-center justify-between mt-4 text-sm text-gray-600 dark:text-gray-300">
                                            <span>Available: {{ $product->Quantity }}</span>
                                        </div>

                                        
                                        <div class="mt-4">
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf
                                                <x-primary-button type="submit">Add to Cart</x-primary-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
