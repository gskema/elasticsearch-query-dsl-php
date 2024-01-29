<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-percolate-query.html
 * @see PercolateMatcherTest
 */
#[Options([
    'routing' => '?',
    'preference' => '?',
    'version' => 2,
    'name' => 'query1',
    '_name' => '?',
])]
class PercolateMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        /** @var mixed[] */
        protected array $body,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @param mixed[][] $docSources
     * @param array<string, mixed> $options
     */
    public static function fromDocSources(
        string $queryField,
        array $docSources,
        array $options = [],
    ): static {
        $body = [
            'field' => $queryField,
            'documents' => $docSources,
        ];

        return new static($body, $options);
    }

    /**
     * @param mixed[] $docSource
     * @param array<string, mixed> $options
     */
    public static function fromDocSource(
        string $queryField,
        array $docSource,
        array $options = [],
    ): static {
        $body = [
            'field' => $queryField,
            'document' => $docSource,
        ];

        return new static($body, $options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromIndexedDoc(
        string $queryField,
        string $index,
        string $type,
        string $id,
        array $options = [],
    ): static {
        $body = [
            'field' => $queryField,
            'index' => $index,
            'type' => $type,
            'id' => $id,
        ];

        return new static($body, $options);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = $this->body;
        $body += $this->options;

        return [
            'percolate' => $body,
        ];
    }
}
