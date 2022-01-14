<?php

namespace Tests\Feature\Controllers;

use Inertia\Testing\AssertableInertia as Assert;
use App\Models\User;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function setUp(): void {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->staff = User::factory()->staff()->create();
        $this->regular = User::factory()->create();
    }

    /**
     * Tests if admin user is redirected to admin dashboard page.
     *
     * @test
     */
    public function test_home_page_redirects_admin_to_admin_dashboard() {
        $response = $this
            ->actingAs($this->admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Dashboard/Admin')
        );
    }

    /**
     * Tests if admin user is redirected back from staff dashboard route.
     *
     * @test
     */
    public function admin_cannot_access_staff_dashboard() {
        $response = $this
            ->actingAs($this->admin)
            ->get(route('staff.dashboard'));

        $response->assertStatus(302);
    }

    /**
     * Tests if admin user is redirected back from regular dashboard route.
     *
     * @test
     */
    public function admin_cannot_access_regular_dashboard() {
        $response = $this
            ->actingAs($this->admin)
            ->get(route('regular.dashboard'));

        $response->assertStatus(302);
    }

    /**
     * Tests if staff user is redirected to staff dashboard page.
     *
     * @test
     */
    public function test_home_page_redirects_staff_to_staff_dashboard() {
        $response = $this
            ->actingAs($this->staff)
            ->get(route('staff.dashboard'));

        $response->assertStatus(200);
        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Dashboard/Staff')
        );
    }

    /**
     * Tests if staff user is redirected back from admin dashboard route.
     *
     * @test
     */
    public function staff_cannot_access_admin_dashboard() {
        $response = $this
            ->actingAs($this->staff)
            ->get(route('admin.dashboard'));

        $response->assertStatus(302);
    }

    /**
     * Tests if staff user is redirected back from regular dashboard route.
     *
     * @test
     */
    public function staff_cannot_access_regular_dashboard() {
        $response = $this
            ->actingAs($this->staff)
            ->get(route('regular.dashboard'));

        $response->assertStatus(302);
    }

    /**
     * Tests if regular is redirected to regular dashboard page.
     *
     * @test
     */
    public function test_home_page_redirects_regular_to_regular_dashboard() {
        $response = $this
            ->actingAs($this->regular)
            ->get(route('regular.dashboard'));

        $response->assertStatus(200);
        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Dashboard/Regular')
        );
    }

    /**
     * Tests if regular is redirected back from admin dashboard route.
     *
     * @test
     */
    public function regular_cannot_access_admin_dashboard() {
        $response = $this
            ->actingAs($this->regular)
            ->get(route('admin.dashboard'));

        $response->assertStatus(302);
    }

    /**
     * Tests if regular is redirected back from staff dashboard route.
     *
     * @test
     */
    public function user_cannot_access_staff_dashboard() {
        $response = $this
            ->actingAs($this->regular)
            ->get(route('staff.dashboard'));

        $response->assertStatus(302);
    }
}
