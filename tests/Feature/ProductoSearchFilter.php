<?php

use App\Models\User;
use App\Models\Producto;

describe('Producto Search and Filter', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();

        Producto::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'iPhone 15',
            'category' => 'Electronics',
            'price' => 999.99,
            'active' => true,
        ]);

        Producto::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'Samsung Galaxy',
            'category' => 'Electronics',
            'price' => 799.99,
            'active' => true,
        ]);

        Producto::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'Laravel Book',
            'category' => 'Books',
            'price' => 49.99,
            'active' => true,
        ]);

        Producto::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'Old Product',
            'category' => 'Electronics',
            'price' => 29.99,
            'active' => false,
        ]);
    });

    it('can filter by category', function () {
        $electronics = Producto::where('category', 'Electronics')
            ->where('user_id', $this->user->id)
            ->count();

        expect($electronics)->toBe(3);
    });

    it('can filter by active status', function () {
        $active = Producto::where('active', true)
            ->where('user_id', $this->user->id)
            ->count();

        expect($active)->toBe(3);
    });

    it('can search by name', function () {
        $search = Producto::where('name', 'like', '%iPhone%')
            ->where('user_id', $this->user->id)
            ->count();

        expect($search)->toBe(1);
    });

    it('can filter by price range', function () {
        $expensive = Producto::whereBetween('price', [500, 1000])
            ->where('user_id', $this->user->id)
            ->count();

        expect($expensive)->toBe(2);
    });

    it('can sort by price ascending', function () {
        $productos = Producto::where('user_id', $this->user->id)
            ->where('active', true)
            ->orderBy('price', 'asc')
            ->get();

        expect($productos->first()->price)->toBe(49.99);
        expect($productos->last()->price)->toBe(999.99);
    });

    it('can sort by price descending', function () {
        $productos = Producto::where('user_id', $this->user->id)
            ->where('active', true)
            ->orderBy('price', 'desc')
            ->get();

        expect($productos->first()->price)->toBe(999.99);
        expect($productos->last()->price)->toBe(49.99);
    });

    it('can combine multiple filters', function () {
        $filtered = Producto::where('user_id', $this->user->id)
            ->where('category', 'Electronics')
            ->where('active', true)
            ->where('price', '>', 500)
            ->count();

        expect($filtered)->toBe(2);
    });
});
