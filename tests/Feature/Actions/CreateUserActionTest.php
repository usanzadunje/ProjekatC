<?php

namespace Tests\Feature\Actions;

use App\Actions\User\CreateUserAction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function setUp(): void {
        parent::setUp();

        $this->createUserAction = new CreateUserAction();
    }

    /**
     * Test that checks if user can be created using CreateUserAction
     *
     * @return void
     */
    public function test_can_create_new_user() {
        $userData = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->firstName(),
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
        ];

        $user = $this->createUserAction->handle($userData);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }
}
