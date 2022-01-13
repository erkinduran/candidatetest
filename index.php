<?php
    
    use App\App;
    
    require 'vendor/autoload.php';
    
    const MAIN_PATH = __DIR__;
    
    $path = 'helpers/*.php';
    
    $filenames = glob ( $path );
    
    foreach ( $filenames as $filename )
    {
        require $filename;
    }
    
    $app = new App();
    echo $app->run ();