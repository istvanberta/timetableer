<?php

class LessonMapper extends Mapper
{
    private $findByIdStmt;
    private $insertStmt;
    private $updateStmt;
    private $deleteStmt;

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
}
