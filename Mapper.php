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

        return $this->mapRowToEntity($row);
    }

    abstract protected function findByIdStmt(): PDOStatement;
    abstract protected function mapRowToEntity(array $row): Entity;
}
