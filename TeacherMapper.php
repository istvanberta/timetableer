<?php

class TeacherMapper extends Mapper
{
    public function findById(int $id): ?Teacher
    {
        $sql = 'SELECT id, first_name, last_name FROM teachers WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return $this->mapRowToTeacher($result);
    }

    public function insert(Teacher $teacher)
    {
        $sql = 'INSERT INTO teachers (first_name, last_name) VALUES (?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teacher->firstName, $teacher->lastName]);

        $teacher->id = $this->pdo->lastInsertId();
    }

    public function update(Teacher $teacher)
    {
        $sql = 'UPDATE teachers SET first_name = ?, last_name = ? WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teacher->firstName, $teacher->lastName, $teacher->id]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM teachers WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function mapRowToTeacher(array $row): Teacher
    {
        return new Teacher($row['first_name'], $row['last_name'], $row['id']);
    }
}