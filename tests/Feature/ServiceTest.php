<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ServiceTest extends TestCase
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

    private function createService(): Service
    {
        return Service::factory()->create([
            'name' => 'Cleaning Service',
            'status' => 'active',
            'price' => 100
        ]);
    }

    private function checkAuthentication(User $user): void
    {
        Sanctum::actingAs($user, ['*']);
    }

    public function test_service_validation_error_while_creating(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $this->postJson('api/services', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'status', 'price']);
    }

    public function test_service_unique_name_validation_error_while_creating(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $this->createService();

        $this->postJson('api/services', [
                'name' => 'Cleaning Service',
                'status' => 'active',
                'price' => 100
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }

    public function test_service_successfully_created(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $this->postJson('api/services', [
                'name' => 'Cleaning Service',
                'status' => 'active',
                'price' => 100
            ])
            ->assertCreated()
            ->assertJsonStructure(['successMessage', 'statusCode', 'data']);
    }

    public function test_read_all_services(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $this->getJson('api/services')->assertOk()
            ->assertJsonStructure(['successMessage', 'statusCode', 'data']);
    }

    public function test_service_validation_error_while_updating(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $service = $this->createService();

        $this->putJson('api/services/' . $service->id, [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'status', 'price']);
    }

    public function test_service_successfully_updated(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $service = $this->createService();

        $this->putJson('api/services/' . $service->id, [
                'name' => 'Cleaning Service Updated',
                'status' => 'active',
                'price' => 1000
            ])
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'statusCode', 'data']);
    }

    public function test_service_not_found_error(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $this->deleteJson('api/services/100')
            ->assertNotFound()
            ->assertJsonStructure(['errorMessage', 'statusCode', 'data']);
    }

    public function test_service_deleted_successfully(): void
    {
        $this->checkAuthentication($this->createAdminUser());

        $service = $this->createService();

        $this->deleteJson('api/services/' . $service->id)
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'statusCode', 'data']);
    }
}
