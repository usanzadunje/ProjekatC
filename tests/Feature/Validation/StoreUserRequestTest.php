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
     * @test
     * @dataProvider firstNameValidation
     * @dataProvider lastNameValidation
     * @dataProvider usernameValidation
     * @dataProvider emailValidation
     * @dataProvider passwordValidation
     */
    public function test_test_validation_rules($getData) {
        [$field, $value, $filedShouldPassValidation] = $getData();

        if($filedShouldPassValidation) {
            $this->assertTrue($this->validateField($field, $value));
        }else {
            $this->assertFalse($this->validateField($field, $value));
        }
    }

    public function firstNameValidation() {
        return [
            'passes if first_name is empty' => [fn() => ['first_name', '', true]],
            'passes if first_name is not empty' => [fn() => ['first_name', 'John', true]],
            'fails if first_name contains dashes' => [fn() => ['first_name', 'John-', false]],
            'fails if first_name contains numbers' => [fn() => ['first_name', 'John1', false]],
            'fails if first_name is larger than 100 chars' => [fn() => ['first_name', str_repeat('a', 101), false]],
        ];
    }

    public function lastNameValidation() {
        return [
            'passes if last_name is empty' => [fn() => ['last_name', '', true]],
            'passes if last_name is not empty' => [fn() => ['last_name', 'Doe', true]],
            'fails if last_name contains dashes' => [fn() => ['last_name', 'Doe-', false]],
            'fails if last_name contains numbers' => [fn() => ['last_name', 'Doe1', false]],
            'fails if last_name is larger than 100 chars' => [fn() => ['last_name', str_repeat('a', 101), false]],
        ];
    }

    public function usernameValidation() {
        return [
            'passes if username is empty' => [fn() => ['username', '', true]],
            'passes if username is not empty' => [fn() => ['username', 'johndoe', true]],
            'passes if username is string containing different char types' => [fn() => ['username', '1-_.', true]],
            'fails if username is number' => [fn() => ['username', 123, false]],
            'fails if username is less than 2 chars' => [fn() => ['username', str_repeat('a', 2), false]],
            'fails if username is larger that 100 chars' => [fn() => ['username', str_repeat('a', 101), false]],
            'fails if username is not unique' => [fn() => ['username', User::factory()->create()->username, false]],
        ];
    }

    public function emailValidation() {
        return [
            'passes if email valid email' => [fn() => ['email', 'john@doe.com', true]],
            'fails if email is not valid email' => [fn() => ['email', 'john@', false]],
            'fails if email is empty' => [fn() => ['email', '', false]],
            'fails if email is larger than 255 chars' => [fn() => ['email', str_repeat('a', 246) . '@email.com', false]],
            'fails if email is not unique' => [fn() => ['email', User::factory()->create()->email, false]],
        ];
    }

    public function passwordValidation() {
        return [
            'passes if password is not empty' => [fn() => ['password', 'password', true]],
            'fails if password is less than 3 chars' => [fn() => ['password', str_repeat('a', 2), false]],
            'fails if password is empty' => [fn() => ['password', '', false]],
        ];
    }
}
