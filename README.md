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
- Fully extendable and composable classes
- All configuration options are listed inside classes
- Explicit naming

## Install

Via Composer

``` bash
composer require gskema/elasticsearch-query-dsl-php
```

## Usage

``` php
$searchRequest = new Gskema\ElasticSearchQueryDSL\SearchRequest();
$searchRequest->setQuery(new MatchAllMatcher());
$searchRequest->addStatGroup('stat_group_1');

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
