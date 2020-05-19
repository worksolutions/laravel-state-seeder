<?php
/**
 * @author Maxim Sokolovsky
 */

namespace WS\StateSeeder;

interface StateBuilder
{

    /**
     * Push changes into database
     * @return State
     */
    public function getState(): State;

    /**
     * Model of using factory
     * @return string
     */
    public function sourceModel(): string;
}
