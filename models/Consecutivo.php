<?php

class Consecutivo extends Base
{
    protected $table = "consecutivos";
    
    
    public function getConsecutivo($ciudad)
    {
        $response = $this->mysqli->query("SELECT c.*, ci.acronym FROM {$this->table} c INNER JOIN cities ci ON c.ciudad = ci.id WHERE ciudad = {$ciudad} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_assoc() : false;
    }
    public function checkConsecutivo($ciudad,$consecutivo)
    {
        $response = $this->mysqli->query("SELECT consecutivo FROM {$this->table} WHERE ciudad = $ciudad");
        $consecutivo_actual = $response->fetch_object()->consecutivo;
        if($consecutivo == $consecutivo_actual){
            // si entra hasta aca es porque el consecutivo que tomo inicialmente (temp) es el mism asi que sumare +1 al consecutivo (actual)
            $nuevo_consecutivo = $consecutivo_actual + 1;
            $query = "UPDATE {$this->table} SET consecutivo = $nuevo_consecutivo WHERE ciudad = $ciudad";
            $this->mysqli->query($query);
            return "se sumo +1 al consecutivo = $nuevo_consecutivo";
        }else{
            $query = "SELECT COUNT(*) AS num FROM guides WHERE guide = $consecutivo AND id_origin_city = $ciudad";
            $result = $this->mysqli->query($query);
            $response = $result->fetch_object()->num;
            if($response > 0) {
                // estoes porque ya existe una guia on este numero y no se deben duplicar
                return false;
            }
        }
        return false;
    }
    public function getGuides()
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} ORDER BY guide");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function getGuide($idciudad)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE id = {$idciudad} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }

    public function set($guide, $remitente, $destinatario, $origen,$destino, $commercial,$contenido,$observaciones, $flete, $declarado,$seguro,$vseguro,$venvio, $factura, $licad, $iduser,$contrapago, $formadepago )
    {
        $response = $this->mysqli->query("INSERT INTO {$this->table} (id, guide, id_client, id_remitent, id_origin_city, id_destino_city, commercial, content, observations, flete, valor_declarado, seguro, valor_seguro, valor_envio, bill, licad, last_update_by, counterpayment, way_to_pay) VALUES ('{$guide}' , '{$remitente}' , '{$destinatario}' , '{$origen}' ,'{$destino}' , '{$commercial}' ,'{$contenido}' ,'{$observaciones}' , '{$flete}' , '{$declarado}' ,'{$seguro}' ,'{$vseguro}' ,'{$venvio}' , '{$factura}' , '{$licad}' , '{$iduser}' ,'{$contrapago}' , '{$formadepago}')");

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
