<?php

namespace App\Repositories;

use App\Interfaces\ServiceInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;

class ServiceRepository implements ServiceInterface
{
    /**
     * Fetch all services.
     * 
     * @return Builder
     */
    public function all(): Builder
    {
        return User::query()->orderBy('id', 'DESC');
    }

    /**
     * Fetch a service by ID.
     * 
     * @return Service|null
     */
    public function fetch(int $id): Service | NULL
    {
        return Service::query()->where('id', $id)->first();
    }

    /**
     * Create a new service.
     * 
     * @return Service
     */
    public function create(array $serviceData): Service
    {
        return Service::query()->create($serviceData);
    }

    /**
     * Update an existing service.
     * 
     * @return bool
     */
    public function update(int $id, array $serviceData): bool
    {
        return Service::query()->where('id', $id)->update($serviceData);
    }

    /**
     * Delete a service.
     * 
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Service::query()->where('id', $id)->delete();
    }

}