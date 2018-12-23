<?php

class ClasseMapper extends Mapper
{
    public function insert(Classe $classe)
    {
        $sql = 'INSERT INTO classes (abbrev, name) VALUES (?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $classe->getAbbrev(),
            $classe->getName()
        ]);

        $this->setEntityId($classe, $this->pdo->lastInsertId());
    }

    public function update(Classe $classe)
    {
        $sql = 'UPDATE classes SET abbrev = ?, name = ? WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $classe->getAbbrev(),
            $classe->getName(),
            $classe->getId()
        ]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM classes WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function findByIdStmt(): PDOStatement
    {
        $sql = 'SELECT id, abbrev, name FROM classes WHERE id = ?';

        return $this->pdo->prepare($sql);
    }

    protected function mapRowToEntity(array $row): Entity
    {
        return new Classe($row['abbrev'], $row['name']);
    }
}
