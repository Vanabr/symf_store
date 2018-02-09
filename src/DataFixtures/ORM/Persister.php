<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use Doctrine\ORM\EntityManagerInterface;

class Persister
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function persist(array $objects)
    {
        $persistable = $this->getPersistableClasses();
        foreach ($objects as $object) {
            if (in_array(get_class($object), $persistable)) {
                $this->entityManager->persist($object);
            }
        }
        $this->entityManager->flush();
    }

    private function getPersistableClasses()
    {
        if (!isset($this->persistableClasses)) {
            $metadatas = $this->entityManager->getMetadataFactory()->getAllMetadata();
            foreach ($metadatas as $metadata) {
                if (isset($metadata->isEmbeddedClass) && $metadata->isEmbeddedClass) {
                    continue;
                }
                if (isset($metadata->isEmbeddedDocument) && $metadata->isEmbeddedDocument) {
                    continue;
                }
                $this->persistableClasses[] = $metadata->getName();
            }
        }

        return $this->persistableClasses;
    }
}
