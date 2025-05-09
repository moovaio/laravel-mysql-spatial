<?php

namespace Grimzy\LaravelMysqlSpatial;

use Grimzy\LaravelMysqlSpatial\Schema\Builder;
use Grimzy\LaravelMysqlSpatial\Schema\Grammars\MySqlGrammar;
use Illuminate\Database\MySqlConnection as IlluminateMySqlConnection;

class MysqlConnection extends IlluminateMySqlConnection
{
    /**
     * Get the default schema grammar instance.
     *
     * @return \Illuminate\Database\Grammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new MySqlGrammar());
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \Illuminate\Database\Schema\MySqlBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new Builder($this);
    }
}