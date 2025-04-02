<?php
class vistaModelo
{
    protected static function obtener_vista($vista)
    {
        
        $palabras_permitidas_n1 = ['admin', 'academico', 'biblioteca', 'tutoria', 'admision', 'egresados'];
        
        if (in_array($vista, $palabras_permitidas_n1)) {

            $pagina = explode("/", $_GET['views']);
            if ((isset($pagina['1']) && $pagina['1'] != '') && $pagina['0'] == 'admin') {
                // palabras permitidas para administracion
                $palabras_nivel2 = ['institucion', 'periodo-academico', 'nuevo-periodo-academico', 'nuevo-docente', 'docentes', 'sedes', 'programa-estudio', 'modulo-formativo', 'semestre', 'editar-semestre', 'unidad-didactica', 'editar-unidad-didactica', 'competencia', 'editar-competencia', 'indicador-logro-competencia', 'capacidad', 'editar-capacidad', 'indicador-logro-capacidad', 'sistema'];
                if (in_array($pagina['1'], $palabras_nivel2)) {

                    if (is_file("./src/view/" . $vista . "-" . $pagina['1'] . ".php")) {
                        $contenido = "./src/view/" . $vista . "-" . $pagina['1'] . ".php";
                    } else {
                        $contenido = "404";
                    }
                } else {
                    $contenido = "404";
                }
            } elseif ((isset($pagina['1']) && $pagina['1'] != '') && $pagina['0'] == 'academico') {
                // palabras permitidas para academico
                $palabras_nivel2 = ['programacion', 'estudiantes', 'editar-estudiante', 'matriculas', 'matricula', 'editar-matricula', 'licencias', 'mis-unidades-didacticas', 'unidades-didacticas', 'evaluaciones', 'estudiantes', 'estudiantes'];
                if (in_array($pagina['1'], $palabras_nivel2)) {

                    if (is_file("./src/view/" . $vista . "-" . $pagina['1'] . ".php")) {
                        $contenido = "./src/view/" . $vista . "-" . $pagina['1'] . ".php";
                    } else {
                        $contenido = "404";
                    }
                } else {
                    $contenido = "404";
                }
            } elseif ((isset($pagina['1']) && $pagina['1'] != '') && $pagina['0'] == 'biblioteca') {
                // palabras permitidas para biblioteca
                $palabras_nivel2 = ['libros', 'favoritos', 'detalle-libro', 'lectura', 'perfil', 'admin', 'vista-libros', 'nuevo-libro', 'editar-libro', 'asignaciones', 'usuarios', 'lecturas', 'accesos'];
                if (in_array($pagina['1'], $palabras_nivel2)) {

                    if (is_file("./src/view/" . $vista . "-" . $pagina['1'] . ".php")) {
                        $contenido = "./src/view/" . $vista . "-" . $pagina['1'] . ".php";
                    } else {
                        $contenido = "404";
                    }
                } else {
                    $contenido = "404";
                }
            } elseif ((isset($pagina['1']) && $pagina['1'] != '') && $pagina['0'] == 'tutoria') {
                // palabras permitidas para tutoria
                $palabras_nivel2 = ['tutoria', 'asistencia'];
                if (in_array($pagina['1'], $palabras_nivel2)) {

                    if (is_file("./src/view/" . $vista . "-" . $pagina['1'] . ".php")) {
                        $contenido = "./src/view/" . $vista . "-" . $pagina['1'] . ".php";
                    } else {
                        $contenido = "404";
                    }
                } else {
                    $contenido = "404";
                }
            } elseif ((isset($pagina['1']) && $pagina['1'] != '') && $pagina['0'] == 'admision') {
                // palabras permitidas para admision
                $palabras_nivel2 = ['postulantes', 'aulas'];
                if (in_array($pagina['1'], $palabras_nivel2)) {

                    if (is_file("./src/view/" . $vista . "-" . $pagina['1'] . ".php")) {
                        $contenido = "./src/view/" . $vista . "-" . $pagina['1'] . ".php";
                    } else {
                        $contenido = "404";
                    }
                } else {
                    $contenido = "404";
                }
            } elseif ((isset($pagina['1']) && $pagina['1'] != '') && $pagina['0'] == 'egresados') {
                // palabras permitidas para egresados
                $palabras_nivel2 = ['calificaciones', 'historial'];
                if (in_array($pagina['1'], $palabras_nivel2)) {

                    if (is_file("./src/view/" . $vista . "-" . $pagina['1'] . ".php")) {
                        $contenido = "./src/view/" . $vista . "-" . $pagina['1'] . ".php";
                    } else {
                        $contenido = "404";
                    }
                } else {
                    $contenido = "404";
                }
            } else {

                if (is_file("./src/view/" . $vista . ".php")) {
                    $contenido = "./src/view/" . $vista . ".php";
                } else {
                    $contenido = "404";
                }
            }
        } elseif ($vista == "intranet" || $vista == "index") {
            $contenido = "intranet";
        } elseif ($vista == "login") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        
        return $contenido;
    }
}
