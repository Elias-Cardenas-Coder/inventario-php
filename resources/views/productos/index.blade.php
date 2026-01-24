@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Productos</h1>
                <p class="mt-2 text-gray-600">Gestiona el catálogo de productos</p>
            </div>
            <a href="{{ route('productos.create') }}" class="bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-6 rounded-lg transition">
                + Crear Producto
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($productos->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($productos as $producto)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $producto->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $producto->category ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">${{ number_format($producto->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $producto->stock }}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($producto->active)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="inline-block bg-slate-700 hover:bg-slate-800 text-white font-semibold py-1 px-3 rounded transition">Ver</a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="inline-block bg-slate-700 hover:bg-slate-800 text-white font-semibold py-1 px-3 rounded transition">Editar</a>
                                    <button onclick="confirmDelete({{ $producto->id }})" class="text-red-600 hover:text-red-800 font-semibold">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-white border-t border-gray-200">
                    {{ $productos->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <p class="text-gray-500 text-lg">No hay productos registrados</p>
                    <a href="{{ route('productos.create') }}" class="mt-4 inline-block bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-6 rounded-lg">
                        Crear el primer producto
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-bold text-gray-900">Confirmar eliminación</h3>
        <p class="mt-2 text-gray-600">¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
        <div class="mt-6 flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 font-semibold">
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

<script>
function confirmDelete(productId) {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteForm').action = `/productos/${productId}`;
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
@endsection
