<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Highlighter\HighlighterInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-highlighting.html
 * @see HasHighlighterTraitTest
 */
trait HasHighlighterTrait
{
    /** @var HighlighterInterface|null */
    protected $highlighter;

    /**
     * @return HighlighterInterface|null
     */
    public function getHighlighter()
    {
        return $this->highlighter;
    }

    /**
     * @param HighlighterInterface|null $highlighter
     *
     * @return $this
     */
    public function setHighlighter(HighlighterInterface $highlighter = null)
    {
        $this->highlighter = $highlighter;

        return $this;
    }
}
