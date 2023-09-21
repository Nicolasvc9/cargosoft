<?php

class Pallet extends Base
{
    protected $table = "guides";


    public function setPallet($idguia, $pallet)
    {
        $insert = "";
        if (count($idguia) > 0) {
            foreach ($idguia as $guia) {
                $insert .= " id = $guia OR ";
            }
            $insert = rtrim($insert, " OR ");
        }
        $query = "UPDATE guides SET pallet = '$pallet' WHERE $insert";
        $this->mysqli->query($query);
        return true;
    }
    public function setParcial($guia, $guiac, $comercial, $contenido, $destinatario, $destino, $observaciones, $origen, $piezas, $producto, $remitente, $ruta, $kg = 0, $vol = 0)
    {
        $query = "INSERT INTO {$this->table} (guide, guia, commercial, content, id_destinatario, id_destino_city, observations, id_origin_city, parts, product, id_remitente, ruta, kg, vol) VALUES ('$guia','$guiac', '$comercial', '$contenido', '$destinatario', '$destino', '$observaciones', '$origen', '$piezas', '$producto', '$remitente', '$ruta', '$kg', '$vol')";
        // return $query;
        $response = $this->mysqli->query($query);
        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (int) $response->fetch_object()->id;
        }

        return false;
    }
    public function getGuides()
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} ORDER BY guide");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }
    public function getGuiaPallet($ruta, $tipo, $desde, $hasta)
    {
        // return $ruta ." - ". $tipo ." - ". $desde ." - ". $hasta;
        $response = $this->mysqli->query("SELECT g.id, g.guia,g.kg, c.business_name FROM guides g
        INNER JOIN clients c ON g.id_remitente = c.id WHERE ruta = $ruta AND commercial = $tipo AND create_at BETWEEN '$desde' AND '$hasta'");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function getGuide($guia)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE guia = {$guia} LIMIT 1");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }
    public function getGuiaRes($guia)
    {
        $response = $this->mysqli->query("SELECT g.guia, g.content, ci.city, g.parts,
        c.document as rem_documento, c.business_name as rem_nombre , c.direction as rem_direccion,
        cc.document as des_documento , cc.business_name as des_nombre, cc.direction as des_direccion
        FROM {$this->table} g
        INNER JOIN cities ci ON g.id_destino_city = ci.id
        INNER JOIN clients c ON c.id = g.id_remitente
        INNER JOIN clients cc ON cc.id = g.id_destinatario
        WHERE g.guia = '{$guia}'");
        return $response->num_rows > 0 ? $response->fetch_object() : false;
    }

    public function set($guide, $remitente, $destinatario, $origen, $destino, $commercial, $contenido, $observaciones, $flete, $declarado, $seguro, $vseguro, $venvio, $factura, $licad, $iduser, $contrapago, $formadepago)
    {
        $response = $this->mysqli->query("INSERT INTO {$this->table} (id, guide, id_client, id_remitent, id_origin_city, id_destino_city, commercial, content, observations, flete, valor_declarado, seguro, valor_seguro, valor_envio, bill, licad, last_update_by, counterpayment, way_to_pay) VALUES ('{$guide}' , '{$remitente}' , '{$destinatario}' , '{$origen}' ,'{$destino}' , '{$commercial}' ,'{$contenido}' ,'{$observaciones}' , '{$flete}' , '{$declarado}' ,'{$seguro}' ,'{$vseguro}' ,'{$venvio}' , '{$factura}' , '{$licad}' , '{$iduser}' ,'{$contrapago}' , '{$formadepago}')");

        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (int) $response->fetch_object()->id;
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
        return (int) $response->num_rows > 0 ? $response->fetch_object()->id : false;
    }

    public function checkCiudad($ciudad, $idciudad = false)
    {
        $condition = $idciudad ? "AND id <> {$idciudad}" : "";
        $response = $this->mysqli->query("SELECT id FROM {$this->table} WHERE city = '{$ciudad}' {$condition} LIMIT 1");
        return (int) $response->num_rows > 0 ? $response->fetch_object()->id : false;
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
