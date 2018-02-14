<?php

Class Database {

    private $PDOInstance = null;

    private static $instance = null;

    const DEFAULT_SQL_USER = 'root';

    const DEFAULT_SQL_HOST = 'localhost';

    const DEFAULT_SQL_PASS = '';

    const DEFAULT_SQL_DTB = 'opeth';

    private function __construct()
    {

        $this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);
    }

    /**
     * Crée et retourne l'objet SPDO
     */
    public static function getInstance()
    {

        if(is_null(self::$instance))
        {

            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Exécute une requête SQL avec PDO
     * @param string $query La requête SQL
     * @return PDOStatement Retourne l'objet PDOStatement
     */
    public function query($query)
    {

        return $this->PDOInstance->query($query);
    }

    /**
     * Exécute une requête SQL avec PDO
     * @param string $query La requête SQL
     * @return PDOStatement Retourne l'objet PDOStatement
     */
    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }

    /**
     * Exécute une requête SQL avec PDO
     * @param string $query La requête SQL
     * @return PDOStatement Retourne l'objet PDOStatement
     */
    public function bindValue($query)
    {
        return $this->PDOInstance->bindValue($query);
    }

}



?>