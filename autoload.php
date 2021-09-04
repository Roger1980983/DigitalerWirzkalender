<?php

  function my_autoload($class_name)
  {

    $file = [     
        $_SERVER['DOCUMENT_ROOT'] .BASEPATH. 'System/' . $class_name . '.php',
        $_SERVER['DOCUMENT_ROOT'] .BASEPATH. 'Configuration/Controller/' . $class_name . '.php'  
    ];

    foreach ($file as &$value) {
        if(file_exists($value))
        {
          require_once($value);
        }
    }

  }
  
  spl_autoload_register('my_autoload');


