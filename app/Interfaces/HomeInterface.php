<?php

namespace App\Interfaces;

interface HomeInterface
{
    public function indexHomeService(): array;
    public function paginationHomeService(array $request): array;
    public function createHomeService(array $request): array;
    public function updateHomeService(array $request, int $home_id): array;
    public function deleteHomeService(int $home_id): array;
}
