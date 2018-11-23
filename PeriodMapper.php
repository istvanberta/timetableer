<?php

class PeriodMapper extends Mapper
{
    public function findById(int $id): ?Period
    {
        $sql = 'SELECT id, period, start_time, end_time FROM periods WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return $this->mapRowToPeriod($result);
    }

    public function insert(Period $period)
    {
        $sql = 'INSERT INTO periods (period, start_time, end_time) VALUES (?, ?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $period->period,
            $this->stringToMysqlTime($period->startTime),
            $this->stringToMysqlTime($period->endTime),
            ]);

        $period->id = $this->pdo->lastInsertId();
    }

    public function update(Period $period)
    {
        $sql = 'UPDATE periods SET period = ?, start_time = ?, end_time = ? WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $period->period,
            $this->stringToMysqlTime($period->startTime),
            $this->stringToMysqlTime($period->endTime),
            $period->id
        ]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM periods WHERE id = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function mapRowToPeriod(array $row): Period
    {
        return new Period(
            $row['period'],
            $this->mysqlTimeToString($row['start_time']),
            $this->mysqlTimeToString($row['end_time']),
            $row['id']
        );
    }

    protected function stringToMysqlTime(string $time): string
    {
        return date('H:i:s', strtotime($time));
    }

    protected function mysqlTimeToString(string $time): string
    {
        return date('G:i', strtotime($time));
    }
}