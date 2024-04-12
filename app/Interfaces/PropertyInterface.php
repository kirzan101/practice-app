<?php

namespace App\Interfaces;

interface PropertyInterface
{
    public function indexPropertyService(): array;
    /* public function showHomeService(): array; */
    public function createPropertyService(array $request): array;
    public function updatePropertyService(array $request, int $property_id): array;
    public function deletePropertyService(int $property_id): array;
}