<x-app-layout>
    @if(Gate::check('can_do', ['permission read']))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permissions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-print-none with-border mb-8">
                @if(Gate::check('can_do', ['permission create']))
                <a href="{{ route('permission.create') }}" 
                    class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-base px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    {{ __('Add permission') }}
                </a>
                @endif
            </div>

            <!-- table -->
            <div class="overflow-x-auto">
                <div>
                    @include('message')
                    @yield('content')
                </div>
                
                <div class="min-w-screen min-h-screen flex justify-center font-sans overflow-hidden">
                    <div class="w-full lg:w-1/2">
                        <div class="bg-white shadow-md rounded my-6">
                            <table class="min-w-max w-full table-auto cell-border stripe" id="table">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">Permissions</th>
                                        <th class="py-3 px-6 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach($permissions as $permission)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <span class="font-medium">{{ $permission->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span class="text-gray-600 py-1 px-3 font-medium">
                                                @if ($permission['status'] == Permission::STATUS_ENABLE)
                                                    enable
                                                @else
                                                    disable
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-5">
                            {{ $permissions->links('vendor.pagination.tailwind') }}
                        </div>
                        <x-slot name="scripts">
                            <script src="{{ asset('pages/js/datatable.js') }}"></script>
                        </x-slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>