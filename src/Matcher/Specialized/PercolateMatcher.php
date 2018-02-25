<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-percolate-query.html
 * @see PercolateMatcherTest
 *
 * @options 'routing' => ?,
 *          'preference' => ?
 *          'version' => 2,
 *          '_name' => '?',
 */
class PercolateMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var array */
    protected $body;

    protected function __construct(array $body, array $options = [])
    {
        $this->body = $body;
        $this->options = $options;
    }

    public static function fromDocSource(
        string $queryField,
        string $docType,
        array $docSource,
        array $options = []
    ): PercolateMatcher {
        $body = [
            'field' => $queryField,
            'document_type' => $docType,
            'document' => $docSource,
        ];

        return new static($body, $options);
    }

    public static function fromIndexedDoc(
        string $queryField,
        string $docType,
        string $index,
        string $type,
        string $id,
        array $options = []
    ): PercolateMatcher {
        $body = [
            'field' => $queryField,
            'document_type' => $docType,
            'index' => $index,
            'type' => $type,
            'id' => $id,
        ];

        return new static($body, $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->body;
        $body += $this->options;

        return [
            'percolate' => $body,
        ];
    }
}
