<?php
/**
 * @author Maxim Sokolovsky
 */

namespace Unit;

use WS\StateSeeder\State;
use WS\StateSeeder\StateImp;

class UserBuilderTest
{

    public function state(): State
    {
        return new StateImp();
    }

    public function simpleUsing()
    {
        $state = $this->state();
        $state
            ->generate(Company::class, 10)
            ->random(3, AdvCompanies::generateReports())
            ->then(AdvCompanies::creteAnything())
            ->forAll()
            ->then()
        ;

        $state->coverWithLayer(SomeLayer::class);

        $state->persist();
    }

    public function anotherUsing()
    {
        $state = $this
            ->state();
        $state
            ->clear()
            ->coverWithLayer(SomeLayer::class)
            ->getLayerStream(SomeLayer::class)
            ->random(5)
                ->then(AdvCompanies::closeCampaigns())
                ->then(AdvCompanies::addComents())
                ->last(AdvCompanies::createFullReport())
        ;

        $state->persist();
    }
}
