<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TestResourceCollection extends ResourceCollection
{
    public $collects = TestJsonResource::class;
}
