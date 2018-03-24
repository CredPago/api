<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

if (!empty($_POST['email_corretor'])) {

    require "Integracao.php";

    //print_r($_POST);
    //print_r($_FILES);

    $enviado = true;

    $email_corretor = $_POST['email_corretor'];

    $tp_imovel = $_POST['tp_imovel'];
    $tp_servico = $_POST['tp_servico'];
    $valor = $_POST['valor'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];

    $tp_pessoa = $_POST['tp_pessoa'];
    $nome_pessoa = $_POST['nome'];
    $email_pessoa = $_POST['email'];
    $cpf_pessoa = $_POST['cpf'];
    $data_nascimento_pessoa = $_POST['data_nascimento'];
    $telefone_pessoa = $_POST['telefone'];
    //$descricao_pessoa = $_POST['descricao'];

    $cep_pessoa = $_POST['cep_pessoa'];
    $endereco_pessoa = $_POST['endereco_pessoa'];
    $endereco_numero_pessoa = $_POST['endereco_numero_pessoa'];
    $bairro_pessoa = $_POST['bairro_pessoa'];
    $cidade_pessoa = $_POST['cidade_pessoa'];
    $uf_pessoa = $_POST['uf_pessoa'];

    $bandeira = $_POST['bandeira'];
    $numero_cartao = $_POST['numero_cartao'];
    $data_validade = $_POST['data_validade'];
    $limite = $_POST['limite'];
    $saldo = $_POST['saldo'];
    $fatura = $_POST['fatura'];

    $anexo = $_FILES['anexo'];

    $obj = new Integracao();
    var_dump($resultado_imovel = $obj->criaImovel($email_corretor,$tp_imovel,$tp_servico,$valor,$cep,$endereco,$numero,$bairro,$cidade,$uf));
    echo '<br>';
    $resultado_imovel = json_decode($resultado_imovel, true);

    if ($resultado_imovel['status'] == 'sucesso') {

        $pessoa = array('tp_pessoa' => $tp_pessoa, 'nome' => $nome_pessoa, 'email' => $email_pessoa, 'cpf' => $cpf_pessoa, 'data_nascimento' => $data_nascimento_pessoa, 'telefone' => $telefone_pessoa,
            'cep' => $cep_pessoa, 'endereco' => $endereco_pessoa, 'endereco_numero' => $endereco_numero_pessoa, 'bairro' => $bairro_pessoa, 'cidade' => $cidade_pessoa, 'uf' => $uf_pessoa, 'descricao' => '');

        $id_imovel = $resultado_imovel['id_imovel'];

        $obj = new Integracao();
        var_dump($resultado_pessoa = $obj->criaPessoa($email_corretor, $id_imovel, $pessoa));
        echo '<br>';
        $resultado_pessoa = json_decode($resultado_pessoa, true);

        if ($resultado_pessoa['status'] == 'sucesso') {

            $id_pessoa = $resultado_pessoa['id_pessoa'];

            $obj = new Integracao();
            var_dump($resultado_cartao = $obj->criaCartao($email_corretor,$id_pessoa,$bandeira,$numero_cartao,$data_validade,$limite,$saldo,$fatura));
            $resultado_cartao = json_decode($resultado_cartao, true);

            if ($resultado_cartao['status'] == 'sucesso') {

                $obj = new Integracao();
                var_dump($resultado_upload = $obj->uploadPessoa($email_corretor,$anexo,$id_pessoa, 1));
                $resultado_upload = json_decode($resultado_upload, true);

                if ($resultado_upload['status'] == 'sucesso') {
                    echo "huehue";
                    echo $text = $resultado_upload['msg'];
                    $alert = 'success';

                } else {
                    echo $text = $resultado_upload['msg'];
                }

            } else {

                $text = $resultado_cartao['msg'];

            }

        } else {

            $text = $resultado_pessoa['msg'];
            $alert = 'warning';

        }

    } else {

        $text = $resultado_imovel['msg'];
        $alert = 'warning';

    }


    /*$resultado = json_decode($resultado, true);

    if ($resultado['status'] == 'erro') {

        $text = $resultado['msg'];
        $alert = 'warning';

    } else {

        $text = $resultado['msg'];
        $alert = 'success';

    }*/

} else {

    $enviado = false;

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

<?php if (!$enviado){ ?>

<div class="container" id="div_form">

    <form action="index.php" method="post" enctype="multipart/form-data" id="form_api">

    <div class="row">

        <div class="col-lg-4">

            <fieldset>

                <legend>Dados imóvel</legend>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">E-mail Corretor</label>
                    <input type="email" name="email_corretor" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select class="form-control" name="tp_imovel">
                        <option value="1">Residencial</option>
                        <option value="2">Comercial</option>
                        <option value="3">Universitário</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Serviço</label>
                    <select class="form-control" name="tp_servico">
                        <option value="1">Tradicional</option>
                        <option value="2">Smart</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Valor</label>
                    <input type="text" name="valor" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">CEP</label>
                    <input type="number" name="cep" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Endereço</label>
                    <input type="text" name="endereco" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Numero</label>
                    <input type="number" name="numero" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bairro</label>
                    <input type="text" name="bairro" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Cidade</label>
                    <input type="text" name="cidade" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">UF</label>
                    <input type="text" name="uf" class="form-control" placeholder="">
                </div>

            </fieldset>

        </div>

        <div class="col-lg-4">

            <fieldset>

                <legend>Dados inquilino</legend>

                <hr>

                <div class="form-group">
                    <label>Tipo Pessoa</label>
                    <select class="form-control" name="tp_pessoa">
                        <option value="I">Inquilino</option>
                        <option value="C">Corresponsável</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nome Pessoa</label>
                    <input type="text" name="nome" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">E-mail Pessoa</label>
                    <input type="text" name="email" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">CPF Pessoa</label>
                    <input type="text" name="cpf" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Data Nascimento Pessoa</label>
                    <input type="text" name="data_nascimento" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone Pessoa</label>
                    <input type="text" name="telefone" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">CEP Pessoa</label>
                    <input type="number" name="cep_pessoa" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Endereço Pessoa</label>
                    <input type="text" name="endereco_pessoa" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Numero Pessoa</label>
                    <input type="number" name="endereco_numero_pessoa" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Bairro Pessoa</label>
                    <input type="text" name="bairro_pessoa" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Cidade Pessoa</label>
                    <input type="text" name="cidade_pessoa" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">UF Pessoa</label>
                    <input type="text" name="uf_pessoa" class="form-control" placeholder="">
                </div>

            </fieldset>


            <hr>

        </div>

        <div class="col-lg-4">

            <fieldset>

                <legend>Dados cartão</legend>

                <hr>

                <div class="form-group">
                    <label>Bandeira</label>
                    <select class="form-control" name="bandeira">
                        <option>American Express</option>
                        <option>Dinners</option>
                        <option>Elo</option>
                        <option>HiperCard</option>
                        <option>Hiper</option>
                        <option>MasterCard</option>
                        <option>Visa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Numero</label>
                    <input type="text" name="numero_cartao" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Data Validade</label>
                    <input type="text" name="data_validade" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Limite</label>
                    <input type="text" name="limite" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Saldo</label>
                    <input type="text" name="saldo" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Fatura</label>
                    <input type="text" name="fatura" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label>Fatura Inquilino</label>
                    <input type="file" class="form-control-file" name="anexo">
                </div>

            </fieldset>


            <hr>

        </div>


        <button type="submit" class="btn btn-outline-primary col-lg-12">Enviar</button>

    </div>
    </form>

</div>

<? } else { ?>

<div class="container" id="div_resultado">

    <div class="alert alert-<?php echo $alert; ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Atenção!</h4>
        <p class="mb-0"><?php echo $text; ?></p>
    </div>

</div>

<?php } ?>


</body>
</html>
