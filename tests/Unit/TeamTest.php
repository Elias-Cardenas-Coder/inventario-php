<?php

use App\Models\Team;
use App\Models\User;

describe('Team Model', function () {
    it('can create a team', function () {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'name' => 'Development Team',
        ]);

        expect($team)->toBeInstanceOf(Team::class);
        expect($team->name)->toBe('Development Team');
        expect($team->user_id)->toBe($user->id);
    });

    it('belongs to a user', function () {
        $user = User::factory()->create();
        $team = Team::factory()->create(['user_id' => $user->id]);

        expect($team->owner->id)->toBe($user->id);
    });

    it('can have multiple members', function () {
        $team = Team::factory()->create();
        $users = User::factory(3)->create();

        foreach ($users as $user) {
            $team->users()->attach($user);
        }

        expect($team->users)->toHaveCount(3);
    });

    it('has a personal flag', function () {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'personal_team' => true,
        ]);

        expect($team->personal_team)->toBeTrue();
    });

    it('can find team by name', function () {
        Team::factory()->create(['name' => 'Sales Team']);

        $team = Team::where('name', 'Sales Team')->first();

        expect($team)->not->toBeNull();
        expect($team->name)->toBe('Sales Team');
    });
});
