<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-terms-query.html#query-dsl-terms-lookup
 * @see LookupTermsMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class LookupTermsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected string $field,
        protected string $index,
        protected string $type,
        protected string $id,
        protected string $path,
        protected ?string $routing = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body[$this->field] = [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $this->id,
            'path' => $this->path,
        ];
        if (null !== $this->routing) {
            $body[$this->field]['routing'] = $this->routing;
        }
        $body += $this->options;

        return [
            'terms' => $body,
        ];
    }
}
