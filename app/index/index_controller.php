<?php


if (function_exists($_PATH[1])){
    $_PATH[1]();
}else{
    setViewIndex('error');
}



function index(){
    setViewIndex('index');
}


function ver (){
    include_once '../modelos/Dao.php';
    $dao = new Dao();
    $dao->connect();
    $a = $dao->selectRet('examen','*');
    echo "<h1>Datos cargados en la BD</h1>";
    echo "<pre>";
    print_r($a);
    echo "</pre>";




}

function genera(){
    echo "<pre>";
    $a = fibonacci(50);
    header("location: "._setUrl('/index/ver'));
}

function fibonacci($n,$first = 0,$second = 1)
{
    include_once '../modelos/Dao.php';
    $dao = new Dao();
    $dao->connect();
    $dao->query("truncate table examen");
    $fib = [$first,$second];
    for($i=1;$i<$n;$i++)
    {
        $dao->insert('examen',[$fib[$i]+$fib[$i-1]],"valor");
        $fib[] = $fib[$i]+$fib[$i-1];
    }
    return $fib;
}




function suma(){

    include_once '../modelos/Dao.php';
    $dao = new Dao();
    $dao->connect();
    $a = $dao->query('SELECT SUM(valor) as valor from test.examen where valor <= 4000000 and valor % 2 = 0 +1;');
    $a = $dao->getResult();
    $dao->insert('pares',[$a[0]['valor']],"valor");
    echo "<h1>La Suma es: ".$a[0]['valor']."  </h1>";

};















?>