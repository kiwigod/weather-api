<?php

namespace App\Http\Responses;

class InvalidDateResponseBuilder extends AbstractResponseBuilder
{
    public int $status = 422;

    public function transform($data): array
    {
        return [
            'message' => 'Invalid date requested',
            'date' => $data->format('d/m/Y')
        ];
    }
}
