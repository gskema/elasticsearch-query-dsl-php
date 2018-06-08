<?php

namespace Gskema\ElasticSearchQueryDSL;

function array_clone(array $array): array
{
    $clone = $array;
    foreach ($clone as $key => &$value) {
        if (is_object($value)) {
            $value = clone $value;
        } elseif (is_array($value)) {
            $value = array_clone($value);
        }
    }

    return $clone;
}
