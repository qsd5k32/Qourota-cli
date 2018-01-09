<?php

echo "\33[34m 
   ____                                  __         
  / __ \  ____   __  __   _____  ____   / /_  ____ _
 / / / / / __ \ / / / /  / ___/ / __ \ / __/ / __ `/
/ /_/ / / /_/ // /_/ /  / /    / /_/ // /_  / /_/ / 
\___\_\ \____/ \__,_/  /_/     \____/ \__/  \__,_/  
                                                    
         \33[37m                                              
";
unset($argv[0]);
if($argc == 1){
    print("use qourota --help for more information \n");
    exit();
}
$action = isset($argv[1]) ? $argv[1]:null;
$name = isset($argv[2]) ? $argv[2]:null;
new Qcli([
        "action" => $action,
        "name" => $name
    ]);



