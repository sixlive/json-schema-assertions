# JSON Schema Assertions

[![Packagist Version](https://img.shields.io/packagist/v/sixlive/json-schema-assertions.svg?style=flat-square)](https://packagist.org/packages/sixlive/json-schema-assertions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/sixlive/json-schema-assertions.svg?style=flat-square)](https://packagist.org/packages/sixlive/json-schema-assertions)
[![Travis](https://img.shields.io/travis/sixlive/json-schema-assertions.svg?style=flat-square)](https://travis-ci.org/sixlive/json-schema-assertions)
[![Code Quality](https://img.shields.io/scrutinizer/g/sixlive/json-schema-assertions.svg?style=flat-square)](https://scrutinizer-ci.com/g/sixlive/json-schema-assertions/)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/sixlive/json-schema-assertions.svg?style=flat-square)](https://scrutinizer-ci.com/g/sixlive/json-schema-assertions/)
[![StyleCI](https://github.styleci.io/repos/147207965/shield)](https://github.styleci.io/repos/147207965)

JSON Schema schema assertions for PHP. Uses [swaggest/php-json-schema](https://github.com/swaggest/php-json-schema) under the hood.

## Framework Integrations

* [Laravel](https://github.com/sixlive/laravel-json-schema-assertions)

## Installation

You can install the package via composer:

```bash
> composer require --dev sixlive/json-schema-assertions
```

## Usage

If you are making use of external schema refrences e.g. `$ref: 'bar.json`, you must reference the schema through file path or using the config path resolution.

```
├── schemas
│   ├── bar.json
│   └── foo.json
```

You can either use the `AssertsJsonSchema` trait or manually construct the schema assertion.

```php
use sixlive\JsonSchemaAssertions\Concerns\AssertJsonSchema;

class ExampleTest extends TestCase
{
    use AssertsJsonSchema;

    public function setUp()
    {
        parent::setUp();

        $this->setJsonSchemaBasePath(__DIR__.'/../Schemas');
    }

    /** @test */
    function it_has_a_valid_response()
    {
        $this->schemaAssertion
            ->schema('foo')
            ->assert('{"foo": "bar"}');
    }
}
```

```php
/** @test */
public function it_has_a_valid_response()
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

    // Schema as an array
    (new SchemaAssertion)->schema($schema)->assert('{"foo": "bar"}');

    // Schema from raw JSON
    (new SchemaAssertion)->schema(json_encode($schema))->assert('{"foo": "bar"}');

    // Schema from a file
    (new SchemaAssertion)->schema(__DIR__.'/../schemas/foo.json'))
        ->assert('{"foo": "bar"}');

    // Remote schema
    (new SchemaAssertion)->schema('https://docs.foo.io/schemas/foo.json')
        ->assert('{"foo": "bar"}')

    // Schema from a path
    (new SchemaAssertion(__DIR__.'/../schemas/'))
        ->schema('foo')
        ->assert('{"foo": "bar"}');
}
```

## Testing

``` bash
> composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Code Style
In addition to the php-cs-fixer rules, StyleCI will apply the [Laravel preset](https://docs.styleci.io/presets#laravel).

### Linting
```bash
> composer styles:lint
```

### Fixing
```bash
> composer styles:fix
```

## Security

If you discover any security related issues, please email oss@tjmiller.co instead of using the issue tracker.

## Credits

- [TJ Miller](https://github.com/sixlive)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
