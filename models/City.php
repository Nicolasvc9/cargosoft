<?php

class City extends Base
{
    protected $table = "cities";
    
    public function getCiudades()
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} ORDER BY city");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function getCiudad($idciudad)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE id = {$idciudad} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }

    public function set($acronimo, $ciudad, $valDeclarado, $seguro)
    {
        $response = $this->mysqli->query("INSERT INTO {$this->table} (acronym, city, valor_minimo_declarado, seguro	) VALUES ('{$acronimo}', '{$ciudad}', '{$valDeclarado}', '{$seguro}')");

        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (INT) $response->fetch_object()->id;
        }

        return false;
    }
    
    public function update($idciudad, $acronimo, $ciudad, $valDeclarado, $seguro)
    {
        $this->mysqli->query("UPDATE {$this->table} SET acronym = '{$acronimo}', city = '{$ciudad}', valor_minimo_declarado = '{$valDeclarado}', seguro = '{$seguro}' WHERE id = {$idciudad}");
        return $idciudad;
    }

    public function checkAcronimo($acronimo, $idciudad = false)
    {
        $condition = $idciudad ? "AND id <> {$idciudad}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE acronym = '{$acronimo}' {$condition} LIMIT 1");
        return (INT) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }
    
    public function checkCiudad($ciudad, $idciudad = false)
    {
        $condition = $idciudad ? "AND id <> {$idciudad}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE city = '{$ciudad}' {$condition} LIMIT 1");
        return (INT) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }

    public function create()
    {
        return $this->mysqli->query("CREATE TABLE IF NOT EXISTS {$this->table} (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            acronym VARCHAR(30) NOT NULL,
            city VARCHAR(30) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )");
    }
}
