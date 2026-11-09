<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeveloppeurTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_shows_languages_from_database(): void
    {
        $this->get(route('developpeurs.create'))->assertOk()->assertSee('Java')->assertSee('PHP');
    }

    public function test_developer_can_register(): void
    {
        $this->post(route('developpeurs.store'), ['nomPrenom' => 'Jean Dupont', 'langages' => ['Java', 'PHP']])
            ->assertRedirect(route('developpeurs.create'));

        $this->assertDatabaseHas('developpeur_web', ['nomPrenom' => 'Jean Dupont']);
    }

    public function test_name_without_space_and_unknown_language_are_rejected(): void
    {
        $this->post(route('developpeurs.store'), ['nomPrenom' => 'Jean', 'langages' => ['Cobol']])
            ->assertSessionHasErrors(['nomPrenom', 'langages.0']);

        $this->assertDatabaseCount('developpeur_web', 0);
    }
}
