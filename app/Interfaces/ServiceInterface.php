<?php

namespace App\Interfaces;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;

interface ServiceInterface
{
    public function all(): Builder;

    public function fetch(int $id): Service | NULL;

    public function create(array $serviceData): Service;

    public function update(int $id, array $updatedServiceData): bool;

    public function delete(int $id): bool;
}