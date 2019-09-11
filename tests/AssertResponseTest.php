<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use sixlive\JsonSchemaAssertions\SchemaAssertion;

class AssertResponseTest extends TestCase
{
    protected $response;

    public function setUp(): void
    {
        parent::setUp();

        $this->response = json_encode([
            'foo' => 'bar',
        ]);
    }

    /** @test */
    public function valid_schema_passes_as_json()
    {
        $schema = [
             'type' => 'object',
             'properties' => [
               'foo' => [
                 'type' => 'string',
               ],
             ],
             'required' => [
               'foo',
             ],
       ];

        (new SchemaAssertion())
            ->schema(json_encode($schema))
            ->assert($this->response);
    }

    /** @test */
    public function valid_schema_passes_as_array()
    {
        $schema = [
             'type' => 'object',
             'properties' => [
               'foo' => [
                 'type' => 'string',
               ],
             ],
             'required' => [
               'foo',
             ],
       ];

        (new SchemaAssertion())->schema($schema)->assert($this->response);
    }

    /** @test */
    public function valid_schema_passes_as_file_path()
    {
        (new SchemaAssertion())
            ->schema(__DIR__.'/Support/Schemas/foo.json')
            ->assert($this->response);
    }

    /** @test */
    public function invalid_schema_fails_with_message()
    {
        $this->expectException(AssertionFailedError::class);

        $schema = [
             'type' => 'object',
             'properties' => [
               'foo' => [
                 'type' => 'integer',
               ],
             ],
             'required' => [
               'id',
             ],
       ];

        (new SchemaAssertion())
            ->schema(json_encode($schema))
            ->assert($this->response);
    }

    /** @test */
    public function valid_schema_passes_as_config_path()
    {
        (new SchemaAssertion(__DIR__.'/Support/Schemas'))
            ->schema('foo')
            ->assert($this->response);
    }
}
