<?php

namespace Grimzy\LaravelMysqlSpatial\Eloquent;

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Grammar;

class SpatialExpression extends Expression
{
    public function getValue(Grammar $grammar)
    {
        if (config('moova_spatial.mysql_version_8')) {
            return "ST_GeomFromText(?, ?, 'axis-order=long-lat')";
        }
        return "ST_GeomFromText(?, ?)";
    }

    public function getSpatialValue()
    {
        return $this->value->toWkt();
    }

    public function getSrid()
    {
        return $this->value->getSrid();
    }
}
