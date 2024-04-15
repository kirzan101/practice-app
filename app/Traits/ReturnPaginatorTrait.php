<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait ReturnPaginatorTrait
{
    public function returnPaginator(mixed $status, ?string $message, ?LengthAwarePaginator $paginator, int $pagination_size): array
    {
        $return_values = [
            'results' => $paginator,
            'status' => $status,
            'message' => $message,
            'pagination_size' => $pagination_size,
        ];
        return $return_values;
    }
}