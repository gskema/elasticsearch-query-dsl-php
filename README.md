# ElasticSearch Query DSL

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-build]][link-build]
[![Coverage Status][ico-coverage]][link-build]
[![Total Downloads][ico-downloads]][link-downloads]

Feature complete, object oriented, composable, extendable ElasticSearch query DSL builder for PHP.

## Features

- Dependency free
- Can be used with any PHP ElasticSearch client
- Fully interfaced, ready for custom classes
- Explicit class and property naming, fully matches produced JSON and ElasticSearch docs
- All configuration options are listed inside classes, links to documentation
- Classes can be easily composed, extended
- Design that is easy to test and maintain
- Usage of setters/getters so that everything can be inlined and chained.
- Fully working `::__clone()` methods
- Extendable code: no usage of `private`, `final` or `readonly`
- Basic objects created on `__construct`, no unnecessary body build logic until `jsonSerialize()` is called

## Versions

Most of the classes should be compatible with any ElasticSearch versions.
If something is not compatible or not supported, `Raw*` or custom classes can be used.

| Package version | ElasticSearch version |
|-----------------|-----------------------|
| >=6.0.0 <7.0.0  | >=6.0.0 <7.0.0        |
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

## Matcher?

Request object that is received by ElasticSearch `/_search/` has many properties and sub-properties
like `query`, `filter`, `post_filter`, etc.

To avoid convoluted expressions like `(new SearchRequest())->setQuery((new BoolQuery()->addFilter(new TermQuery('))`
keyword `matcher` was explicitly chosen.

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
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-build]: https://img.shields.io/github/actions/workflow/status/gskema/elasticsearch-query-dsl-php/ci.yml?branch=6.x
[ico-coverage]: https://raw.githubusercontent.com/gskema/elasticsearch-query-dsl-php/image-data/badge.svg
[ico-downloads]: https://img.shields.io/packagist/dt/gskema/elasticsearch-query-dsl-php.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/gskema/elasticsearch-query-dsl-php
[link-build]: https://github.com/gskema/elasticsearch-query-dsl-php/actions
[link-downloads]: https://packagist.org/packages/gskema/elasticsearch-query-dsl-php
