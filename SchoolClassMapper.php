<?php

class SchoolClassMapper extends Mapper
{
    public function findById(int $id): ?SchoolClass
    {
        $sql = 'SELECT id, abbrev, name FROM school_classes WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return $this->mapRowToSchoolClass($result);
    }

    public function insert(SchoolClass $schoolClass)
    {
        $sql = 'INSERT INTO school_classes (abbrev, name) VALUES (?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$schoolClass->abbrev, $schoolClass->name]);

        $schoolClass->id = $this->pdo->lastInsertId();
    }

    public function update(SchoolClass $schoolClass)
    {
        $sql = 'UPDATE school_classes SET abbrev = ?, name = ? WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $schoolClass->abbrev,
            $schoolClass->name,
            $schoolClass->id
        ]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM school_classes WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function mapRowToSchoolClass(array $row): SchoolClass
    {
        return new SchoolClass($row['abbrev'], $row['name'], $row['id']);
    }
}