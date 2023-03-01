<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestJsonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'c1' => $this->c1,
            'c2' => $this->c2,
            'c3' => $this->c3,
        ];
    }
}
