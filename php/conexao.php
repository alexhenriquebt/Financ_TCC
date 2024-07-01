<?php
// CONEXÃO SERVIDOR
session_start();
function novaConexao()
{
    $dsn='mysql:host=br612.hostgator.com.br;dbname=hubsap45_bd_financ';
    $usuario = 'hubsap45_financ_afmin';
    $senha = 'F!n@n(+#2oXXIV';
    
    try
    {
        //cria objeto conexao da classe PDO
        $conexao = new PDO($dsn, $usuario, $senha);
        return $conexao;

    }
    catch(PDOException $e)
    {
        echo 'Erro ao conectar com Banco de Dados';
    }
} //fecha a fç */


// CONEXÃO LOCAL
/* 
function novaConexao()
{
    $dsn='mysql:host=localhost;dbname=financ';
    $usuario = 'root';
    $senha = '';
    
    try
    {
        //cria objeto conexao da classe PDO
        $conexao = new PDO($dsn, $usuario, $senha);
        return $conexao;

    }
    catch(PDOException $e)
    {
        echo 'Erro ao conectar com Banco de Dados';
    }
} //fecha a fç
*/
novaConexao();