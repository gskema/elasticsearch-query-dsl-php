<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Rescorer\RescorerInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-rescore.html
 * @see HasRescorersTraitTest
 */
trait HasRescorersTrait
{
    /** @var RescorerInterface[] */
    protected array $rescorers = [];

    /**
     * @return RescorerInterface[]
     */
    public function getRescorers(): array
    {
        return $this->rescorers;
    }

    /**
     * @param RescorerInterface[] $rescorers
     */
    public function setRescorers(array $rescorers): static
    {
        $this->rescorers = $rescorers;
        return $this;
    }

    public function addRescorer(RescorerInterface $rescorer): static
    {
        $this->rescorers[] = $rescorer;
        return $this;
    }
}
