<?php

namespace Tests\Unit\App\Http\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\ListTasksRequest;

class ListTasksRequestTest extends TestCase
{
    use RefreshDatabase; // Uncomment if your test interacts with the database

    public function test_it_validates_according_to_rules()
    {
        $request = new ListTasksRequest([
            'page' => 'invalid_value',
            'per_page' => 'another_invalid_value',
        ]);

        $validator = validator($request->toArray(), $request->rules());

        $this->assertTrue($validator->fails());

        $this->assertArrayHasKey('page', $validator->errors()->toArray());
        $this->assertArrayHasKey('per_page', $validator->errors()->toArray());
    }

    public function test_it_allows_empty_values_for_optional_fields()
    {
        $request = new ListTasksRequest();

        $validator = validator($request->toArray(), $request->rules());

        $this->assertFalse($validator->fails()); // Assert validation passes
    }

    public function test_it_validates_integer_values_for_page_and_per_page()
    {
        $request = new ListTasksRequest([
            'page' => 1,
            'per_page' => 10,
        ]);

        $validator = validator($request->toArray(), $request->rules());

        $this->assertFalse($validator->fails()); // Assert validation passes
    }
}
