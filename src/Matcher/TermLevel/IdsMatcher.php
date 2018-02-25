<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-ids-query.html
 * @see IdsMatcherTest
 *
 * @options '_name' => '?',
 */
class IdsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string[] */
    protected $ids;

    /** @var string|null */
    protected $type;

    /**
     * @param string[]    $ids
     * @param string|null $type
     */
    public function __construct(array $ids, string $type = null)
    {
        $this->ids = $ids;
        $this->type = $type;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
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
