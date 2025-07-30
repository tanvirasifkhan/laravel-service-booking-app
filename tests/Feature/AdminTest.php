<?php

namespace Tests\Feature;

use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    
    private function createAdminUser(): User
    {
        return User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }

    public function test_email_validation_error_while_login(): void
    {
        $credentials = [
            'email' => '',
            'password' => 'password',
        ];

        $this->postJson('api/admins/login', $credentials)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_password_validation_error_while_login(): void
    {        
        $credentials = [
            'email' => 'email@gmail.com',
            'password' => '',
        ];

        $this->postJson('api/admins/login', $credentials)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function test_wrong_email_address_error_while_login(): void
    {  
        $this->createAdminUser();

        $credentials = [
            'email' => 'email@gmail.com',
            'password' => 'password',
        ];

        $this->postJson('api/admins/login', $credentials)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_wrong_credentials_error_while_login(): void
    {  
        $this->createAdminUser();

        $credentials = [
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ];

        $this->postJson('api/admins/login', $credentials)
            ->assertUnprocessable()
            ->assertJsonStructure(['errorMessage', 'data', 'statusCode']);
    }

    public function test_successfull_login(): void
    {  
        $this->createAdminUser();

        $credentials = [
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ];

        $this->postJson('api/admins/login', $credentials)
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }

    public function test_successfull_logout(): void
    {
        Sanctum::actingAs($this->createAdminUser(), ['*']);

        $this->postJson('api/admins/logout')
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }

    public function test_read_all_admin_booking_list(): void
    {
        Sanctum::actingAs($this->createAdminUser(), ['*']);

        $this->getJson('api/admins/bookings')
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }
}
