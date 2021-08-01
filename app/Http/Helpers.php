<?php

if(!function_exists('preco_br')){
    function preco_br($number)
    {
        return "R$ ".number_format($number, 2,',', '.');
    }
}
?>
