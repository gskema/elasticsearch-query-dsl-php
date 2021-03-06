<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator\CandidateGeneratorInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-suggesters-phrase.html
 * @see PhraseSuggesterTest
 *
 * @options 'gram_size' => 3,
 *          'real_word_error_likelihood' => 0.95,
 *          'confidence' => 1.0,
 *          'max_errors' => 1.0,
 *          'separator' => ' ',
 *          'size' => 5,
 *          'analyzer' => 'standard',
 *          'shard_size' => 5,
 *          'highlight' => ['pre_tag' => '<em>', 'post_tag' => '</em>'],
 *          'smoothing' => ['stupid_backoff' => ['discount' => 0.4]],
 *                         ['laplace' => ['alpha ' => 0.5]],
 *                         ['linear_interpolation' => ['trigram_lambda' => ?, 'bigram_lambda' => ?, 'unigram_lambda' => ?]],
 */
class PhraseSuggester implements SuggesterInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $text;

    /** @var CandidateGeneratorInterface[] */
    protected $directGenerators = [];

    /** @var array|null */
    protected $collate;

    public function __construct(string $field, string $text, array $options = [])
    {
        $this->field = $field;
        $this->text = $text;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->directGenerators = array_clone($this->directGenerators);
        $this->collate = $this->collate ? array_clone($this->collate) : null;
    }

    /**
     * @return CandidateGeneratorInterface[]
     */
    public function getDirectGenerators(): array
    {
        return $this->directGenerators;
    }

    /**
     * @param CandidateGeneratorInterface[] $candidateGenerators
     *
     * @return $this
     */
    public function setDirectGenerators(array $candidateGenerators): PhraseSuggester
    {
        $this->directGenerators = $candidateGenerators;

        return $this;
    }

    /**
     * @param CandidateGeneratorInterface $candidateGenerator
     *
     * @return $this
     */
    public function addDirectGenerator(CandidateGeneratorInterface $candidateGenerator): PhraseSuggester
    {
        $this->directGenerators[] = $candidateGenerator;

        return $this;
    }

    /**
     * @param MatcherInterface $query
     * @param array            $params
     * @param bool|null        $prune
     *
     * @return $this
     */
    public function setCollate(MatcherInterface $query, array $params = [], bool $prune = null): PhraseSuggester
    {
        $rawCollate = [];
        $rawCollate['query'] = $query->jsonSerialize();
        if (!empty($params)) {
            $rawCollate['params'] = $params;
        }
        if (null !== $prune) {
            $rawCollate['prune'] = $prune;
        }

        $this->collate = $rawCollate;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['text'] = $this->text;
        $body['phrase']['field'] = $this->field;
        $body['phrase'] += $this->options;

        foreach ($this->directGenerators as $candidateGenerator) {
            $body['phrase']['direct_generator'][] = $candidateGenerator->jsonSerialize();
        }

        if (!empty($this->collate)) {
            $body['phrase']['collate'] = $this->collate;
        }

        return $body;
    }
}
