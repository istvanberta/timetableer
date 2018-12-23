<?php

class SubjectMapper extends Mapper
{
    public function insert(Subject $subject)
    {
        $sql = 'INSERT INTO subjects (abbrev, name) VALUES (?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$subject->abbrev, $subject->name]);

        $this->setEntityId($subject, $this->pdo->lastInsertId());
    }

    public function update(Subject $subject)
    {
        $sql = 'UPDATE subjects SET abbrev = ?, name = ? WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$subject->abbrev, $subject->name, $subject->getId()]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM subjects WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function findByIdStmt(): PDOStatement
    {
        $sql = 'SELECT id, abbrev, name FROM subjects WHERE id = ?';

        return $this->pdo->prepare($sql);
    }

    protected function mapRowToEntity(array $row): Entity
    {
        return new Subject($row['abbrev'], $row['name']);
    }
}
