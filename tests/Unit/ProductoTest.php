<?php

use App\Models\Producto;
use App\Models\User;

describe('Producto Model', function () {
    it('can create a producto', function () {
        $producto = Producto::factory()->create([
            'name' => 'Laptop',
            'price' => 1500.00,
            'stock' => 10,
        ]);

        expect($producto)->toBeInstanceOf(Producto::class);
        expect($producto->name)->toBe('Laptop');
        expect($producto->price)->toBe(1500.00);
        expect($producto->stock)->toBe(10);
    });

    it('has correct fillable attributes', function () {
        $producto = Producto::factory()->create([
            'name' => 'iPhone',
            'description' => 'Latest model',
            'category' => 'Electronics',
            'price' => 999.99,
            'stock' => 5,
            'sku' => 'IP15-001',
            'active' => true,
        ]);

        expect($producto->name)->toBe('iPhone');
        expect($producto->description)->toBe('Latest model');
        expect($producto->category)->toBe('Electronics');
        expect($producto->sku)->toBe('IP15-001');
        expect($producto->active)->toBeTrue();
    });

    it('casts price as decimal', function () {
        $producto = Producto::factory()->create(['price' => 99.99]);

        expect($producto->price)->toBe(99.99);
    });

    it('casts stock as integer', function () {
        $producto = Producto::factory()->create(['stock' => 42]);

        expect($producto->stock)->toBe(42);
        expect($producto->stock)->toBeInt();
    });

    it('casts active as boolean', function () {
        $producto = Producto::factory()->create(['active' => true]);

        expect($producto->active)->toBeTrue();
    });

    it('belongs to a user', function () {
        $user = User::factory()->create();
        $producto = Producto::factory()->create(['user_id' => $user->id]);

        expect($producto->user_id)->toBe($user->id);
        expect($producto->user->id)->toBe($user->id);
    });

    it('can find producto by sku', function () {
        Producto::factory()->create(['sku' => 'UNIQUE-SKU-123']);

        $producto = Producto::where('sku', 'UNIQUE-SKU-123')->first();

        expect($producto)->not->toBeNull();
        expect($producto->sku)->toBe('UNIQUE-SKU-123');
    });

    it('can filter active productos', function () {
        Producto::factory(5)->create(['active' => false]);
        Producto::factory(3)->create(['active' => true]);

        $activeProductos = Producto::where('active', true)->count();

        expect($activeProductos)->toBe(3);
    });

    it('can filter by category', function () {
        Producto::factory(2)->create(['category' => 'Electronics']);
        Producto::factory(2)->create(['category' => 'Books']);

        $electronics = Producto::where('category', 'Electronics')->count();
        $books = Producto::where('category', 'Books')->count();

        expect($electronics)->toBe(2);
        expect($books)->toBe(2);
    });
});
