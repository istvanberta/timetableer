<?php

class Registry
{
    private static $instance = null;
    private $pdo;
    private $config;

    private function __construct()
    {
        $this->config = include('config.php');
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPdo()
    {
        if (is_null($this->pdo)) {
            $this->pdo = new PDO(
                'mysql:host=' . $this->config['db_host'] . ';dbname=' . $this->config['db_name'],
                $this->config['db_user'],
                $this->config['db_pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }
}