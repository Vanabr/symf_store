<?php

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $persister = new Persister($manager);
        $persister->persist($this->getObjects());
    }

    private function getObjects()
    {
        $loader = new NativeLoader();

        return $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();
    }
}