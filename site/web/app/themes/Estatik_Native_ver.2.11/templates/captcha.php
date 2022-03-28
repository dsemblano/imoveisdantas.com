<?php

if ( ! session_id() ) {
    session_start();
}

$width = 110;
$height = 40;
$font_size = 14;
$let_amount = 4;
$fon_let_amount = 20;
$font = '../assets/fonts/cour.ttf';

$letters = array( 'a','b','c','d','e','f','g' );
$colors = array( '90','110','130','150','170','190','210' );

$src = imagecreatetruecolor( $width, $height );
$fon = imagecolorallocate( $src, 255,255,255 );

imagefill( $src,0,0,$fon );

for( $i=0; $i < $fon_let_amount; $i++ ) {
    $color = imagecolorallocatealpha( $src, rand( 0,255 ), rand( 0,255 ), rand( 0,255 ), 100 );
    $letter = $letters[ rand( 0, sizeof( $letters ) - 1 ) ];
    $size = rand( $font_size - 2, $font_size + 2 );
    imagettftext( $src, $size, rand( 0, 45 ),
        rand( $width * 0.1, $width - $width * 0.1 ),
        rand( $height * 0.2, $height ), $color, $font, $letter );
}

for( $i=0; $i < $let_amount; $i++ ) {
    $color = imagecolorallocatealpha( $src, $colors[ rand( 0, sizeof( $colors ) - 1 ) ],
        $colors[ rand( 0, sizeof( $colors ) - 1 ) ],
        $colors[ rand( 0, sizeof( $colors ) -1 ) ], rand( 20, 40 ) );

    $letter = $letters[ rand( 0, sizeof( $letters ) - 1 ) ];
    $size = rand( $font_size * 2 - 2, $font_size * 2 + 2 );
    $x = ( $i + 1 ) * $font_size + rand( 1, 5 );      //даем каждому символу случайное смещение
    $y = ( ( $height * 2 ) / 3 ) + rand( 0, 5 );
    $cod[] = $letter;                        //запоминаем код
    imagettftext( $src, $size, rand( 0, 15 ), $x, $y, $color, $font, $letter );
}

$cod = implode( '', $cod );
$_SESSION['captcha'] = $cod;

header ( 'Content-type: image/gif' );
imagegif( $src );
