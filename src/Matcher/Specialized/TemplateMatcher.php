<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-template-query.html
 * @see TemplateMatcherTest
 *
 * @options '_name' => '?',
 */
class TemplateMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var array */
    protected $body;

    /** @var array */
    protected $params;

    protected function __construct(array $body, array $params)
    {
        $this->body = $body;
        $this->params = $params;
    }

    /**
     * @param MatcherInterface|string $source
     * @param array                   $params
     *
     * @return TemplateMatcher
     */
    public static function fromSource($source, array $params): TemplateMatcher
    {
        $rawSource = $source instanceof MatcherInterface ? $source->jsonSerialize() : $source;

        return new static(['source' => $rawSource], $params);
    }

    public static function fromId(string $templateId, array $params): TemplateMatcher
    {
        return new static(['id' => $templateId], $params);
    }

    public static function fromFile(string $file, array $params): TemplateMatcher
    {
        return new static(['file' => $file], $params);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->body;
        $body['params'] = $this->params;
        $this->options += $this->options;

        return [
            'template' => $body,
        ];
    }
}
