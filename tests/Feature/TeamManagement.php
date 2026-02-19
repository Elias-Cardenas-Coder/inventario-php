<?php

use App\Models\User;
use App\Models\Team;

describe('Team Management', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('can create a team', function () {
        $response = $this->actingAs($this->user)->post(route('teams.store'), [
            'name' => 'Development Squad',
        ]);

        expect($response->status())->toBe(302);

        $this->assertDatabaseHas('teams', [
            'name' => 'Development Squad',
            'user_id' => $this->user->id,
        ]);
    });

    it('requires team name', function () {
        $response = $this->actingAs($this->user)->post(route('teams.store'), []);

        $response->assertSessionHasErrors('name');
    });

    it('can update team name', function () {
        $team = Team::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->put(route('teams.update', $team), [
            'name' => 'Updated Team Name',
        ]);

        expect($response->status())->toBe(302);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'name' => 'Updated Team Name',
        ]);
    });

    it('can delete a team', function () {
        $team = Team::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete(route('teams.destroy', $team));

        expect($response->status())->toBe(302);

        $this->assertDatabaseMissing('teams', [
            'id' => $team->id,
        ]);
    });

    it('user cannot update other users team', function () {
        $user2 = User::factory()->create();
        $team = Team::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($this->user)->put(route('teams.update', $team), [
            'name' => 'Hacked Team',
        ]);

        expect($response->status())->toBe(403);
    });

    it('can add team member', function () {
        $team = Team::factory()->create(['user_id' => $this->user->id]);
        $newMember = User::factory()->create();

        $team->users()->attach($newMember);

        expect($team->users)->toHaveCount(1);
        expect($team->users->first()->id)->toBe($newMember->id);
    });

    it('can remove team member', function () {
        $team = Team::factory()->create(['user_id' => $this->user->id]);
        $member = User::factory()->create();

        $team->users()->attach($member);
        expect($team->users)->toHaveCount(1);

        $team->users()->detach($member);
        expect($team->users)->toHaveCount(0);
    });
});
