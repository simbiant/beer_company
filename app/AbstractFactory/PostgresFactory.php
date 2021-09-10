<?php

namespace App\AbstractFactory;

class PostgresFactory extends \Connector implements DBFactory {

    public function DBConnection(array $config = [])
    {
        $dsn = $this->hasSocket($config)
            ? $this->getSocketDsn($config)
            : $this->getHostDsn($config);

        $options = $this->getOptions($config);
        return $this->createConnection($dsn, $config, $options);
    }

    protected function hasSocket(array $config)
    {
        return isset($config['unix_socket']) && ! empty($config['unix_socket']);
    }

    protected function getSocketDsn(array $config)
    {
        return "pgsql:unix_socket={$config['unix_socket']};dbname={$config['database']}";
    }

    /**
     * Get the DSN string for a host / port configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getHostDsn(array $config)
    {
        extract($config, EXTR_SKIP);
        $host = env('DB_HOST', 'localhost');
        $port = env('DB_PORT', '5432');
        $database = env('DB_DATABASE', 'beer_company');
        return "pgsql:host={$host};port={$port};dbname={$database}";
    }

    public function DBRecord(string $table) {
        return $this->DBQueryBuilder('SELECT * FROM ' . $table)->fetchAll();
    }
    public function DBQueryBuilder(string $query) {
        $connection = $this->DBConnection();
        return $connection->query($query);
    }
}
