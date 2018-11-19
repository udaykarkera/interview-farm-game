<?php
Class TestGeneral {

    public static function printLines(Array $print_stmts) {
        if (isset($_GET['test']))
            $next_line = '<br/>';
        else
            $next_line = PHP_EOL;

        echo implode($next_line ,$print_stmts) . $next_line;
    }

}