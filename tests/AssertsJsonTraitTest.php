<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use sixlive\JsonSchemaAssertions\Concerns\AssertsJsonSchema;

class AssertsJsonTraitTest extends TestCase
{
    use AssertsJsonSchema;

    /** @test */
    public function trait_can_be_used_to_assert_json()
    {
        $this->setJsonSchemaBasePath(__DIR__.'/Support/Schemas');
        $this->assertJsonSchema('foo', '{ "foo": "bar" }');
    }
}
