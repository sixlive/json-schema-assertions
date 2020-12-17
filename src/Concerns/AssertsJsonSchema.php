<?php

namespace sixlive\JsonSchemaAssertions\Concerns;

use sixlive\JsonSchemaAssertions\SchemaAssertion;

trait AssertsJsonSchema
{
    /**
     * @var string
     */
    protected $jsonSchemaAssertionBasePath = '';

    /**
     * @param  string  $path
     * @return void
     */
    public function setJsonSchemaBasePath(string $path): void
    {
        $this->jsonSchemaAssertionBasePath = $path;
    }

    /**
     * @param  array|string  $schema
     * @param  string . $json
     * @return void
     *
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function assertJsonSchema($schema, string $json): void
    {
        (new SchemaAssertion($this->jsonSchemaAssertionBasePath))
            ->schema($schema)
            ->assert($json);
    }
}
