<x-layouts.app title="Detalle del Producto">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="/productos" class="text-slate-500 hover:text-slate-700 font-light">← Volver a Productos</a>
        </div>
        <div class="grid grid-cols-3 gap-6 mb-6">
            <!-- Información principal -->
            <div class="col-span-2">
                <x-molecules.card title="Laptop Dell XPS 13">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-light text-slate-500 uppercase tracking-wide mb-2">Descripción</h3>
                            <p class="text-slate-600 font-light">Portátil ultraligero de 13 pulgadas con procesador Intel de última generación, pantalla FHD IPS y batería de larga duración.</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-light text-slate-500 uppercase tracking-wide mb-2">SKU</h3>
                                <p class="text-slate-700 font-mono font-light">DELL-XPS-13-001</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-light text-slate-500 uppercase tracking-wide mb-2">Categoría</h3>
                                <p class="text-slate-700 font-light">Laptops</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-light text-slate-500 uppercase tracking-wide mb-2">Precio</h3>
                                <p class="text-3xl font-light text-slate-600">$1,200.00</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-light text-slate-500 uppercase tracking-wide mb-2">Stock</h3>
                                <p class="text-3xl font-light text-slate-600">15 unidades</p>
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-4">
                            <h3 class="text-sm font-light text-slate-500 uppercase tracking-wide mb-2">Estado</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-light bg-emerald-100 text-emerald-700">
                                Activo
                            </span>
                        </div>
                    </div>
                </x-molecules.card>
            </div>

            <!-- Acciones -->
            <div>
                <x-molecules.card title="Acciones">
                    <div class="space-y-3">
                        <a href="/productos/1/edit" class="block">
                            <x-atoms.button variant="primary" size="md" class="w-full">
                                Editar
                            </x-atoms.button>
                        </a>
                        <a href="#" class="block">
                            <x-atoms.button variant="secondary" size="md" class="w-full">
                                Duplicar
                            </x-atoms.button>
                        </a>
                        <form action="/productos/1" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-atoms.button variant="danger" size="md" class="w-full" type="submit">
                                Eliminar
                            </x-atoms.button>
                        </form>
                    </div>
                </x-molecules.card>

                <!-- Metadata -->
                <x-molecules.card title="Información" class="mt-6">
                    <div class="space-y-4 text-sm">
                        <div>
                            <h4 class="font-light text-slate-600">Creado</h4>
                            <p class="text-slate-500 font-light">15 de Enero, 2026</p>
                        </div>
                        <div>
                            <h4 class="font-light text-slate-600">Actualizado</h4>
                            <p class="text-slate-500 font-light">20 de Enero, 2026</p>
                        </div>
                        <div>
                            <h4 class="font-light text-slate-600">ID</h4>
                            <p class="text-slate-500 font-mono text-xs font-light">550e8400-e29b-41d4-a716-446655440000</p>
                        </div>
                    </div>
                </x-molecules.card>
            </div>
        </div>
    </div>
</x-layouts.app>
