@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('productos.index') }}" class="text-slate-600 hover:text-slate-800 font-semibold mb-6 inline-block">
            ← Volver al listado
        </a>

        <!-- Header -->
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Crear Nuevo Producto</h1>
        <p class="text-gray-600 mb-8">Completa el formulario para agregar un nuevo producto al inventario</p>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('productos.store') }}" class="space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Producto *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="Ej: Laptop ASUS"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SKU Field -->
                <div>
                    <label for="sku" class="block text-sm font-semibold text-gray-700 mb-2">SKU</label>
                    <input
                        type="text"
                        id="sku"
                        name="sku"
                        value="{{ old('sku') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sku') border-red-500 @enderror"
                        placeholder="Ej: SKU-001"
                    >
                    @error('sku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Field -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Categoría</label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        value="{{ old('category') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror"
                        placeholder="Ej: Electrónica"
                    >
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                        placeholder="Descripción detallada del producto..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Precio Unitario ($) *</label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price') }}"
                            step="0.01"
                            min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price') border-red-500 @enderror"
                            placeholder="0.00"
                            required
                        >
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock Field -->
                    <div>
                        <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stock (Cantidad) *</label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stock') border-red-500 @enderror"
                            placeholder="0"
                            required
                        >
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Active Checkbox -->
                <div class="flex items-center">
                    <input
                        type="hidden"
                        name="active"
                        value="0"
                    >
                    <input
                        type="checkbox"
                        id="active"
                        name="active"
                        value="1"
                        {{ old('active', true) ? 'checked' : '' }}
                        class="w-4 h-4 text-slate-600 rounded focus:ring-2 focus:ring-slate-500"
                    >
                    <label for="active" class="ml-2 text-sm font-semibold text-gray-700">Producto Activo</label>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('productos.index') }}" class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 font-semibold">
                        Cancelar
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-800 font-semibold transition"
                    >
                        Crear Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
