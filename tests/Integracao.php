<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 01/03/2018
 * Time: 20:35
 */
class Integracao {

    private $_url;
    const METODO_POST = "POST";
    const METODO_UP = "POST";
    const METODO_PUT = "PUT";
    const METODO_GET = "GET";
    const METODO_DELETE = "DELETE";

    public function criaImovel($email_corretor,$tipo,$servico,$valor_servico,$valor_setup,$parcela_setup,$cep,$endereco,
    $numero,$bairro,$cidade,$uf,$opcional) 
    { $dados = array( 'email_corretor' => $email_corretor, 'tipo' => $tipo, 'servico' => $servico, 'valor' => $valor_servico, 
     'valor_setup' => $valor_setup, 'parcela_setup' => $parcela_setup, 'cep' => $cep,'endereco' => $endereco, 
     'numero' => $numero, 'bairro' => $bairro, 'cidade' => $cidade,'uf' => $uf, 'complemento' => $opcional['complemento'],
     'descricao' => $opcional['descricao'], 'tag' => $opcional['tag']);
        $this->_url = "https://dev.credpago.com/api/v1/imovel/novo";
        $retorno = $this->httpRequest($dados, self::METODO_POST);
        return $retorno;
    }

    public function criaPessoa($email_corretor, $id_imovel, $pessoa){
        $dados = array( 'email_corretor' => $email_corretor, 'id_imovel' => $id_imovel , 'tp_pessoa' => $pessoa['tp_pessoa'],
        'nome' => $pessoa['nome'], 'cpf' => $pessoa['cpf'], 'email' => $pessoa['email'], 
        'data_nascimento' => $pessoa['data_nascimento'], 'telefone' => $pessoa['telefone'], 'cep' => $pessoa['cep'], 
        'endereco' => $pessoa['endereco'], 'endereco_numero' => $pessoa['endereco_numero'], 'bairro' => $pessoa['bairro'], 
        'cidade' => $pessoa['cidade'], 'uf' => $pessoa['uf'], 'descricao' => $pessoa['descricao'] );
        $this->_url = "https://dev.credpago.com/api/v1/pessoa/novo";
        $retorno = $this->httpRequest($dados, self::METODO_POST);
        return $retorno;
    }

    public function criaCartao($email_corretor,$id_pessoa, $bandeira, $numero, $data_validade, $limite, $saldo, $fatura){
        $dados = array( 'email_corretor' => $email_corretor, 'id_pessoa' => $id_pessoa, 'bandeira' => $bandeira, 
        'numero' => $numero,'data_validade' => $data_validade, 'limite' => $limite, 'saldo' => $saldo, 'fatura' => $fatura);
        $this->_url = "https://dev.credpago.com/api/v1/cartao/novo";
        $retorno = $this->httpRequest($dados, self::METODO_POST);
        return $retorno;
    }
    
    public function criaSimulacao($email_corretor, $pessoa){
        $dados = array( 'email_corretor' => $email_corretor, 'cpf' => $pessoa['cpf'], 'nome' => $pessoa['nome'], 
        'limite_cartao' => $pessoa['limite_cartao'],'tipo_imovel' => $pessoa['tipo_imovel']
        $this->_url = "https://dev.credpago.com/api/v1/simulador/novo";
        $retorno = $this->httpRequest($dados, self::METODO_POST);
        return $retorno;
    }

    public function uploadPessoa($email_corretor, $anexo, $id_pessoa, $tipo){
        $arquivo_url = realpath($anexo['tmp_name']);
        $arquivo_type = $anexo['type'];
        $arquivo_name = $anexo['name'];
        if (function_exists('curl_file_create')) {
            $arquivo = curl_file_create($arquivo_url, $arquivo_type, $arquivo_name);
        } else {
            $arquivo = '@' . realpath($arquivo_url);
        }
        $dados = array( 'email_corretor' => $email_corretor, 'anexo' => $arquivo, 'id_pessoa' => $id_pessoa, 'tipo' => $tipo);
        $this->_url = "https://dev.credpago.com/api/v1/upload/pessoa";
        $retorno = $this->httpRequest($dados, self::METODO_UP);
        return $retorno;
    }

    public function alteraImovel($id_imovel,$email_corretor,$tipo,$servico,$valor,$valor_setup,$parcela_setup,$cep,$endereco,
    $numero,$bairro,$cidade,$uf,$opcional){
        $dados = array( 'email_corretor' => $email_corretor, 'tipo' => $tipo, 'servico' => $servico, 'valor' => $valor,
        'valor_setup' => $valor_setup, 'parcela_setup' => $parcela_setup,'cep' => $cep,'endereco' => $endereco, 
        'numero' => $numero, 'bairro' => $bairro, 'cidade' => $cidade,'uf' => $uf,'complemento' => $opcional['complemento'],
        'descricao' => $opcional['descricao'], 'tag' => $opcional['tag']);
        $this->_url = "https://dev.credpago.com/api/v1/imovel/altera/{$id_imovel}";
        $retorno = $this->httpRequest($dados, self::METODO_PUT);
        return $retorno;
    }

    public function alteraPessoa($email_corretor, $id_pessoa, $pessoa){
        $dados = array( 'email_corretor' => $email_corretor, 'tp_pessoa' => $pessoa['tp_pessoa'],'nome' => $pessoa['nome'], 
        'cpf' => $pessoa['cpf'], 'email' => $pessoa['email'],'data_nascimento' => $pessoa['data_nascimento'], 
        'telefone' => $pessoa['telefone'], 'cep' => $pessoa['cep'], 'endereco' => $pessoa['endereco'],
        'endereco_numero' => $pessoa['endereco_numero'], 'bairro' => $pessoa['bairro'], 'cidade' => $pessoa['cidade'], 
        'uf' => $pessoa['uf'], 'descricao' => $pessoa['descricao']);
        $this->_url = "https://dev.credpago.com/api/v1/pessoa/altera/{$id_pessoa}";
        $retorno = $this->httpRequest($dados, self::METODO_PUT);
        return $retorno;
    }

    public function alteraCartao($id_pessoa, $email_corretor, $bandeira, $numero, $data_validade, $limite, $saldo, $fatura){
        $dados = array( 'email_corretor' => $email_corretor, 'bandeira' => $bandeira, 'numero' => $numero,
            'data_validade' => $data_validade, 'limite' => $limite, 'saldo' => $saldo, 'fatura' => $fatura);
        $this->_url = "https://dev.credpago.com/api/v1/cartao/altera/{$id_pessoa}";
        $retorno = $this->httpRequest($dados, self::METODO_PUT);
        return $retorno;
    }

    public function validaImovel($id_imovel,$email_corretor,$opcao){
        $dados = array( 'email_corretor' => $email_corretor, 'opcao' => $opcao);
        $this->_url = "https://dev.credpago.com/api/v1/imovel/valida/{$id_imovel}";
        $retorno = $this->httpRequest($dados, self::METODO_PUT);
        return $retorno;
    }

    public function buscaImovel($id){
        $this->_url = "https://dev.credpago.com/api/v1/imovel/busca/{$id}";
        $retorno = $this->httpRequest(array(), self::METODO_GET);
        return $retorno;
    }

    public function buscaPessoaImovel($id){
        $this->_url = "https://dev.credpago.com/api/v1/imovel/busca/pessoa/{$id}";
        $retorno = $this->httpRequest(array(), self::METODO_GET);
        return $retorno;
    }

    public function buscaPessoa($id){
        $this->_url = "https://dev.credpago.com/api/v1/pessoa/busca/{$id}";
        $retorno = $this->httpRequest(array(), self::METODO_GET);
        return $retorno;
    }

    public function buscaCartao($id){
        $this->_url = "https://dev.credpago.com/api/v1/cartao/busca/{$id}";
        $retorno = $this->httpRequest(array(), self::METODO_GET);
        return $retorno;
    }

    public function buscaTermo($id){
        $this->_url = "https://dev.credpago.com/api/v1/pessoa/busca/termo/{$id}";
        $retorno = $this->httpRequest(array(), self::METODO_GET);
        return $retorno;
    }

    public function buscaUpload($id){
        $this->_url = "https://dev.credpago.com/api/v1/pessoa/busca/upload/{$id}";
        $retorno = $this->httpRequest(array(), self::METODO_GET);
        return $retorno;
    }

    public function deletaPessoa($id){
        $this->_url = "https://dev.credpago.com/api/v1/pessoa/deleta/{$id}";
        $retorno = $this->httpRequest(array(), self::METODO_DELETE);
        return $retorno;
    }

    private function httpRequest($parametro, $method){

        $destino = $this->_url;
        $ch = curl_init();

        if ($method === self::METODO_POST) {
            $content = 'application/json';
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parametro));
        }

        if ($method === self::METODO_GET) {
            $content = 'application/json';
            curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
            $destino .= '?' . http_build_query($parametro);
        }

        if ($method === self::METODO_UP) {
            $content = 'multipart/form-data';
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parametro);
        }

        if($method === self::METODO_PUT){
            $content = 'application/json';
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'PUT');
            $destino .= '?' . http_build_query($parametro);
        }

        if($method === self::METODO_DELETE){
            $content = 'application/json';
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'DELETE');
            $destino .= '?' . http_build_query($parametro);
        }


        $header = array(
            'Cache-Control: no-cache',
            'Content-Type: '.$content.''
        );

        $usuario = 'Seu usuario aqui';
        $senha = 'Sua senha aqui';

        curl_setopt($ch, CURLOPT_URL,$destino);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERPWD,"$usuario:$senha");
        if (curl_errno($ch)) {
            throw new Exception("Erro ao processar requisiÃ§Ã£o " . curl_error($ch));
        } else {
            $resultado = curl_exec($ch);
            curl_close($ch);
            return $resultado;
        }
    }
}
