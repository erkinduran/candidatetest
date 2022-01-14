<?php
    
    use App\App;
    
    if ( !file_exists ( 'vendor/autoload.php' ) )
    {
        exit ( "Composer not installed" );
    }
    
    require 'vendor/autoload.php';
    
    $dotenv = Dotenv\Dotenv::createImmutable ( __DIR__ );
    $dotenv->load ();
    
    const MAIN_PATH = __DIR__;
    const APP_PATH  = __DIR__ . "/src";
    
    $path = 'helpers/*.php';
    
    $filenames = glob ( $path );
    
    foreach ( $filenames as $filename )
    {
        require $filename;
    }
    
    $app = new App();
    echo $app->run ();