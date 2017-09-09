<?php

class Database extends PDO
{
    public function getCurrentTables()
    {
        return $this->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function createTables()
    {
        $this->query('CREATE TABLE articles (
            id BIGINT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            content LONGTEXT NOT NULL
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');
    }
}
