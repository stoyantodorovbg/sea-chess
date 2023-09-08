<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class BaseRepository extends ServiceEntityRepository
{
    protected function createEntity(array $fields, bool $save = true): object
    {
        $class = $this->getClassName();
        $entity = new $class();
        foreach ($fields as $name => $value) {
            $setter = 'set' . ucfirst($name);
            $entity->$setter($value);
        }

        if ($save) {
            $entity = $this->storeEntity($entity);
        }

        return $entity;
    }

    protected function storeEntity(object $entity): object
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush($entity);

        return $entity;
    }

    protected function query(string $query): mixed
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery($query);

        return $query->getResult();
    }
}