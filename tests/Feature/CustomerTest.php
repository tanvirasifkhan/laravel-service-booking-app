<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    private function createCustomer(): Customer
    {
        return Customer::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'phone' => '1234567890',
            'password' => bcrypt('john')
        ]);
    }

    public function test_customer_registration_validation_error(): void
    {
        $this->postJson('api/customers/register', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'password']);
    }

    public function test_customer_registration_unique_email_validation_error(): void
    {
        $this->createCustomer();

        $customerData = [
            'name' => 'New Customer',
            'email' => 'john.doe@gmail.com',
            'phone' => '36544689565',
            'password' => 'password'
        ];

        $this->postJson('api/customers/register', $customerData)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_customer_registration_unique_phone_validation_error(): void
    {
        $this->createCustomer();

        $customerData = [
            'name' => 'New Customer',
            'email' => 'john.doe2@gmail.com',
            'phone' => '1234567890',
            'password' => 'password'
        ];

        $this->postJson('api/customers/register', $customerData)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['phone']);
    }

    public function test_customer_successfull_registration(): void
    {
        $customerData = [
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'phone' => '12345678910',
            'password' => 'john'
        ];

        $this->postJson('api/customers/register', $customerData)
            ->assertCreated()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }

    public function test_customer_validation_error_while_login(): void
    {
        $this->postJson('api/customers/login', ['email' => '', 'password' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_customer_wrong_email_while_login(): void
    {
        $this->createCustomer();

        $this->postJson('api/customers/login', ['email' => 'john.doe2@gmail.com', 'password' => 'password'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_customer_wrong_credentials_while_login(): void
    {
        $this->createCustomer();

        $this->postJson('api/customers/login', ['email' => 'john.doe@gmail.com', 'password' => 'password123'])
            ->assertUnprocessable()
            ->assertJsonStructure(['errorMessage', 'data', 'statusCode']);
    }

    public function test_customer_successfull_login(): void
    {
        $this->createCustomer();

        $this->postJson('api/customers/login', ['email' => 'john.doe@gmail.com', 'password' => 'john'])
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }

    public function test_customer_successfull_loggedout(): void
    {
        Sanctum::actingAs($this->createCustomer(), ['*']);

        $this->postJson('api/customers/logout')
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }

    public function test_read_all_customer_booking_list(): void
    {
        Sanctum::actingAs($this->createCustomer(), ['*']);

        $this->getJson('api/customers/bookings')
            ->assertOk()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }

    public function test_validation_error_while_creating_booking(): void
    {
        Sanctum::actingAs($this->createCustomer(), ['*']);

        $this->postJson('api/customers/bookings', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['date', 'service_id', 'status']);
    }

    public function test_successfully_creating_booking(): void
    {
        Sanctum::actingAs($this->createCustomer(), ['*']);

        $service = Service::factory()->create();

        $this->postJson('api/customers/bookings', [
                'date' => '2023-10-01',
                'service_id' => $service->id,
                'status' => 'confirmed'
            ])
            ->assertCreated()
            ->assertJsonStructure(['successMessage', 'data', 'statusCode']);
    }
}
