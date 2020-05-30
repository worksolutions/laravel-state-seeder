<?php

namespace WS\StateSeeder;

use Exception;

class StateImp implements State
{

    /**
     * @var StringTable
     */
    private $layerTable;

    public function __construct()
    {
        $this->layerTable = new LayerTable();
    }

    public function generate(string $type, int $count = null, string $state = null): DataStream
    {
        if (!class_exists($type)) throw new Exception("Class:{$type} not found");

        $factory = $state ? factory($type, $count)->state($state) : factory($type, $count);
        $stream = new DataStreamImp($factory->make());
        $layer = new StateLayerImp($stream);
        $this->layerTable->add($layer);

        return $stream;
    }

    public function coverWithLayer(string $layerClass): State
    {
        if (!class_exists($layerClass)) throw new Exception("Class:{$layerClass} not found");
        $layer = new $layerClass();
        $this->layerTable->add($layer);

        return $this;
    }

    public function getLayerStream(string $layerClass)
    {
        if (!class_exists($layerClass)) throw new Exception("Class:{$layerClass} not found");
        $layer = $this->layerTable->getTopBy($layerClass);
        if (!$layer) return null;

        return $layer->getDataStream();
    }

    /**
     * @return DataStream|null
     */
    public function topLayerStream()
    {
        $layer = $this->layerTable->top();
        if (!$layer) return null;

        return $layer->getDataStream();
    }

    public function getTypeStream(string $type): DataStream
    {
        // TODO refactoring
        $collection = collect();
        $this->layerTable->all()
            ->each(
                function (StateLayer $layer) use ($collection, $type) {
                    $collection
                        ->merge(collect($layer->getDataStream()->toArray())
                            ->filter(
                                function ($item) use ($type) {
                                    return $item instanceof $type;
                                }
                            )
                        );
                });

        return new DataStreamImp($collection);
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
