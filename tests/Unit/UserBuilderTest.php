<?php
/**
 * @author Maxim Sokolovsky
 */

namespace Unit;

use WS\StateSeeder\State;

class UserBuilderTest
{

    public function state(): State
    {
    }

    public function simpleUsing()
    {
        $state = $this->state();
        $state
            ->generate(Company::class, 10)
            ->random(3, AdvCompanies::generateReports())
            ->then(AdvCompanies::creteAnything())
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
