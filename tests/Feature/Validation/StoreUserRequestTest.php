<?php

namespace Tests\Feature\Validation;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\FormRequestTestCase;

class StoreUserRequestTest extends FormRequestTestCase
{
    use WithFaker;

    public function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * Checks all validation possibilities of first_name field.
     *
     * @test
     */
    public function test_first_name_validation_works_in_every_situation() {
        $this->assertTrue($this->validateField('first_name', ''));
        $this->assertTrue($this->validateField('first_name', $this->faker->firstName));
        $this->assertFalse($this->validateField('first_name', $this->faker->randomDigit()));
        $this->assertFalse($this->validateField('first_name', $this->faker->firstName . '-'));
        $this->assertFalse($this->validateField('first_name', str_repeat('a', 101)));
    }

    /**
     * Checks all validation possibilities of last_name field.
     *
     * @test
     */
    public function test_last_name_validation_works_in_every_situation() {
        $this->assertTrue($this->validateField('last_name', ''));
        $this->assertTrue($this->validateField('last_name', $this->faker->firstName));
        $this->assertFalse($this->validateField('last_name', $this->faker->randomDigit()));
        $this->assertFalse($this->validateField('last_name', $this->faker->firstName . '-'));
        $this->assertFalse($this->validateField('last_name', str_repeat('a', 101)));
    }

    /**
     * Checks all validation possibilities of username field.
     *
     * @test
     */
    public function test_username_validation_works_in_every_situation() {
        $this->assertTrue($this->validateField('username', ''));
        $this->assertTrue($this->validateField('username', $this->faker->userName));
        $this->assertTrue($this->validateField('username', '-_.'));
        $this->assertFalse($this->validateField('username', $this->faker->numberBetween(100, 200)));
        $this->assertFalse($this->validateField('username', str_repeat('a', 2)));
        $this->assertFalse($this->validateField('username', str_repeat('a', 101)));
        $this->assertFalse($this->validateField('username', $this->user->username));
    }

    /**
     * Checks all validation possibilities of email field.
     *
     * @test
     */
    public function test_email_validation_works_in_every_situation() {
        $this->assertFalse($this->validateField('email', ''));
        $this->assertFalse($this->validateField('email', $this->faker->firstName));
        $this->assertTrue($this->validateField('email', $this->faker->safeEmail));
        $this->assertFalse($this->validateField('email', str_repeat('a', 256)));
        $this->assertFalse($this->validateField('email', $this->user->email));
    }

    /**
     * Checks all validation possibilities of password field.
     *
     * @test
     */
    public function test_password_validation_works_in_every_situation() {
        $this->assertFalse($this->validateField('password', ''));
        $this->assertFalse($this->validateField('password', str_repeat('a', 2)));
        $this->assertTrue($this->validateField('password', $this->faker->password));
    }
}
