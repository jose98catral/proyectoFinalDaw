
<?php
///clase de calendario
class calendarioCitas {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
//funcion para obtener las citas hacioendo una consulta a la base de datos
    public function obtenerCitas() {
        $sql = "SELECT id, fecha, nombre, email, telefono, hora, corte FROM cita";
        $result = mysqli_query($this->db, $sql);

        $citas = array();
        while ($row = $result->fetch_assoc()) {
            $fecha = $row["fecha"];
            if (!isset($citas[$fecha])) {
                $citas[$fecha] = array();
            }
            $cita = array(
                "id" => $row["id"],
                "nombre" => $row["nombre"],
                "email" => $row["email"],
                "telefono" => $row["telefono"],
                "hora" => $row["hora"],
                "corte" => $row["corte"]
            );
            $citas[$fecha][] = $cita;
        }

        mysqli_close($this->db);

        return $citas;
    }
//funcion para generar el calendario
    public function generarCalendario() {
        $citas = $this->obtenerCitas();

        $primerDiaMes = date("N", strtotime(date("Y-m-01")));
        $diasMes = date("t");

        $fila = 1;
        $dia = 1;
        while ($dia <= $diasMes) {
            echo "<tr>";
            for ($i = 1; $i <= 7; $i++) {
                if ($fila == 1 && $i < $primerDiaMes) {
                    echo "<td></td>";
                } else {
                    if ($dia <= $diasMes) {
                        $fechaActual = date("Y-m-d", strtotime(date("Y-m") . "-$dia"));
                        $clase = isset($citas[$fechaActual]) ? "cita" : "";
                        echo "<td class='$clase'>";
                        echo "<strong>$dia</strong><br>";
                        if (isset($citas[$fechaActual])) {
                            foreach ($citas[$fechaActual] as $cita) {
                                echo  $cita["nombre"] . ",";
                                echo "telefono: " . $cita["telefono"] . ",";
                                echo "email: " . $cita["email"] . "<br>";
                                echo "<div class= 'hora'>";
                                echo "Hora: " . $cita["hora"] . ",";
                                echo "</div>";
                                echo "Corte: " . $cita["corte"] . "<br>";
                                echo "<form method='post'>";
                                echo "<input type='hidden' name='cita_id' value='" . $cita["id"] . "'>";
                                echo "<input type='submit' name='borrar' value='Borrar'>";
                                echo "</form>";
                            }
                        }
                        echo "</td>";
                        $dia++;
                    } else {
                        echo "<td></td>";
                    }
                }
            }
            echo "</tr>";
            $fila++;
        }
    }
//funcion para borrar la cita
    public function borrarCita($cita_id) {
        $sql = "DELETE FROM cita WHERE id = '$cita_id'";
        $result = mysqli_query($this->db, $sql);

        mysqli_close($this->db);
    }
}
?>