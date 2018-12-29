<?php

class TeacherMapper extends Mapper
{
    private $findByIdStmt;
    private $insertStmt;
    private $updateStmt;
    private $deleteStmt;

    public function findById(int $id): ?Teacher
    {
        $this->findByIdStmt()->execute([$id]);
        $row = $this->findByIdStmt()->fetch();

        if (!$row) {
            return null;
        }

        return $this->mapRowToTeacher($row);
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
        return 'SELECT id, first_name, last_name, acronym 
                FROM teachers WHERE id = ?'; 
    }

    public function insert(Teacher $teacher)
    {
        $this->insertStmt()->execute([
            $teacher->getName()->getFirstName(),
            $teacher->getName()->getLastName(),
            $teacher->getAcronym()
        ]);

        $this->setEntityId($teacher, $this->pdo->lastInsertId());
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
        return 'INSERT INTO teachers (first_name, last_name, acronym) 
                VALUES (?, ?, ?)';
    }

    public function update(Teacher $teacher)
    {
        $this->updateStmt()->execute([
            $teacher->getName()->getFirstName(),
            $teacher->getName()->getLastName(),
            $teacher->getAcronym(),
            $teacher->getId()
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
        return 'UPDATE teachers 
                SET first_name = ?, last_name = ?, acronym = ? 
                WHERE id = ?';
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
        return 'DELETE FROM teachers WHERE id = ?';
    }

    private function mapRowToTeacher(array $row): Teacher
    {
        $name = new Name($row['first_name'], $row['last_name']);
        $teacher = new Teacher($name);
        $teacher->setAcronym($row['acronym']);
        $this->setEntityId($teacher, $row['id']);

        return $teacher;
    }
}
