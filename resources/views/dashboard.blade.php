<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard - Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Productos</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Gestiona el catálogo de productos</p>
                </div>
                <a href="{{ route('productos.create') }}" class="bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-6 rounded-lg transition">
                    + Crear Producto
                </a>
            </div>

            <!-- Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                @if($productos->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Imagen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Precio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($productos as $producto)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $producto->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($producto->image)
                                            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}" class="w-12 h-12 object-cover rounded">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-semibold">{{ $producto->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $producto->category ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-bold">${{ number_format($producto->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $producto->stock }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        @if($producto->active)
                                            <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs font-semibold">Activo</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-xs font-semibold">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                                        <a href="{{ route('productos.show', $producto->id) }}" class="inline-block bg-slate-700 hover:bg-slate-800 text-white font-semibold py-1 px-3 rounded transition">Ver</a>
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="inline-block bg-slate-700 hover:bg-slate-800 text-white font-semibold py-1 px-3 rounded transition">Editar</a>
                                        <button onclick="confirmDelete({{ $producto->id }})" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-semibold">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        {{ $productos->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <p class="text-gray-500 dark:text-gray-400 text-lg">No hay productos registrados</p>
                        <a href="{{ route('productos.create') }}" class="mt-4 inline-block bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-6 rounded-lg">
                            Crear el primer producto
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Confirmar eliminación</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
            <div class="mt-6 flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" class="inline" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 font-semibold">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function confirmDelete(productId) {
        document.getElementById('deleteModal').classList.remove('hidden');
        const route = "{{ route('productos.destroy', ':id') }}".replace(':id', productId);
        document.getElementById('deleteForm').action = route;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeDeleteModal();
        }
    });
    </script>
    @endpush
</x-app-layout>
