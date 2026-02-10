<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $query = Producto::query();

        // Si el usuario no es admin, solo mostrar sus propios productos
        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }
        // Si es admin, ve todos los productos (incluso los que no tienen user_id)

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $productos = $query->paginate(10)->appends(request()->query());

        return view('productos.index', compact('productos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        // Manejar la subida de imagen
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('productos', 'public');
        }

        Producto::create($data);
        return redirect()->route('dashboard')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        // Solo el dueño o un admin puede ver el producto
        if (!auth()->user()->isAdmin() && $producto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver este producto.');
        }

        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        // Solo el dueño o un admin puede editar el producto
        if (!auth()->user()->isAdmin() && $producto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este producto.');
        }

        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        // Solo el dueño o un admin puede actualizar el producto
        if (!auth()->user()->isAdmin() && $producto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar este producto.');
        }

        $data = $request->validated();

        // Verificar si se marcó para eliminar la imagen
        if ($request->has('delete_image') && $request->delete_image == '1') {
            // Eliminar la imagen del storage
            if ($producto->image && \Storage::disk('public')->exists($producto->image)) {
                \Storage::disk('public')->delete($producto->image);
            }
            $data['image'] = null;
        }
        // Si no se marcó para eliminar, verificar si hay una nueva imagen
        elseif ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($producto->image && \Storage::disk('public')->exists($producto->image)) {
                \Storage::disk('public')->delete($producto->image);
            }
            $data['image'] = $request->file('image')->store('productos', 'public');
        }

        $producto->update($data);
        return redirect()->route('dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        // Solo el dueño o un admin puede eliminar el producto
        if (!auth()->user()->isAdmin() && $producto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este producto.');
        }

        // Eliminar la imagen si existe
        if ($producto->image && \Storage::disk('public')->exists($producto->image)) {
            \Storage::disk('public')->delete($producto->image);
        }

        $producto->delete();
        return redirect()->route('dashboard')->with('success', 'Producto eliminado exitosamente.');
    }
}
