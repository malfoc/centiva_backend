<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Team;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class MemberControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex() {
        $member = Member::factory()->hasTeam(1)->create();

        $response = $this->get(route('members.index'));

        $response->assertSuccessful();
        $response->assertJsonFragment([
            'id' => $member->id,
            'fullname' => $member->fullname,
            'email' => $member->email,
            'team' => $member->team->toArray(),
        ]);
    }

    public function testStore() {
        $fullname = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $team = Team::factory()->create();

        $response = $this->post('/members', [
            'fullname' => $fullname,
            'email' => $email,
            'team_id' => $team->id
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('members', [
            'fullname' => $fullname,
            'email' => $email,
            'team_id' => $team->id
        ]);
    }

    public function testShow()
    {
        $member = Member::factory()->hasTeam(1)->create();

        $response = $this->getJson("/member/{$member->id}");

        $response->assertSuccessful();
        $response->assertJson([
            'response' => [
                'id' => $member->id,
                'fullname' => $member->fullname,
                'email' => $member->email,
                'team' => $member->team->toArray(),
            ]
        ]);
    }
}
