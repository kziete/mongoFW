<?php 
Toro::serve(array(
	"/test" => "App\Test",

    "/" => "App\Index",
    "/maquetas/:alpha" => "App\Maquetas",
    //De sistema, favor no tocar
    "/admin" => "Admin",
    "/admin/:alpha" => "AdminLista",
    "/admin/:alpha/:alpha" => "AdminForm",
    "/(.*)" => 'App\Error404'
));
