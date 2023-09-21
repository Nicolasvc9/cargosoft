<?php

class Product extends Base
{
    protected $table = "products";

    public function all()
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} ORDER BY code DESC");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function get($idproducto)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE id = {$idproducto} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_all()[0] : false;
    }

    public function checkCodigo($codigo, $idproducto = false) : int
    {
        $condition = $idproducto ? "AND id <> {$idproducto}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE code = '{$codigo}' {$condition} LIMIT 1");
        return (INT) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }
    
    public function set($codigo, $nombre, $especial) : int
    {
        $response = $this->mysqli->query("INSERT INTO {$this->table} (code, name, special) VALUES ('{$codigo}', '{$nombre}', {$especial})");

        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (INT) $response->fetch_object()->id;
        }

        return false;
    }
    
    public function update($idproducto, $codigo, $nombre, $especial) : int
    {
        $this->mysqli->query("UPDATE {$this->table} SET code = '{$codigo}', name = '{$nombre}', special = {$especial} WHERE id = {$idproducto}");
        return $idproducto;
    }

    public function create()
    {
        return $this->mysqli->query("CREATE TABLE IF NOT EXISTS {$this->table} (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            code VARCHAR(30) NOT NULL,
            name VARCHAR(30) NOT NULL,
            special INTEGER NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )");
    }
}
