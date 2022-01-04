<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LetterListTest extends TestCase
{

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_unauthenticated_user_can_not_see_letters_list_screen()
    {
        $response = $this->get('/letters');

        $response->assertRedirect("/login");
    }

    /**
     * test an authenticated user can see letters list
     * @return void'
     */
    public function test_an_authenticated_user_can_see_letters_list_screen()
    {
        $this->signIn();

        $response = $this->get('/letters');

        $response->assertStatus(200);
    }
}
