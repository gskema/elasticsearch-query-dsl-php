<?php

namespace Gskema\ElasticsearchQueryDSL\Suggester;

use Gskema\ElasticsearchQueryDSL\Options;
use Gskema\ElasticsearchQueryDSL\Suggester\ContextQuery\ContextQueryInterface;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/suggester-context.html
 * @see ContextSuggesterTest
 */
#[Options([
    'gram_size' => 3,
    'real_word_error_likelihood' => 0.95,
    'confidence' => 1.0,
    'max_errors' => 1.0,
    'separator' => ' ',
    'size' => 5,
    'analyzer' => 'standard',
    'shard_size' => 5,
    'highlight' => ['pre_tag' => '<em>', 'post_tag' => '</em>'],
    'smoothing' => ['stupid_backoff' => ['discount' => 0.4]],
                   // ['laplace' => ['alpha ' => 0.5]],
                   // ['linear_interpolation' => ['trigram_lambda' => '?', 'bigram_lambda' => '?', 'unigram_lambda' => '?']],
])]
class ContextSuggester extends CompletionSuggester
{
    /** @var ContextQueryInterface[] */
    protected array $contexts = [];

    public function __clone()
    {
        $this->contexts = array_clone($this->contexts);
    }

    /**
     * @return ContextQueryInterface[]
     */
    public function getContexts(): array
    {
        return $this->contexts;
    }

    public function getContext(string $contextName): ?ContextQueryInterface
    {
        return $this->contexts[$contextName] ?? null;
    }

    /**
     * @param ContextQueryInterface[] $queriesByContextName
     */
    public function setContexts(array $queriesByContextName): static
    {
        $this->contexts = $queriesByContextName;
        return $this;
    }

    public function setContext(string $contextName, ContextQueryInterface $query): static
    {
        $this->contexts[$contextName] = $query;
        return $this;
    }

    public function removeContext(string $contextName): static
    {
        unset($this->contexts[$contextName]);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = parent::jsonSerialize();

        if (!empty($this->contexts)) {
            $body['completion']['contexts'] = obj_array_json_serialize($this->contexts);
        }

        return $body;
    }
}
