<?php

namespace sixlive\JsonSchemaAssertions;

use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\InvalidValue;
use PHPUnit\Framework\Assert as PHPUnit;
use sixlive\JsonSchemaAssertions\Support\Str;

class SchemaAssertion
{
    /**
     * @var \Swaggest\JsonSchema\JsonSchema
     */
    protected $schema;

    /**
     * @var string
     */
    protected $baseSchemaPath = '';

    /**
     * @param . string . $baseSchemaPath
     */
    public function __construct($baseSchemaPath = '')
    {
        $this->baseSchemaPath = $baseSchemaPath;
    }

    /**
     * @param . mixed . $schema
     * @return void
     */
    public function schema($schema)
    {
        if (is_array($schema)) {
            $schema = json_encode($schema);
        }

        if ($this->isJson($schema)) {
            $schema = json_decode($schema);
        }

        if ($this->isFileFromConfigPath($schema)) {
            $schema = $this->mergeConfigPath($schema);
        }

        $this->schema = Schema::import($schema);

        return $this;
    }

    /**
     * @param  string  $data
     * @return void
     *
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function assert(string $data)
    {
        try {
            $this->schema->in(json_decode($data));
        } catch (InvalidValue $e) {
            PHPUnit::fail($e->getMessage());
        }

        PHPUnit::assertTrue(true);
    }

    /**
     * @param  mixed  $schema
     * @return bool
     */
    private function isJson($schema)
    {
        return is_string($schema) && Str::isJson($schema);
    }

    /**
     * @param  mixed  $schema
     * @return bool
     */
    private function isFileFromConfigPath($schema)
    {
        return is_string($schema)
            && file_exists($this->mergeConfigPath($schema));
    }

    /**
     * @param  string  $schema
     * @return string
     */
    private function mergeConfigPath($schema)
    {
        return vsprintf('%s/%s.json', [
            $this->baseSchemaPath,
            $schema,
        ]);
    }
}
