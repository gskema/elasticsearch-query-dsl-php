<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\ScoreFunction\ScoreFunctionInterface;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-function-score-query.html
 * @see FunctionScoreMatcherTest
 *
 * @options 'boost' => 5.0,
 *          'max_boost' => 2000,
 *          'score_mode' => 'multiply', 'sum', 'avg', 'first', 'max', 'min',
 *          'boost_mode' => 'multiply', 'replace', 'sum', 'avg', 'max', 'min',
 *          'min_score' => 1.0,
 *          '_name' => '?',
 */
class FunctionScoreMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var MatcherInterface */
    protected $query;

    /** @var array[] */
    protected $functions = [];

    public function __construct(MatcherInterface $query = null, array $options = [])
    {
        $this->query = $query;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->query = $this->query ? clone $this->query : null;
    }

    /**
     * @param ScoreFunctionInterface $function
     * @param MatcherInterface|null  $filter
     * @param int|null               $weight
     *
     * @return $this
     */
    public function addScoreFunction(
        ScoreFunctionInterface $function,
        MatcherInterface $filter = null,
        int $weight = null
    ): FunctionScoreMatcher {
        $rawFunction = [];
        $rawFunction['_function'] = $function;
        if (null !== $filter) {
            $rawFunction['filter'] = $filter;
        }
        if (null !== $weight) {
            $rawFunction['weight'] = $weight;
        }
        $this->functions[] = $rawFunction;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        if (null !== $this->query) {
            $body['query'] = $this->query->jsonSerialize();
        }
        $body += $this->options;

        if (1 === count($this->functions) && 1 === count($this->functions[0])) {
            $body += $this->functions[0]['_function']->jsonSerialize();
        } else {
            $body['functions'] = array_map(function (array $props) {
                $rawProps = $props['_function']->jsonSerialize();
                if (isset($props['filter'])) {
                    $rawProps['filter'] = $props['filter']->jsonSerialize();
                }
                if (isset($props['weight'])) {
                    $rawProps['weight'] = $props['weight'];
                }
                return $rawProps;
            }, $this->functions);
        }

        return [
            'function_score' => $body,
        ];
    }
}
