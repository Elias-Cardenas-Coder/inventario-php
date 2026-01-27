<x-layouts.app title="Productos">
    <div class="mb-8 flex justify-between items-center">
        <h2 class="text-2xl font-light text-slate-700 tracking-wide">Lista de Productos</h2>
        <a href="/productos/crear">
            <x-atoms.button variant="primary">
                + Nuevo Producto
            </x-atoms.button>
        </a>
    </div>

    <x-molecules.card>
        <x-molecules.table :headers="['Nombre', 'Descripción', 'Precio', 'Stock']">
            <!-- Fila 1 -->
            <tr class="hover:bg-slate-50 transition-colors">
                <x-molecules.table-cell>Laptop Dell XPS 13</x-molecules.table-cell>
                <x-molecules.table-cell>Portátil ultraligero de 13 pulgadas</x-molecules.table-cell>
                <x-molecules.table-cell align="right">$1,200.00</x-molecules.table-cell>
                <x-molecules.table-cell align="center">
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-light">15</span>
                </x-molecules.table-cell>
                <td class="px-6 py-4 border-b border-slate-200 text-sm">
                    <div class="flex gap-2">
                        <a href="/productos/1">
                            <x-atoms.button variant="outline" size="sm">Ver</x-atoms.button>
                        </a>
                        <a href="/productos/1/edit">
                            <x-atoms.button variant="primary" size="sm">Editar</x-atoms.button>
                        </a>
                        <form action="/productos/1" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <x-atoms.button variant="danger" size="sm" type="submit">Borrar</x-atoms.button>
                        </form>
                    </div>
                </td>
            </tr>

            <!-- Fila 2 -->
            <tr class="hover:bg-slate-50 transition-colors">
                <x-molecules.table-cell>Mouse Logitech MX</x-molecules.table-cell>
                <x-molecules.table-cell>Mouse inalámbrico de precisión</x-molecules.table-cell>
                <x-molecules.table-cell align="right">$79.99</x-molecules.table-cell>
                <x-molecules.table-cell align="center">
                    <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-light">5</span>
                </x-molecules.table-cell>
                <td class="px-6 py-4 border-b border-slate-200 text-sm">
                    <div class="flex gap-2">
                        <a href="/productos/2">
                            <x-atoms.button variant="outline" size="sm">Ver</x-atoms.button>
                        </a>
                        <a href="/productos/2/edit">
                            <x-atoms.button variant="primary" size="sm">Editar</x-atoms.button>
                        </a>
                        <form action="/productos/2" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <x-atoms.button variant="danger" size="sm" type="submit">Borrar</x-atoms.button>
                        </form>
                    </div>
                </td>
            </tr>

            <!-- Fila 3 -->
            <tr class="hover:bg-slate-50 transition-colors">
                <x-molecules.table-cell>Teclado Mecánico RGB</x-molecules.table-cell>
                <x-molecules.table-cell>Teclado mecánico con retroiluminación</x-molecules.table-cell>
                <x-molecules.table-cell align="right">$149.99</x-molecules.table-cell>
                <x-molecules.table-cell align="center">
                    <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-sm font-light">2</span>
                </x-molecules.table-cell>
                <td class="px-6 py-4 border-b border-slate-200 text-sm">
                    <div class="flex gap-2">
                        <a href="/productos/3">
                            <x-atoms.button variant="outline" size="sm">Ver</x-atoms.button>
                        </a>
                        <a href="/productos/3/edit">
                            <x-atoms.button variant="primary" size="sm">Editar</x-atoms.button>
                        </a>
                        <form action="/productos/3" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <x-atoms.button variant="danger" size="sm" type="submit">Borrar</x-atoms.button>
                        </form>
                    </div>
                </td>
            </tr>
        </x-molecules.table>
    </x-molecules.card>

    <!-- Paginación -->
    <div class="mt-8 flex justify-center gap-2">
        <x-atoms.button variant="outline" disabled>← Anterior</x-atoms.button>
        <x-atoms.button variant="primary">1</x-atoms.button>
        <x-atoms.button variant="outline">2</x-atoms.button>
        <x-atoms.button variant="outline">3</x-atoms.button>
        <x-atoms.button variant="outline">Siguiente →</x-atoms.button>
    </div>
</x-layouts.app>
