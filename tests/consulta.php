<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);

require "Integracao.php";

if (!empty($_POST['id_imovel'])) {

    $email_corretor = $_POST['email_corretor'];
    $id_imovel = $_POST['id_imovel'];

    $id = $id_imovel.'-'.$email_corretor;

    $obj = new Integracao();
    $resultado_imovel = json_decode($obj->buscaImovel($id));

} elseif (!empty($_POST['id_pessoa'])) {

    $email_corretor = $_POST['email_corretor'];
    $id_pessoa = $_POST['id_pessoa'];

    $id = $id_pessoa.'-'.$email_corretor;

    $obj = new Integracao();
    $resultado_pessoa = json_decode($obj->buscaPessoa($id));

} elseif (!empty($_POST['id_pessoa_upload'])) {

    $email_corretor = $_POST['email_corretor'];
    $id_pessoa = $_POST['id_pessoa_upload'];

    $id = $id_pessoa.'-'.$email_corretor;

    $obj = new Integracao();
    $resultado_pessoa_upload = $obj->buscaUpload($id);

} elseif (!empty($_POST['id_pessoa_termo'])) {

    $email_corretor = $_POST['email_corretor'];
    $id_pessoa = $_POST['id_pessoa_termo'];

    $id = $id_pessoa.'-'.$email_corretor;

    $obj = new Integracao();
    $resultado_pessoa_termo = json_decode($obj->buscaTermo($id));

} elseif (!empty($_POST['id_pessoa_imovel'])) {

    $email_corretor = $_POST['email_corretor'];
    $id_pessoa = $_POST['id_pessoa_imovel'];

    echo $id = $id_pessoa.'-'.$email_corretor;

    $obj = new Integracao();
    $resultado_pessoa_imovel = json_decode($obj->buscaPessoaImovel($id));

}

 ?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-UU2jkdv1M9UEjLje/kygVxqMBq9Jrg9z+Gqvw972H6BqKTzDvLaRJfK7PnzLM4SI" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>

    <title>Teste API CredPago</title>

</head>
<body>

    <hr>

    <div class="container" >

        <div class="form-group">
            <label for="exampleInputEmail1">E-Mail Corretor</label>
            <input type="text" id="email_corretor_i" class="form-control" placeholder="">
        </div>

        <br>

        <div class="row">

            <div class="col-lg-3">

                <fieldset>

                    <legend>Buscar Pessoa</legend>

                    <hr>

                    <form action="consulta.php" method="post" enctype="multipart/form-data" id="form_pessoa">
                        <input type="hidden" name="email_corretor" id="email_corretor" value="">

                        <div class="form-group">
                            <label>Pessoa</label>
                            <input type="text" name="id_pessoa" class="form-control" placeholder="">
                        </div>

                        <button type="submit" class="btn btn-outline-primary col-lg-12">Buscar</button>

                    </form>

                </fieldset>

            </div>

            <div class="col-lg-9">

                <fieldset>

                    <legend>Resultado Pessoa</legend>

                    <hr>

                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="6" id="resultado_pessoa"><?php if(isset($resultado_pessoa)){print_r($resultado_pessoa);} ?></textarea>
                        </div>
                    </div>

                </fieldset>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-lg-3">

                <fieldset>

                    <legend>Buscar Imóvel</legend>

                    <hr>

                    <form action="consulta.php" method="post" enctype="multipart/form-data" id="form_imovel">
                        <input type="hidden" name="email_corretor" id="email_corretor_2" value="">

                        <div class="form-group">
                            <label>Imóvel</label>
                            <input type="text" name="id_imovel" class="form-control" placeholder="">
                        </div>

                        <button type="submit" class="btn btn-outline-primary col-lg-12">Buscar</button>

                    </form>

                </fieldset>

            </div>

            <div class="col-lg-9">

                <fieldset>

                    <legend>Resultado Imóvel</legend>

                    <hr>

                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="6" id="resultado_imovel"><?php if(isset($resultado_imovel)){print_r($resultado_imovel);} ?></textarea>
                        </div>
                    </div>

                </fieldset>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-lg-3">

                <fieldset>

                    <legend>Buscar Pessoas no Imóvel</legend>

                    <hr>

                    <form action="consulta.php" method="post" enctype="multipart/form-data" id="form_pessoa_imovel">
                        <input type="hidden" name="email_corretor" id="email_corretor_5" value="">

                        <div class="form-group">
                            <label>Imóvel</label>
                            <input type="text" name="id_pessoa_imovel" class="form-control" placeholder="">
                        </div>

                        <button type="submit" class="btn btn-outline-primary col-lg-12">Buscar</button>

                    </form>

                </fieldset>

            </div>

            <div class="col-lg-9">

                <fieldset>

                    <legend>Resultado Imóvel</legend>

                    <hr>

                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="6" id="resultado_pessoa_imovel"><?php if(isset($resultado_pessoa_imovel)){print_r($resultado_pessoa_imovel);} ?></textarea>
                        </div>
                    </div>

                </fieldset>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-lg-3">

                <fieldset>

                    <legend>Buscar Upload</legend>

                    <hr>

                    <form action="consulta.php" method="post" enctype="multipart/form-data" id="form_upload">
                        <input type="hidden" name="email_corretor" id="email_corretor_3" value="">

                        <div class="form-group">
                            <label>Pessoa</label>
                            <input type="text" name="id_pessoa_upload" class="form-control" placeholder="">
                        </div>

                        <button type="submit" class="btn btn-outline-primary col-lg-12">Buscar</button>

                    </form>

                </fieldset>

            </div>

            <div class="col-lg-9">

                <fieldset>

                    <legend>Resultado Upload</legend>

                    <hr>

                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="6" id="resultado_upload"><?php if(isset($resultado_pessoa_upload)){print_r($resultado_pessoa_upload);} ?></textarea>
                        </div>
                    </div>

                </fieldset>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-lg-3">

                <fieldset>

                    <legend>Buscar Termo</legend>

                    <hr>

                    <form action="consulta.php" method="post" enctype="multipart/form-data" id="form_termo">
                        <input type="hidden" name="email_corretor" id="email_corretor_4" value="">

                        <div class="form-group">
                            <label>Pessoa</label>
                            <input type="text" name="id_pessoa_termo" class="form-control" placeholder="">
                        </div>

                        <button type="submit" class="btn btn-outline-primary col-lg-12">Buscar</button>

                    </form>

                </fieldset>

            </div>

            <div class="col-lg-9">

                <fieldset>

                    <legend>Resultado Termo</legend>

                    <hr>

                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="6" id="resultado_termo"><?php if(isset($resultado_pessoa_termo)){print_r($resultado_pessoa_termo);} ?></textarea>
                        </div>
                    </div>

                </fieldset>

            </div>

        </div>

        <br>

    </div>

    <script>

    $(document).ready(function(){
        $('#form_pessoa').on('submit', function(e){

            var email = document.getElementById('email_corretor_i').value;

            $('#email_corretor').val(email);

            this.submit();
        });
    });

    $(document).ready(function(){
        $('#form_imovel').on('submit', function(e){

            var email = document.getElementById('email_corretor_i').value;

            $('#email_corretor_2').val(email);

            this.submit();
        });
    });

    $(document).ready(function(){
        $('#form_upload').on('submit', function(e){

            var email = document.getElementById('email_corretor_i').value;

            $('#email_corretor_3').val(email);

            this.submit();
        });
    });

    $(document).ready(function(){
        $('#form_termo').on('submit', function(e){

            var email = document.getElementById('email_corretor_i').value;

            $('#email_corretor_4').val(email);

            this.submit();
        });
    });

    $(document).ready(function(){
        $('#form_pessoa_imovel').on('submit', function(e){

            var email = document.getElementById('email_corretor_i').value;

            $('#email_corretor_5').val(email);

            this.submit();
        });
    });

    </script>


</body>
</html>
