<?php

class ClasseMapper extends Mapper
{
    private $findByIdStmt;
    private $insertStmt;
    private $updateStmt;
    private $deleteStmt;

    public function findById(int $id): ?Classe
    {
        $this->findByIdStmt()->execute([$id]);
        $row = $this->findByIdStmt()->fetch();

        if (!$row) {
            return null;
        }

        return $this->mapRowToClasse($row);
    }

    private function findByIdStmt(): PDOStatement
    {
        if (!isset($this->findByIdStmt)) {
            $this->findByIdStmt = $this->pdo->prepare($this->findByIdStmt());
        }

        return $this->findByIdStmt;
    }

    private function sqlForFindById(): string
    {
        return 'SELECT id, abbrev, name FROM classes WHERE id = ?';
    }

    public function insert(Classe $classe)
    {
        $this->insertStmt()->execute([
            $classe->getAbbrev(),
            $classe->getName()
        ]);

        $this->setEntityId($classe, $this->pdo->lastInsertId());
    }

    private function insertStmt(): PDOStatement
    {
        if (!isset($this->insertStmt)) {
            $this->insertStmt = $this->pdo->prepare($this->sqlForInsert());
        }

        return $this->insertStmt;
    }

    private function sqlForInsert(): string
    {
        return 'INSERT INTO classes (abbrev, name) VALUES (?, ?)';
    }

    public function update(Classe $classe)
    {
        $this->updateStmt()->execute([
            $classe->getAbbrev(),
            $classe->getName(),
            $classe->getId()
        ]);
    }

    private function updateStmt(): PDOStatement
    {
        if (!isset($this->updateStmt)) {
            $this->updateStmt = $this->pdo->prepare($this->sqlForUpdate());
        }

        return $this->updateStmt;
    }

    private function sqlForUpdate(): string
    {
        return 'UPDATE classes SET abbrev = ?, name = ? WHERE id = ?';
    }

    public function delete(int $id)
    {
        $this->deleteStmt()->execute([$id]);
    }

    private function deleteStmt(): PDOStatement
    {
        if (!isset($this->deleteStmt)) {
            $this->deleteStmt = $this->pdo->prepare($this->sqlForDelete());
        }

        return $this->deleteStmt;
    }

    private function sqlForDelete(): string
    {
        return 'DELETE FROM classes WHERE id = ?';
    }

    private function mapRowToClasse(array $row): Classe
    {
        $classe = new Classe($row['abbrev'], $row['name']);
        $this->setEntityId($classe, $row['id']);

        return $classe;
    }
}
