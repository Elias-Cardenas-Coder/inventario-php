<?php

use App\Models\User;

describe('Authentication', function () {
    it('can display login page', function () {
        $response = $this->get(route('login'));

        expect($response->status())->toBe(200);
    });

    it('can login with valid credentials', function () {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        expect($response->status())->toBe(302);
        $this->assertAuthenticatedAs($user);
    });

    it('cannot login with invalid email', function () {
        $response = $this->post(route('login'), [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        expect($response->status())->toBe(302);
        $this->assertGuest();
    });

    it('cannot login with invalid password', function () {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
    });

    it('can display registration page', function () {
        $response = $this->get(route('register'));

        expect($response->status())->toBe(200);
    });

    it('can register new user', function () {
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => true,
        ]);

        expect($response->status())->toBe(302);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);
    });

    it('requires password confirmation on register', function () {
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors('password');
    });

    it('can logout authenticated user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        expect($response->status())->toBe(302);
        $this->assertGuest();
    });

    it('authenticated user cannot access login page', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('login'));

        expect($response->status())->toBe(302);
        $response->assertRedirect(route('dashboard'));
    });

    it('guest cannot access dashboard', function () {
        $response = $this->get(route('dashboard'));

        expect($response->status())->toBe(302);
        $response->assertRedirect(route('login'));
    });
});
