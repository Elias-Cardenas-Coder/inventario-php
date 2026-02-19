<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

describe('API Authentication with Sanctum', function () {
    it('can create api token', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/tokens', [
            'device_name' => 'My Device',
        ]);

        expect($response->status())->toBe(201);
        expect($response->json())->toHaveKey('plainTextToken');
    });

    it('can authenticate with api token', function () {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->get('/api/user');

        expect($response->status())->toBe(200);
    });

    it('rejects request without token', function () {
        $response = $this->get('/api/user');

        expect($response->status())->toBe(401);
    });

    it('rejects request with invalid token', function () {
        $response = $this->withHeader('Authorization', 'Bearer invalid-token')
            ->get('/api/user');

        expect($response->status())->toBe(401);
    });

    it('can delete api token', function () {
        $user = User::factory()->create();
        $token = $user->createToken('test-token');

        Sanctum::actingAs($user);

        $response = $this->delete('/api/tokens/' . $token->id);

        expect($response->status())->toBe(200);
    });

    it('token is revoked after deletion', function () {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        Sanctum::actingAs($user);

        $this->delete('/api/tokens/1');

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->get('/api/user');

        expect($response->status())->toBe(401);
    });
});
