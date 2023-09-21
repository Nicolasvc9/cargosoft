<?php

class Route extends Base
{
    protected $table = "routes";
    
    public function getFlete($ruta){
        $response = $this->mysqli->query("SELECT * FROM {$this->table} r 
        INNER JOIN cities c 
        ON r.idcity_origin = c.id
        WHERE r.id = {$ruta} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_assoc() : false;
    }
    public function getRutasGuia($origen)
    {
        $response = $this->mysqli->query("SELECT
            r.id,
            co.id, co.city, co.acronym,
            cd.id, cd.city, cd.acronym,
            r.status,
            r.flete,
            r.flete_comercial,
            r.gasolina
        FROM {$this->table} r
            INNER JOIN cities co ON co.id = r.idcity_origin
            INNER JOIN cities cd ON cd.id = r.idcity_destiny
        WHERE r.idcity_origin = '$origen'
        ORDER BY co.city");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
    public function getRutas()
    {
        $response = $this->mysqli->query("SELECT
            r.id,
            co.id, co.city, co.acronym,
            cd.id, cd.city, cd.acronym,
            r.status,
            r.flete,
            r.flete_comercial,
            r.gasolina
        FROM {$this->table} r
            INNER JOIN cities co ON co.id = r.idcity_origin
            INNER JOIN cities cd ON cd.id = r.idcity_destiny
        ORDER BY co.city");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function getRuta($idruta)
    {
        $response = $this->mysqli->query("SELECT
            r.id,
            co.id AS idcity_origin, co.city AS city_origin, co.acronym AS acronym_origin,
            cd.id AS idcity_destiny, cd.city AS city_destiny, cd.acronym AS acronym_destiny,
            r.status, r.flete as flete, r.flete_comercial as fletecom, r.gasolina as gasolina
        FROM {$this->table} r
            INNER JOIN cities co ON co.id = r.idcity_origin
            INNER JOIN cities cd ON cd.id = r.idcity_destiny
        WHERE r.id = {$idruta} ORDER BY co.city LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }

    public function set($idorigen, $iddestino, $estado, $flete, $fleteCom, $gasolina)
    {
        $response = $this->mysqli->query("INSERT INTO {$this->table} (idcity_origin, idcity_destiny, status, flete, flete_comercial, gasolina) VALUES ({$idorigen}, {$iddestino}, {$estado}, {$flete}, {$fleteCom}, {$gasolina})");

        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (INT) $response->fetch_object()->id;
        }

        return false;
    }
    
    public function update($idruta, $idorigen, $iddestino, $status, $flete, $fleteCom, $gasolina)
    {
        $this->mysqli->query("UPDATE {$this->table} SET idcity_origin = {$idorigen}, idcity_destiny = {$iddestino}, status = {$status}, flete = {$flete}, flete_comercial = {$fleteCom}, gasolina = {$gasolina} WHERE id = {$idruta}");
        return $idruta;
    }

    public function checkRuta($idorigen, $iddestino, $idruta = false)
    {
        $condition = $idruta ? "AND id <> {$idruta}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE idcity_origin = {$idorigen} AND idcity_destiny = {$iddestino} {$condition} LIMIT 1");
        return (INT) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }

    public function create()
    {
        return $this->mysqli->query("CREATE TABLE IF NOT EXISTS {$this->table} (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            idcity_origin INTEGER UNSIGNED NOT NULL,
            idcity_destiny INTEGER UNSIGNED NOT NULL,
            status INTEGER UNSIGNED NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )");
    }
}
