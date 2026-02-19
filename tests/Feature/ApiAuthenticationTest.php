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
        $response = $this->getJson('/api/user');

        expect($response->status())->toBe(401);
    });

    it('rejects request with invalid token', function () {
        $response = $this->withHeader('Authorization', 'Bearer invalid-token')
            ->getJson('/api/user');

        expect($response->status())->toBe(401);
    });

    it('can delete api token', function () {
        $user = User::factory()->create();
        $token = $user->createToken('test-token');

        Sanctum::actingAs($user);

        $response = $this->deleteJson('/api/tokens/' . $token->accessToken->id);

        expect($response->status())->toBe(200);
    });

    it('token is revoked after deletion', function () {
        $user = User::factory()->create();
        $tokenResult = $user->createToken('test-token');
        $token = $tokenResult->plainTextToken;
        $tokenId = $tokenResult->accessToken->id;

        Sanctum::actingAs($user);

        $this->deleteJson('/api/tokens/' . $tokenId);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/user');

        expect($response->status())->toBe(401);
    });
});
