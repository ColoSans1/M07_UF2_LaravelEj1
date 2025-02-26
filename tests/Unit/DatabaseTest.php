<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\Film;
use App\Models\Actor;
use Illuminate\Support\Facades\DB;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function verify_laravel_project_is_configured_to_use_the_database()
    {
        $this->assertNotNull(config('database.default'));
    }

    /** @test */
    public function verify_films_table_is_created_with_correct_format()
    {
        $this->assertTrue(Schema::hasTable('films'));
        $this->assertTrue(Schema::hasColumns('films', [
            'id', 'name', 'year', 'genre', 'country', 'duration', 'img_url', 'created_at', 'updated_at'
        ]));
    }

    /** @test */
    public function verify_films_table_is_informed_with_dummy_data()
    {
        $this->seed(\Database\Seeders\FilmFakerSeeder::class);
        $this->assertGreaterThan(0, Film::count());
    }

    /** @test */
    public function verify_actors_table_is_created_with_correct_format()
    {
        $this->assertTrue(Schema::hasTable('actors'));
        $this->assertTrue(Schema::hasColumns('actors', [
            'id', 'name', 'surname', 'birthdate', 'country', 'img_url', 'created_at', 'updated_at'
        ]));
    }

    /** @test */
    public function verify_actors_table_is_informed_with_dummy_data()
    {
        $this->seed(\Database\Seeders\ActorFakerSeeder::class);
        $this->assertGreaterThan(0, Actor::count());
    }

    /** @test */
    public function verify_films_actors_table_is_created_with_correct_foreign_keys()
    {
        $this->assertTrue(Schema::hasTable('film_actor'));
        $this->assertTrue(Schema::hasColumns('film_actor', [
            'film_id', 'actor_id', 'created_at', 'updated_at'
        ]));
    }

    /** @test */
    public function verify_films_actors_table_is_informed_with_data()
    {
        $this->seed(\Database\Seeders\FilmActorSeeder::class);
        $this->assertGreaterThan(0, DB::table('film_actor')->count());
    }

    /** @test */
    public function verify_delete_cascade_on_films_and_actors()
    {
        $this->seed(\Database\Seeders\FilmActorSeeder::class);

        $film = Film::first();
        $filmId = $film->id;
        $film->delete();

        $this->assertDatabaseMissing('film_actor', ['film_id' => $filmId]);

        $actor = Actor::first();
        $actorId = $actor->id;
        $actor->delete();

        $this->assertDatabaseMissing('film_actor', ['actor_id' => $actorId]);
    }

    /** @test */
    public function verify_bug_has_been_fixed()
    {
        // Aquí puedes probar un error específico que arreglaste
        $this->assertTrue(true);
    }

    /** @test */
    public function verify_enhancement_has_been_done()
    {
        // Aquí puedes probar una mejora específica
        $this->assertTrue(true);
    }
}
