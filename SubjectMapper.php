<?php

class SubjectMapper extends Mapper
{
    public function findById(int $id): ?Subject
    {
        $sql = 'SELECT id, abbrev, name FROM subjects WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return $this->mapRowToSubject($result);

    }

    public function insert(Subject $subject)
    {
        $sql = 'INSERT INTO subjects (abbrev, name) VALUES (?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$subject->abbrev, $subject->name]);

        $subject->id = $this->pdo->lastInsertId();
    }

    public function update(Subject $subject)
    {
        $sql = 'UPDATE subjects SET abbrev = ?, name = ? WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$subject->abbrev, $subject->name, $subject->id]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM subjects WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function mapRowToSubject()
    {
        return new Subject($row['abbrev'], $row['name'], $row['id']);
    }
}