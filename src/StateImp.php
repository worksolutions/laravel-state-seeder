<?php

namespace WS\StateSeeder;

class StateImp implements State
{

    /**
     * @var StringTableQueue
     */
    private $layerTable;

    public function __construct()
    {
        $this->layerTable = new LayerTable();
    }

    public function generate(string $type, int $count = null, string $state = null): DataStream
    {
        if (!class_exists($type)) throw new \Exception("Class:{$type} not found");

        $factory = $state ? factory($type, $count)->state($state) : factory($type, $count);
        $stream = new DataStreamImp($factory->make());
        $layer = new StateLayerImp($stream);
        $this->layerTable->enqueue($layer);

        return $stream;
    }

    public function coverWithLayer(string $layerClass): State
    {
        // TODO: Implement coverWithLayer() method.
    }

    public function getLayerStream(string $layerClass): DataStream
    {
        // TODO: Implement getLayerStream() method.
    }

    public function getTypeStream(string $type): DataStream
    {
        // проити по всем слоям и получить данные определенного типа
        // затем данные собрать в стрим
    }

    public function persist()
    {
        // TODO: Implement persist() method.
    }

    public function clear(): State
    {
        // TODO: Implement clear() method.
    }
}
