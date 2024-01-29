<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Highlighter\HighlighterInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-highlighting.html
 * @see HasHighlighterTraitTest
 */
trait HasHighlighterTrait
{
    protected ?HighlighterInterface $highlighter = null;

    public function getHighlighter(): ?HighlighterInterface
    {
        return $this->highlighter;
    }

    public function setHighlighter(?HighlighterInterface $highlighter): static
    {
        $this->highlighter = $highlighter;
        return $this;
    }
}
