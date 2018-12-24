<?php

abstract class Mapper
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Registry::instance()->getPdo();
    }

    public function findById(int $id): ?Entity
    {
        $stmt = $this->pdo->prepare($this->findByIdSql());
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $this->mapRowToEntity($row);
    }

    abstract protected function findByIdSql(): string;
    abstract protected function mapRowToEntity(array $row): Entity;

    protected function setEntityId(Entity $entity, int $id)
    {
        $reflection = new ReflectionClass($entity);
        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $id);
    }
}
