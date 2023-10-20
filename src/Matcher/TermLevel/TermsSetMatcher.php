<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-terms-set-query.html
 * @see TermsSetMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class TermsSetMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        /** @var string[]|float[]|int[]|bool[]|null[] */
        protected array $values,
        protected string|ScriptInterface $msmFieldOrScript,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        if (is_object($this->msmFieldOrScript)) {
            $this->msmFieldOrScript = clone $this->msmFieldOrScript;
        }
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body[$this->field] = [
            'terms' => $this->values,
        ];
        if ($this->msmFieldOrScript instanceof ScriptInterface) {
            $body[$this->field]['minimum_should_match_script'] = $this->msmFieldOrScript->jsonSerialize();
        } else {
            $body[$this->field]['minimum_should_match_field'] = $this->msmFieldOrScript;
        }
        $body += $this->options;

        return [
            'terms_set' => $body,
        ];
    }
}
