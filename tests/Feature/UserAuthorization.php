<?php

use App\Models\User;
use App\Models\Producto;

describe('User Authorization', function () {
    it('user can only edit own productos', function () {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $producto = Producto::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->put(
            route('productos.update', $producto),
            ['name' => 'Hacked Product']
        );

        expect($response->status())->toBe(403);
    });

    it('user can view own productos', function () {
        $user = User::factory()->create();
        $producto = Producto::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('productos.show', $producto));

        expect($response->status())->toBe(200);
    });

    it('admin can view all productos', function () {
        $admin = User::factory()->create(['role' => 'admin']);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Producto::factory(3)->create(['user_id' => $user1->id]);
        Producto::factory(2)->create(['user_id' => $user2->id]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        expect($response->status())->toBe(200);
    });

    it('user cannot delete other users productos', function () {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $producto = Producto::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->delete(route('productos.destroy', $producto));

        expect($response->status())->toBe(403);

        $this->assertDatabaseHas('productos', ['id' => $producto->id]);
    });
});
