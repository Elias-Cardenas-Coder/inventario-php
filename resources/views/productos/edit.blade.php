<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <a href="{{ route('dashboard') }}" class="text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 font-semibold mb-6 inline-block">
                ← Volver al listado
            </a>

            <!-- Header -->
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Editar Producto</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-8">{{ $producto->name }}</p>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nombre del Producto *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $producto->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="Ej: Laptop ASUS"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SKU Field -->
                <div>
                    <label for="sku" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SKU</label>
                    <input
                        type="text"
                        id="sku"
                        name="sku"
                        value="{{ old('sku', $producto->sku) }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('sku') border-red-500 @enderror"
                        placeholder="Ej: SKU-001"
                    >
                    @error('sku')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Field -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Categoría</label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        value="{{ old('category', $producto->category) }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('category') border-red-500 @enderror"
                        placeholder="Ej: Electrónica"
                    >
                    @error('category')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('description') border-red-500 @enderror"
                        placeholder="Descripción detallada del producto..."
                    >{{ old('description', $producto->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Precio Unitario ($) *</label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', $producto->price) }}"
                            step="0.01"
                            min="0"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('price') border-red-500 @enderror"
                            placeholder="0.00"
                            required
                        >
                        @error('price')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock Field -->
                    <div>
                        <label for="stock" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Stock (Cantidad) *</label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', $producto->stock) }}"
                            min="0"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('stock') border-red-500 @enderror"
                            placeholder="0"
                            required
                        >
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Field -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Imagen del Producto</label>

                    @if($producto->image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Imagen actual:</p>
                            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}" class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600 mb-3">

                            <!-- Checkbox para eliminar imagen -->
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="delete_image"
                                    name="delete_image"
                                    value="1"
                                    class="w-4 h-4 text-red-600 rounded focus:ring-2 focus:ring-red-500"
                                >
                                <label for="delete_image" class="ml-2 text-sm font-semibold text-red-600 dark:text-red-400">Eliminar imagen actual</label>
                            </div>
                        </div>
                    @endif

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror"
                    >
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB. Dejar vacío para mantener la imagen actual.</p>
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
                        {{ old('active', $producto->active) ? 'checked' : '' }}
                        class="w-4 h-4 text-slate-600 rounded focus:ring-2 focus:ring-slate-500"
                    >
                    <label for="active" class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Producto Activo</label>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t dark:border-gray-700">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold">
                        Cancelar
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-800 font-semibold transition"
                    >
                        Guardar Cambios
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Deshabilitar el campo de archivo cuando se marca eliminar imagen
        const deleteImageCheckbox = document.getElementById('delete_image');
        const imageInput = document.getElementById('image');

        if (deleteImageCheckbox) {
            deleteImageCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    imageInput.disabled = true;
                    imageInput.value = '';
                    imageInput.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    imageInput.disabled = false;
                    imageInput.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
