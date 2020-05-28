<?php


namespace WS\StateSeeder;


class StateLayerImp implements StateLayer
{

    /**
     * @var DataStreamImp
     */
    private $stream;

    public function __construct(DataStream $stream)
    {
        $this->stream = $stream;
    }

    public function getType(): string
    {
        return self::class;
    }

    public function put(State $state): DataStream
    {

    }
}