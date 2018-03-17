<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Rescorer\RescorerInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-rescore.html
 * @see HasRescorersTraitTest
 */
trait HasRescorersTrait
{
    /** @var RescorerInterface[] */
    protected $rescorers = [];

    /**
     * @return RescorerInterface[]
     */
    public function getRescorers(): array
    {
        return $this->rescorers;
    }

    /**
     * @param RescorerInterface[] $rescorers
     *
     * @return $this
     */
    public function setRescorers(array $rescorers)
    {
        $this->rescorers = $rescorers;

        return $this;
    }

    /**
     * @param RescorerInterface $rescorer
     *
     * @return $this
     */
    public function addRescorer(RescorerInterface $rescorer)
    {
        $this->rescorers[] = $rescorer;

        return $this;
    }
}
