<?php


class Utilidades
{


    public static function redirect($url)
    {
        echo "<script>window.location.href='" . $url . "'</script>";
        die();
    }

    public static function dangerAlert($mensagem)
    {
        $_SESSION['msg'] = "<div id='alert' class='alert alert-danger' role='alert'>" . $mensagem . "</div>
        <script>
        
        var alert = document.getElementById('alert');

        setTimeout(function () {

            alert.remove();

            },3000);
        
        </script>
        ";
    }

    public static function successAlert($mensagem)
    {
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>" . $mensagem . "</div>
        
        <script>
        
        var alert = document.getElementById('alert');

        setTimeout(function () {

            alert.remove();

            },3000);
        
        </script>
        ";
    }

    public static function successAlertDashboard($mensagem)
    {
        $_SESSION['dashboard'] = "<div style='padding: 10px' id='alert' class='alert alert-success' role='alert'>" . $mensagem . "</div>
        <script>
        
        var alert = document.getElementById('alert');

        setTimeout(function () {

            alert.remove();

            },3000);
        
        </script> 
        ";
    }

    public static function dangerAlertDashboard($mensagem)
    {
        $_SESSION['dashboard'] = "<div style='padding: 10px' id='alert' class='alert alert-danger' role='alert'>" . $mensagem . "</div>
        
        <script>
        
        var alert = document.getElementById('alert');

        setTimeout(function () {

            alert.remove();

            },3000);
        
        </script> ";
    }
}
