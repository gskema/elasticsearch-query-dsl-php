<?php

namespace Gskema\ElasticSearchQueryDSL;

use JsonSerializable;

/**
 * @param mixed[] $array
 * @return  mixed[]
 */
function array_clone(array $array): array
{
    $clone = $array;
    foreach ($clone as &$value) {
        if (is_object($value)) {
            $value = clone $value;
        } elseif (is_array($value)) {
            $value = array_clone($value);
        }
    }

    return $clone;
}

/**
 * @param JsonSerializable[] $objects
 * @return mixed[]
 */
function obj_array_json_serialize(array $objects): array
{
    return array_map(fn (JsonSerializable $object) => $object->jsonSerialize(), $objects);
}
