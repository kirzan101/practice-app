<?php

namespace App\Traits;

use App\Models\Home;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Exception;

trait ReturnModelTrait
{
    public function returnModel(mixed $status, string $message = null, ?Model $model = null): array
    {
        $return_values = [
            'result' => $model,
            'status' => $status,
            'message' => $message
        ];

        return $return_values;
    }
}