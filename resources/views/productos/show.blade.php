<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $producto->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Navigation -->
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 font-semibold inline-flex items-center">
                    ← Volver al listado
                </a>
            </div>

            <!-- Header with Actions -->
            <div class="mb-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-2">{{ $producto->name }}</h1>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">SKU: <span class="font-semibold">{{ $producto->sku ?? 'N/A' }}</span></p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-6 rounded-lg transition inline-block">
                            Editar
                        </a>
                        <button onclick="confirmDelete({{ $producto->id }})" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Section - Product Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Description Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Descripción del Producto</h2>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg whitespace-pre-wrap">{{ $producto->description ?? 'Sin descripción disponible' }}</p>
                    </div>

                    <!-- Details Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Detalles</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="border-l-4 border-slate-600 pl-4">
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">Categoría</p>
                                <p class="text-gray-900 dark:text-white text-xl font-semibold mt-1">{{ $producto->category ?? 'Sin categoría' }}</p>
                            </div>
                            <div class="border-l-4 border-slate-600 pl-4">
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">ID del Producto</p>
                                <p class="text-gray-900 dark:text-white text-xl font-semibold mt-1">#{{ $producto->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section - Key Information -->
                <div class="space-y-6">
                    <!-- Price Card -->
                    <div class="bg-gradient-to-br from-slate-700 to-slate-900 rounded-xl shadow-lg p-8 text-white">
                        <p class="text-slate-300 text-sm font-semibold uppercase mb-2">Precio Unitario</p>
                        <p class="text-5xl font-bold mb-6">${{ number_format($producto->price, 0, ',', '.') }}</p>
                        <p class="text-slate-400 text-sm">Precio en pesos colombianos</p>
                    </div>

                    <!-- Stock Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase mb-4">Stock Disponible</p>
                        <div class="flex items-baseline gap-2 mb-4">
                            <p class="text-5xl font-bold text-gray-900 dark:text-white">{{ $producto->stock }}</p>
                            <p class="text-xl text-gray-600 dark:text-gray-400">unidades</p>
                        </div>
                        <div class="pt-4 border-t dark:border-gray-700">
                            @if($producto->stock > 0)
                                <span class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-4 py-2 rounded-full font-semibold text-sm">
                                    Disponible
                                </span>
                            @else
                                <span class="inline-block bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-4 py-2 rounded-full font-semibold text-sm">
                                    Agotado
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase mb-4">Estado del Producto</p>
                        <div class="pt-2">
                            @if($producto->active)
                                <span class="inline-block bg-slate-700 text-white px-6 py-3 rounded-lg font-semibold">
                                    Activo
                                </span>
                            @else
                                <span class="inline-block bg-gray-400 dark:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                                    Inactivo
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Metadata Card -->
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-xl shadow-md p-8 text-sm">
                        <p class="text-gray-600 dark:text-gray-400 font-semibold mb-3">Información del Sistema</p>
                        <div class="space-y-3 text-gray-700 dark:text-gray-300">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-xs uppercase">Creado:</p>
                                <p class="font-medium">{{ $producto->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-xs uppercase">Actualizado:</p>
                                <p class="font-medium">{{ $producto->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Confirmar eliminación</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 font-semibold">{{ $producto->name }}</p>
            <div class="mt-6 flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" class="inline">
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
        const baseRoute = "{{ route('productos.destroy', ['producto' => 'REPLACE_ID']) }}";
        const route = baseRoute.replace('REPLACE_ID', productId);
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
