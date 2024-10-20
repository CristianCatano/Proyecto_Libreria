<?php

/**
 * Vamos a recibir un array y los vamos a convertir en un strig de
 * parametros, ejemplo, si recibo:
 * [ "foo"  => 1, "var" = "cristian" ]
 * foo=1&var=cristian ..... primer argumento
 * [ "foo"  => 1, "var" = "cristian" ]
 * foo=1 var=cristian ..... segundo argumento
 * [ "foo"  => 1, "var" = "cristian" ]
 * foo="1" var="cristian" ......tercer argumento 
 */
function convertirAParametros($array, $separador = "&", $encerrarCon = "") {

    return implode(
        $separador, 
        array_map(function ($clave, $valor) use ($encerrarCon) {
            return "{$clave}={$encerrarCon}{$valor}{$encerrarCon}";
        }, 
            array_keys($array),
            $array 
        )
    );
}

function ruta($controlador, $accion, $parametros = []) {
    #url raiz
    $urlProyecto = "http://localhost/proyecto-libreria/";
    #$parametros['controlador'] = $controlador;
    #$parametros['accion'] = $accion;
    #convertimos todo el array de parametros a string
    $strParametros = convertirAParametros(array_merge(
        ['controlador' => $controlador, 'accion' => $accion],
        $parametros,
    ));
    #$strParametros = convertirAParametros($parametros);
    return "{$urlProyecto}?{$strParametros}";
}

function crearLink($texto, $configuracion = []) {
    $controlador = $configuracion['controlador'] ?? 'inicio';
    $accion = $configuracion['accion'] ?? 'inicio';
    $opcionesHtml = $configuracion['optionsHtml'] ?? [];
    $parametros = $configuracion['parametros'] ?? [];
    $srtOpcionesHtml = convertirAParametros($opcionesHtml, " ", '"');
    $ruta = ruta($controlador, $accion, $parametros);
    return "<a href='{$ruta}' {$srtOpcionesHtml}>{$texto}</a>";
}
