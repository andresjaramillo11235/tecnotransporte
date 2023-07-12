<?php

function resizeImagen( $ruta, $nombre, $alto, $ancho, $nombreN, $extension ) {
    $rutaImagenOriginal = $ruta . $nombre;
    if ( $extension == 'GIF' || $extension == 'gif' ) {
        $img_original = imagecreatefromgif ( $rutaImagenOriginal );
    }
    if ( $extension == 'jpg' || $extension == 'JPG' ) {
        $img_original = imagecreatefromjpeg( $rutaImagenOriginal );
    }
    if ( $extension == 'png' || $extension == 'PNG' ) {
        $img_original = imagecreatefrompng( $rutaImagenOriginal );
    }
    $max_ancho = $ancho;
    $max_alto = $alto;
    list( $ancho, $alto ) = getimagesize( $rutaImagenOriginal );
    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;
    if ( ( $ancho <= $max_ancho ) && ( $alto <= $max_alto ) ) {
        //Si ancho
        $ancho_final = $ancho;
        $alto_final = $alto;
    } elseif ( ( $x_ratio * $alto ) < $max_alto ) {
        $alto_final = ceil( $x_ratio * $alto );
        $ancho_final = $max_ancho;
    } else {
        $ancho_final = ceil( $y_ratio * $ancho );
        $alto_final = $max_alto;
    }
    $tmp = imagecreatetruecolor( $ancho_final, $alto_final );
    imagecopyresampled( $tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto );
    imagedestroy( $img_original );
    $calidad = 70;
    imagejpeg( $tmp, $ruta . $nombreN, $calidad );
}

## Grabar la imagen en el servidor
function grabarImagen( $files, $foto, $directorio, $extension ) {

    $imagen = $foto . '.' . $extension;

    move_uploaded_file( $files[ 'foto' ][ 'tmp_name' ], $directorio . '/' . $imagen);

    $minFoto = 'min_' . $imagen;
    $resFoto = 'res_' . $imagen;

    resizeImagen( $directorio . '/', $imagen, 65, 65, $minFoto, $extension );
    resizeImagen( $directorio . '/', $imagen, 500, 500, $resFoto, $extension );
    unlink( $directorio . '/' . $imagen );
}
?>

