<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testIndex() {
        $team = Team::factory()->hasMembers(1)->create();

        $response = $this->get(route('teams.index'));

        $response->assertSuccessful();
        $response->assertJsonFragment([
            'id' => $team->id,
            'name' => $team->name,
            'members' => $team->members->toArray(),
        ]);
    }

    public function testShow() {
        $team = Team::factory()->hasMembers(1)->create();

        $response = $this->getJson("/team/{$team->id}");

        $response->assertSuccessful();
        $response->assertJson([
            'response' => [
                'id' => $team->id,
                'name' => $team->name,
                'members' => $team->members->toArray(),
            ]
        ]);
    }

    public function testDestroy() {
        $team = Team::factory()->hasMembers(1)->create();

        $response = $this->delete(route('teams.destroy', $team->id));

        $response->assertSuccessful();
        $this->assertNull(Team::find($team->id));
    }
}
