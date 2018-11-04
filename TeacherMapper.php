<?php

class TeacherMapper extends Mapper
{
    public function insert(Teacher $teacher): bool
    {
        $sql = 'INSERT INTO teachers (first_name, last_name) VALUES (?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $teacher->firstName, PDO::PARAM_STR);
        $stmt->bindValue(2, $teacher->lastName, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }
        
        return true;        
    }
}