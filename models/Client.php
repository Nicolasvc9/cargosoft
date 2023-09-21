<?php

class Client extends Base
{
    protected $table = "clients";
    
    public function getSeguro($city){
        $response = $this->mysqli->query("SELECT seguro FROM cities WHERE id = '$city'");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
    public function getClientes()
    {
        $response = $this->mysqli->query("SELECT
        c.id, dt.acronym, dt.document_type, c.document, c.dv, c.first_name, c.second_name, c.first_surname, c.second_surname, c.business_name, c.direction, c.phone, c.email, ci.city,c.seguro
        FROM {$this->table} c
            INNER JOIN document_types dt ON dt.id = c.iddocument_type
            INNER JOIN cities ci ON ci.id = c.idcity
        ORDER BY c.created_at");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function getCliente($idcliente)
    {
        $response = $this->mysqli->query("SELECT
        c.id, dt.id AS iddocument_type, dt.acronym, dt.document_type, c.document, c.dv, c.first_name, c.second_name, c.first_surname, c.second_surname, c.business_name, c.direction, c.phone, c.email, ci.id AS idcity, ci.city, c.seguro
        FROM {$this->table} c
            INNER JOIN document_types dt ON dt.id = c.iddocument_type
            INNER JOIN cities ci ON ci.id = c.idcity
        WHERE c.id = {$idcliente} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }

    public function getTiposDocumento()
    {
        $response = $this->mysqli->query("SELECT * FROM document_types ORDER BY document_type");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function set($iddocument_type, $document, $dv, $first_name, $second_name, $first_surname, $second_surname, $business_name, $direction, $phone, $email, $idcity, $seguro, $id)
    {
        $response = $this->mysqli->query("INSERT INTO {$this->table} (iddocument_type, document, dv, first_name, second_name, first_surname, second_surname, business_name, direction, phone, email, idcity, seguro, register_by) VALUES ({$iddocument_type}, '{$document}', {$dv}, '{$first_name}', '{$second_name}', '{$first_surname}', '{$second_surname}', '{$business_name}', '{$direction}', '{$phone}', '{$email}', {$idcity}, {$seguro}, {$id})");

        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (INT) $response->fetch_object()->id;
        }

        return false;
    }
    
    public function update($idcliente, $iddocument_type, $document, $dv, $first_name, $second_name, $first_surname, $second_surname, $business_name, $direction, $phone, $email, $idcity, $seguro)
    {
        $this->mysqli->query("UPDATE {$this->table} SET iddocument_type = {$iddocument_type}, document = '{$document}', dv = {$dv}, first_name = '{$first_name}', second_name = '{$second_name}', first_surname = '{$first_surname}', second_surname = '{$second_surname}', business_name = '{$business_name}', direction = '{$direction}', phone = '{$phone}', email = '{$email}', idcity = {$idcity}, seguro = '{$seguro}' WHERE id = {$idcliente}");
        return $idcliente;
    }

    public function checkDocumento($idtipodocumento, $documento, $dv, $idcliente = false)
    {
        $condition = $idcliente ? "AND id <> {$idcliente}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE iddocument_type = {$idtipodocumento} AND document = '{$documento}' AND dv = {$dv} {$condition} LIMIT 1");
        return (INT) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }
    
    public function checkCorreo($correo, $idcliente = false)
    {
        $condition = $idcliente ? "AND id <> {$idcliente}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE email = '{$correo}' {$condition} LIMIT 1");
        return (INT) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }
    
    public function checkTelefono($telefono, $idcliente = false)
    {
        $condition = $idcliente ? "AND id <> {$idcliente}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE phone = '{$telefono}' {$condition} LIMIT 1");
        return (INT) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }
}

/*
- CLIENTES (id, tipo_doc, documento, dv, primer_nombre, segundo_nombre, p´rimer_nombre, segundo_nombre, razon_social,
direccion, telefono, idciudad, email)
*/