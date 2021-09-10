<?php

namespace App\AbstractFactory;

class OracleFactory extends \Connector implements DBFactory {

    public function DBConnection(array $config = [])
    {
        $dsn = $this->hasSocket($config)
            ? $this->getSocketDsn($config)
            : $this->getHostDsn($config);

        $options = $this->getOptions($config);
        return oci_connect($options['username'], $options['password'], $dsn);
    }

    protected function hasSocket(array $config)
    {
        return isset($config['unix_socket']) && ! empty($config['unix_socket']);
    }

    protected function getSocketDsn(array $config)
    {
        return "orcl:unix_socket={$config['unix_socket']};dbname={$config['database']}";
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
        $port = env('DB_PORT', '1521');
        $database = env('DB_DATABASE', 'beer_company');
        return "orcl:host={$host};port={$port};dbname={$database}";
    }

    public function DBRecord(string $table) {
        $oracle = $table-$this->DBQueryBuilder('SELECT * FROM ' . $table);
        $result = null;
        oci_execute($oracle);
        oci_fetch_all($oracle, $result);
        return $result;
    }
    public function DBQueryBuilder(string $query) {
        $connection = $this->DBConnection();
        $oracle = oci_parse($connection, $query);
        return $oracle;
    }
}
