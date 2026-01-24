<x-layouts.app title="Crear Producto">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="/productos" class="text-slate-500 hover:text-slate-700 font-light">← Volver a Productos</a>
        </div>
        <x-molecules.card title="Nuevo Producto">
            <form action="/productos" method="POST" class="space-y-6">
                @csrf
                <x-molecules.form-group>
                    <x-molecules.form-field
                        label="Nombre del Producto"
                        id="name"
                        name="name"
                        placeholder="Ingrese el nombre del producto"
                        required
                    />

                    <x-molecules.form-field
                        label="Descripción"
                        id="description"
                        name="description"
                        type="textarea"
                        placeholder="Ingrese la descripción del producto"
                        rows="4"
                    />

                    <x-molecules.form-field
                        label="Categoría"
                        id="category"
                        name="category"
                        type="select"
                        required
                    />

                    <x-molecules.form-field
                        label="Precio"
                        id="price"
                        name="price"
                        type="number"
                        placeholder="0.00"
                        required
                    />

                    <x-molecules.form-field
                        label="Stock"
                        id="stock"
                        name="stock"
                        type="number"
                        placeholder="0"
                        required
                    />

                    <x-molecules.form-field
                        label="SKU"
                        id="sku"
                        name="sku"
                        placeholder="Ingrese el código SKU"
                    />

                    <x-molecules.form-field
                        label="Activo"
                        id="active"
                        name="active"
                        type="checkbox"
                    />
                </x-molecules.form-group>

                <div class="border-t border-slate-200 pt-6 flex gap-3">
                    <x-atoms.button variant="primary" type="submit">
                        Guardar Producto
                    </x-atoms.button>
                    <a href="/productos">
                        <x-atoms.button variant="secondary" type="button">
                            Cancelar
                        </x-atoms.button>
                    </a>
                </div>
            </form>
        </x-molecules.card>
    </div>
</x-layouts.app>
