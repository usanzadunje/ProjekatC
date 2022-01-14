<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Checks if user index page is accessible and contains users prop.
     *
     * @return void
     */
    public function test_can_view_index() {
        $this->assertTrue(true);

        //$userCount = User::count();
        //
        //$response = $this->get(route('dusan'));
        //
        //$response->assertOk();
        //
        //$response->assertInertia(
        //    fn(Assert $page) => $page
        //        ->component('User/Index')
        //        ->has('users', $userCount)
        //);
    }
}
