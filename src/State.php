<?php
/**
 * @author Maxim Sokolovsky
 */

namespace WS\StateSeeder;

interface State
{
    /**
     * Generates specified type data
     * @param string $type Class name or another type for generation
     * @param int $count
     * @return DataStream
     */
    public function generate(string $type, int $count): DataStream;

    /**
     * Creates a new state layer
     * @param string $layerClass
     * @return $this
     */
    public function coverWithLayer(string $layerClass): self;

    /**
     * Gets layer stream
     * @param string $layerClass
     * @return DataStream
     */
    public function getLayerStream(string $layerClass): DataStream;

    /**
     * Gets stream by specified type
     * @param string $type
     * @return DataStream
     */
    public function getTypeStream(string $type): DataStream;

    /**
     * Push state into database
     * @return mixed
     */
    public function persist();

    /**
     * Clear state
     * @return $this
     */
    public function clear(): self;
}
