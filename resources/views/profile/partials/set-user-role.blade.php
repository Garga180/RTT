<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <section class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">

                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Set role for users</h2>
                    <form action="{{ route('users.updateRoles') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="relative overflow-x-auto sm:rounded-lg shadow-sm">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-10 py-4 font-semibold">Name</th>
                                        <th scope="col" class="px-10 py-4 font-semibold">Email</th>
                                        <th scope="col" class="px-10 py-4 font-semibold">Role</th>
                                        <th scope="col" class="px-10 py-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        @if($user->id !== 1)
                                            <tr class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                                <th class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</th>
                                                <th class="px-6 py-4 text-gray-700 dark:text-gray-400">{{ $user->email }}</th>
                                                <th class="px-6 py-4">
                                                    <select name="roles[{{ $user->id }}]" class="w-full p-2 border border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-100">
                                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </th>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-primary-button type="submit">{{ __('Save All Changes') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
