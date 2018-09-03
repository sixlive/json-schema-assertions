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
    public function setJsonSchemaBasePath($path)
    {
        $this->jsonSchemaAssertionBasePath = $path;
    }

    /**
     * @param  mixex  $schema
     * @param  string . $json
     * @return void
     *
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function assertJsonSchema($schema, $json)
    {
        (new SchemaAssertion($this->jsonSchemaAssertionBasePath))
            ->schema($schema)
            ->assert($json);
    }
}
