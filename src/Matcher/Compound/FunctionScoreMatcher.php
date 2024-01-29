<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;
use Gskema\ElasticsearchQueryDSL\ScoreFunction\ScoreFunctionInterface;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;

use function Gskema\ElasticsearchQueryDSL\array_clone;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html
 * @see FunctionScoreMatcherTest
 */
#[Options([
    'boost' => 5.0,
    'max_boost' => 2000,
    'score_mode' => 'multiply', // 'sum', 'avg', 'first', 'max', 'min',
    'boost_mode' => 'multiply', // 'replace', 'sum', 'avg', 'max', 'min',
    'min_score' => 1.0,
    '_name' => '?',
])]
class FunctionScoreMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var mixed[][] */
    protected array $functions = [];

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected ?MatcherInterface $query = null,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->query = $this->query ? clone $this->query : null;
        $this->functions = array_clone($this->functions);
    }

    public function addScoreFunction(
        ScoreFunctionInterface $function,
        ?MatcherInterface $filter = null,
        ?int $weight = null,
    ): static {
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
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
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
