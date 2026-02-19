<?php

use App\Models\User;
use App\Models\Producto;
use App\Models\Team;

describe('User Model', function () {
    it('can create a user', function () {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        expect($user)->toBeInstanceOf(User::class);
        expect($user->name)->toBe('John Doe');
        expect($user->email)->toBe('john@example.com');
    });

    it('has a role attribute', function () {
        $user = User::factory()->create(['role' => 'admin']);

        expect($user->role)->toBe('admin');
    });

    it('can have multiple productos', function () {
        $user = User::factory()->create();

        Producto::factory(3)->create(['user_id' => $user->id]);

        expect($user->productos)->toHaveCount(3);
    });

    it('can have teams', function () {
        $user = User::factory()->create();

        Team::factory(2)->create(['user_id' => $user->id]);

        expect($user->teams)->toHaveCount(2);
    });

    it('has encrypted password', function () {
        $user = User::factory()->create(['password' => 'secret']);

        expect($user->password)->not->toBe('secret');
    });

    it('hides sensitive attributes in array', function () {
        $user = User::factory()->create(['password' => 'secret']);

        $array = $user->toArray();

        expect($array)->not->toHaveKey('password');
        expect($array)->not->toHaveKey('remember_token');
    });

    it('can find user by email', function () {
        User::factory()->create(['email' => 'test@example.com']);

        $user = User::where('email', 'test@example.com')->first();

        expect($user)->not->toBeNull();
        expect($user->email)->toBe('test@example.com');
    });
});
