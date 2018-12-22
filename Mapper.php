<?php

abstract class Mapper
{
    protected $pdo;

    public function __construct()
    {
        $reg = Registry::instance();
        $this->pdo = $reg->getPdo();
    }

    public function findById(int $id): ?Entity
    {
        $stmt = $this->findByIdStmt();
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $entity = $this->mapRowToEntity($row);
        $this->setEntityId($entity, $row['id']);

        return $entity;
    }

    abstract protected function findByIdStmt(): PDOStatement;
    abstract protected function mapRowToEntity(array $row): Entity;

    private function setEntityId(Entity $entity, int $id)
    {
        $reflection = new ReflectionClass($entity);
        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $id);
    }
}
