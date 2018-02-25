<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery\ContextQueryInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/suggester-context.html
 * @see ContextSuggesterTest
 *
 * @options 'gram_size' => 3,
 *          'real_word_error_likelihood' => 0.95,
 *          'confidence' => 1.0,
 *          'max_errors' => 1.0,
 *          'separator' => ' ',
 *          'size' => 5,
 *          'analyzer' => 'standard',
 *          'shard_size' => 5,
 *          'highlight' => ['pre_tag' => '<em>', 'post_tag' => '</em>']
 *          'smoothing' => ['stupid_backoff' => ['discount' => 0.4]],
 *                         ['laplace' => ['alpha ' => 0.5]],
 *                         ['linear_interpolation' => ['trigram_lambda' => ?, 'bigram_lambda' => ?, 'unigram_lambda' => ?]],
 */
class ContextSuggester extends CompletionSuggester
{
    /** @var ContextQueryInterface[] */
    protected $contexts = [];

    /**
     * @return ContextQueryInterface[]
     */
    public function getContexts(): array
    {
        return $this->contexts;
    }

    /**
     * @param string $contextName
     *
     * @return ContextQueryInterface|null
     */
    public function getContext(string $contextName)
    {
        return $this->contexts[$contextName] ?? null;
    }

    /**
     * @param ContextQueryInterface[] $queriesByContextName
     *
     * @return $this
     */
    public function setContexts(array $queriesByContextName): ContextSuggester
    {
        $this->contexts = $queriesByContextName;

        return $this;
    }

    /**
     * @param string                $contextName
     * @param ContextQueryInterface $query
     *
     * @return ContextSuggester
     */
    public function setContext(string $contextName, ContextQueryInterface $query): ContextSuggester
    {
        $this->contexts[$contextName] = $query;

        return $this;
    }

    /**
     * @param string $contextName
     *
     * @return $this
     */
    public function removeContext(string $contextName): ContextSuggester
    {
        unset($this->contexts[$contextName]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = parent::jsonSerialize();

        if (!empty($this->contexts)) {
            $body['completion']['contexts'] = array_map(function (ContextQueryInterface $query) {
                return $query->jsonSerialize();
            }, $this->contexts);
        }

        return $body;
    }
}
