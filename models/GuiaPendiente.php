<?php

class GuiaPendiente extends Base
{
    protected $table = "guides";
    
    
    public function setGuia($guia, $remitente, $destinatario, $origen, $destino, $ruta, $comercial, $contenido, $observaciones, $producto, $piezas, $kg, $flete, $declarado, $seguro, $vseguro, $venvio, $actualizado, $contrapago, $formadepago, $status)   {
        $query = "UPDATE {$this->table}
        SET id_remitente = '$remitente',
            id_destinatario = '$destinatario',
            id_origin_city = '$origen',
            id_destino_city = '$destino',
            ruta = '$ruta',
            commercial = '$comercial',
            content = '$contenido',
            observations = '$observaciones',
            product = '$producto',
            parts = '$piezas',
            kg_vol = '$kg',
            flete = '$flete',
            valor_declarado = '$declarado',
            seguro = '$seguro',
            valor_seguro = '$vseguro',
            valor_envio = '$venvio',
            last_update_by = '$actualizado',
            counterpayment = '$contrapago',
            way_to_pay = '$formadepago',
            status = '$status'
        WHERE guide = $guia;
        ";
        $this->mysqli->query($query);
        return $guia;
    }
    public function setParcial($guia, $comercial, $contenido, $destinatario, $destino, $observaciones, $origen, $piezas, $producto, $remitente, $ruta)   {
        $query = "INSERT INTO {$this->table} (guide, commercial, content, id_destinatario, id_destino_city, observations, id_origin_city, parts, product, id_remitente, ruta) VALUES ('$guia', '$comercial', '$contenido', '$destinatario', '$destino', '$observaciones', '$origen', '$piezas', '$producto', '$remitente', '$ruta')";
        // return $query;
        $response = $this->mysqli->query($query);
        if ($response) {
            $response = $this->mysqli->query("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
            return (INT) $response->fetch_object()->id;
        }

        return false;
    }
    public function getGuiasPendientes($ciudad)
    {
        $response = $this->mysqli->query("SELECT g.guide, c.business_name, g.id FROM guides g INNER JOIN clients c ON c.id = g.id_destinatario WHERE status = 0 AND id_origin_city = '$ciudad' ORDER BY guide");
        return $response->num_rows > 0 ? $response->fetch_all() : false;
    }

    public function getGuiaP($idciudad)
    {
        $response = $this->mysqli->query("SELECT * FROM {$this->table} WHERE id = {$idciudad} AND status = 0 LIMIT 1");
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
