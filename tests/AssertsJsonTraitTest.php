<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use sixlive\JsonSchemaAssertions\Concerns\AssertsJsonSchema;

class AssertsJsonTraitTest extends TestCase
{
    use AssertsJsonSchema;

    public function setUp(): void
    {
        parent::setUp();

        $this->setJsonSchemaBasePath(__DIR__.'/Support/Schemas');
    }

    /** @test */
    public function trait_can_be_used_to_assert_json()
    {
        $this->assertJsonSchema('foo', '{ "foo": "bar" }');
    }
}
