<?php

class LessonMapper extends Mapper
{
    private $findByIdStmt;
    private $insertStmt;
    private $updateStmt;
    private $deleteStmt;

    public function findById(int $id): ?Lesson
    {
        $this->findByIdStmt()->execute([$id]);
        $row = $this->findByIdStmt()->fetch();

        if (!$row) {
            return null;
        }

        return $this->mapRowToLesson($row);
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
        return 'SELECT id, day, period_id, teacher_id, classe_id, subject_id
                FROM lessons
                WHERE id = ?';
    }

    public function insert(Lesson $lesson)
    {
        $params = $this->getEmptyParamArray();

        if ($lesson->isScheduled()) {
            $params[':day'] = $lesson->getTimeslot()->getDay();
            $params[':periodId'] = $lesson->getTimeslot()->getPeriod()->getId();
        }
        if ($lesson->hasTeacher()) {
            $params[':teacherId'] = $lesson->getTeacher()->getId();
        }
        $params[':classeId'] = $lesson->getClasse()->getId();
        $params[':subjectId'] = $lesson->getSubject()->getId();

        $this->insertStmt()->execute($params);

        $this->setEntityId($lesson, $this->pdo->lastInsertId());
    }

    private function getEmptyParamArray(): array
    {
        return [
            ':id' => null,
            ':day' => null,
            ':periodId' => null,
            ':classeId' => null,
            ':subjectId' => null,
            ':teacherId' => null
        ];
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
        return 'INSERT INTO lessons (day, period_id, classe_id, subject_id, teacher_id) 
                VALUES (:day, :periodId, :classeId, :subjectId, :teacherId)';
    }

    public function update(Lesson $lesson)
    {
        $params = $this->getEmptyParamArray();

        if ($lesson->isScheduled()) {
            $params[':day'] = $lesson->getTimeslot()->getDay();
            $params[':periodId'] = $lesson->getTimeslot()->getPeriod()->getId();
        }
        if ($lesson->hasTeacher()) {
            $params[':teacherId'] = $lesson->getTeacher()->getId();
        }
        $params[':classeId'] = $lesson->getClasse()->getId();
        $params[':subjectId'] = $lesson->getSubject()->getId();
        $params[':id'] = $lesson->getId();

        $this->updateStmt()->execute($params);

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
        return 'UPDATE 
                    lessons 
                SET 
                    day = :day, 
                    period_id = :periodId, 
                    classe_id = :classeId, 
                    subject_id = :subjectId, 
                    teacher_id = :teacherId 
                WHERE 
                    id = :id';
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
        return 'DELETE FROM lessons WHERE id = ?';
    }

    private function mapRowToLesson(): Lesson
    {
//        if ($row['period_id']) {
//            $this->periodMapper->
//        }
    }
}
