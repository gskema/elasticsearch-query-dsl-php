<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-ids-query.html
 * @see IdsMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class IdsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        /** @var string[] */
        protected array $ids,
        protected ?string $type = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['values'] = $this->ids;
        if (null !== $this->type) {
            $body['type'] = $this->type;
        }
        $body += $this->options;

        return [
            'ids' => $body,
        ];
    }
}
