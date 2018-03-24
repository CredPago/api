# [API CredPago](http://github.com/CredPago/api)

Versão 1 da API para integração.<br>

## Descrição

Integração via PHP<br>
Criação de solicitações<br>
Edição de solicitações<br>
Envio de solicitações

## Aviso Legal

A propriedade do conteúdo da Biblioteca API CredPago pertence a CredPago. O conteúdo da Biblioteca API CredPago só pode ser usado mediante a liberação de um usuário autorizado pela CredPago e apenas sendo utilizado com os serviços da CredPago. A biblioteca é oferecida e / ou distribuída "COMO ESTÁ", SEM GARANTIAS OU CONDIÇÕES DE QUALQUER TIPO, expressas ou implícitas. A CredPago não garante que a biblioteca ou qualquer conteúdo estará disponível ininterruptamente ou livre de erros, que os defeitos serão corrigidos ou que a biblioteca ou seus sistemas de suporte estejam livres de vírus ou bugs. Por favor, consulte a CredPago para saber mais sobre o produto.

## Primeiro uso

Após pedir a liberação da API para uso em sua imobiliária/portal, aqui vai algumas regras básicas <br>

Para consultas via API você deve enviar a requisição sempre acompanhada do email do usuário do sistema, como no exemplo a seguir, onde para consultar um imóvel é necesesário enviar o id do imóvel concatenado com o email do usuário: <br>

```bash
1234-usuario@credpago.com
```

Para insercão de dados você também deve enviar o email do usuário, porém o email irá no parametro como nos exemplos localizados na pasta tests.
