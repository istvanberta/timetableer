<?php

class PeriodMapper extends Mapper
{
    private $findByIdStmt;
    private $insertStmt;
    private $updateStmt;
    private $deleteStmt;

    public function findById(int $id): ?Period
    {
        $this->findByIdStmt()->execute([$id]);
        $row = $this->findByIdStmt()->fetch();

        if (!$row) {
            return null;
        }

        return $this->mapRowToPeriod($row);
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
        return 'SELECT id, number, start_time, end_time 
                FROM periods WHERE id = ?';
    }

    public function insert(Period $period)
    {
        $this->insertStmt()->execute([
            $period->getNumber(),
            $this->timestampToMysqlTime($period->getInterval()->getStartTime()),
            $this->timestampToMysqlTime($period->getInterval()->getEndTime())
        ]);

        $this->setEntityId($period, $this->pdo->lastInsertId());
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
        return 'INSERT INTO periods (number, start_time, end_time) 
                VALUES (?, ?, ?)';
    }

    public function update(Period $period)
    {
        $this->updateStmt()->execute([
            $period->getNumber(),
            $this->timestampToMysqlTime($period->getInterval()->getStartTime()),
            $this->timestampToMysqlTime($period->getInterval()->getEndTime()),
            $period->getId()
        ]);
    }

    private function updateStmt(): PDOStatement
    {
        if (!$this->updateStmt) {
            $this->updateStmt = $this->pdo->prepare($this->sqlForUpdate());
        }

        return $this->updateStmt;
    }

    private function sqlForUpdate(): string
    {
        return 'UPDATE periods SET number = ?, start_time = ?, end_time = ? 
                WHERE id = ?';
    }

    public function delete(int $id)
    {
        $this->deleteStmt()->execute([$id]);
    }

    private function deleteStmt(): PDOStatement
    {
        if (!$this->deleteStmt) {
            $this->deleteStmt = $this->pdo->prepare($this->sqlForDelete());
        }

        return $this->deleteStmt;
    }

    private function sqlForDelete(): string
    {
        return 'DELETE FROM periods WHERE id = ?';
    }

    private function mapRowToPeriod(array $row): Period
    {
        $interval = new Interval($row['start_time'], $row['end_time']);
        $period = new Period($row['number'], $interval);
        $this->setEntityId($period, $row['id']);

        return $period;
    }

    private function timestampToMysqlTime(int $time): string
    {
        return date('H:i:s', $time);
    }

    private function mysqlTimeToTimestamp(string $time): int
    {
        return strtotime($time);
    }
}
