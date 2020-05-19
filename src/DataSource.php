<?php
/**
 * @author Maxim Sokolovsky
 */

namespace WS\StateSeeder;

interface DataSource
{
    public function getType(): String;
}
