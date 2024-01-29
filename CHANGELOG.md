# Changelog

All notable changes to `elasticsearch-query-dsl-php` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [6.1.0] - 2024-01-29
### Changed
- Renamed namespace `ElasticSearchQueryDSL` -> `ElasticsearchQueryDSL`

## [6.0.0] - 2023-10-25
### Added
- `TermsSetMatcher`
- `WrapperMatcher`
- `AutoIntervalDateHistogramAggregation`
- `CompositeAggregation`
- `ParentAggregation`
- `SignificantTextAggregation`
- `MedianAbsoluteDeviationAggregation`
- `WeightedAvgAggregation`
- `BucketSortAggregation`
- `MovingFunctionAggregation`
- `SourceFilterInterface|array|null` for simplified usage
- `SearchRequestInterface::getParameters`
- `InnerHitsRequestInterface`
- `TopHitsRequestInterface`
- `obj_array_json_serialize` for internal use

### Changed
- Constructor signatures
- Parameter, property, return types
- Renamed `RegexMatcher` to `RegexpMatcher`

### Removed
- GeoDistanceRangeMatcher
- IndicesMatcher
- TemplateMatcher

## [5.0.1] - 2018-11-04
### Added
- Documentation for using RangeMatcher with range mapping type
- Missing option doc for HasChildMatcher

### Fixed
- All properties (including arrays) are now deep cloned

## [5.0.0] - 2018-04-04
### Added
- Initial release
