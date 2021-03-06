# ElasticSearch Query DSL

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Feature complete, object oriented, composable, extendable ElasticSearch query DSL builder for PHP.

## Features

- Dependency free
- Can be used with any PHP ElasticSearch client
- Fully interfaced, ready for custom classes
- Explicit class and property naming, fully matches produced JSON
- All configuration options are listed inside classes, links to documentation
- Classes can be easily composed, extended
- Design that is easy to test and maintain
- Chainable methods
- Fully working `::__clone()` methods

## Versions

Most of the classes should be compatible with any ElasticSearch versions.
If something is not compatible or not supported, `Raw*` or custom classes can be used.

| Package version | ElasticSearch version |
| ----------------| ----------------------|
| >=5.0.0 <6.0.0  | >=5.0.0 <6.0.0        |

Because major version number follows ElasticSearch major version number, second number is reserved for breaking changes.

## Install

``` bash
composer require gskema/elasticsearch-query-dsl-php 5.*
```

## Usage

``` php
$searchRequest = new SearchRequest();
$searchRequest->setOption('min_score', 3.5);
$searchRequest->setSize(10);
$searchRequest->setQuery(
    (new BoolMatcher())->addMustNot(new TermMatcher('field1', 'value1'))
);
$searchRequest->addStatGroup('stat_group_1');
$searchRequest->setAgg(
    'agg1',
    (new FilterAggregation(new MatchAllMatcher()))
        ->setAgg('agg2', TermsAggregation::fromField('field2', 'value2'))
);

(new ElasticSearchClient())->search($searchRequest->jsonSerialize());
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/gskema/elasticsearch-query-dsl-php.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/gskema/elasticsearch-query-dsl-php/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/gskema/elasticsearch-query-dsl-php.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/gskema/elasticsearch-query-dsl-php.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/gskema/elasticsearch-query-dsl-php.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/gskema/elasticsearch-query-dsl-php
[link-travis]: https://travis-ci.org/gskema/elasticsearch-query-dsl-php
[link-scrutinizer]: https://scrutinizer-ci.com/g/gskema/elasticsearch-query-dsl-php/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/gskema/elasticsearch-query-dsl-php
[link-downloads]: https://packagist.org/packages/gskema/elasticsearch-query-dsl-php
[link-contributors]: ../../contributors
