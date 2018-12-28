<?php

abstract class Mapper
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Registry::instance()->getPdo();
    }

    protected function setEntityId(Entity $entity, int $id)
    {
        $reflection = new ReflectionClass($entity);
        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $id);
    }
}
