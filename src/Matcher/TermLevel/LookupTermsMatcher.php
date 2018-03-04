<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-terms-query.html#query-dsl-terms-lookup
 * @see LookupTermsMatcherTest
 *
 * @options '_name' => '?',
 */
class LookupTermsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $index;

    /** @var string */
    protected $type;

    /** @var string */
    protected $id;

    /** @var string */
    protected $path;

    /** @var string|null */
    protected $routing = null;

    public function __construct(
        string $field,
        string $index,
        string $type,
        string $id,
        string $path,
        string $routing = null
    ) {
        $this->field = $field;
        $this->index = $index;
        $this->type = $type;
        $this->id = $id;
        $this->path = $path;
        $this->routing = $routing;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
