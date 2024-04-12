<?php

namespace App\Traits;

use App\Models\Home;
use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

trait ReturnCollectionTrait
{
    public function returnCollection(mixed $status, ?string $message = null, ?Collection $collection): array
    {
        $return_values = [
            'results' => $collection,
            'status' => $status,
            'message' => $message
        ];

        return $return_values;
    }
}