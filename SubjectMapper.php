<?php

class SubjectMapper extends Mapper
{
    private $findByIdStmt;
    private $insertStmt;
    private $updateStmt;
    private $deleteStmt;

    public function findById(int $id): ?Entity
    {
        $this->findByIdStmt()->execute([$id]);
        $row = $this->findByIdStmt()->fetch();

        if (!$row) {
            return null;
        }

        return $this->mapRowToSubject($row);
    }

    private function findByIdStmt(): PDOStatement
    {
        if (!isset($this->findByIdStmt)) {
            $this->findByIdStmt = $this->pdo->prepare($this->sqlForFindById());
        }

        return $this->findByIdStmt;
    }

    private function sqlForFindById(): string
    {
        return 'SELECT id, abbrev, name FROM subjects WHERE id = ?';
    }

    public function insert(Subject $subject)
    {
        $this->insertStmt()->execute([
            $subject->getAbbrev(),
            $subject->getName()
        ]);
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
        return 'INSERT INTO subjects (abbrev, name) VALUES (?, ?)';
    }

    public function update(Subject $subject)
    {
        $this->updateStmt()->execute([
            $subject->getAbbrev(),
            $subject->getName(),
            $subject->getId()
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
        return 'UPDATE subjects SET abbrev = ?, name = ? WHERE id = ?';
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

    private function sqlForDelete()
    {
        return 'DELETE FROM subjects WHERE id = ?';
    }

    private function mapRowToSubject(array $row): Subject
    {
        $subject = new Subject($row['abbrev'], $row['name']);
        $this->setEntityId($subject, $row['id']);

        return $subject;
    }
}
