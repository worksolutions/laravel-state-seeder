<?php
/**
 * @author Maxim Sokolovsky
 */

namespace WS\StateSeeder;

interface StateLayer extends DataSource
{
    public function put(State $state): DataStream;
}
