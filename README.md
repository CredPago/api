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


## Criar/Alterar um imóvel

Utilize a classe criaImovel() para criar um novo imóvel, note que, você deve preencher todos os parâmetros necessários para ser criado o imóvel.
```bash
criaImovel('email@corretor.com','1','1','50000','120','3','89201330','Rua Mario Lobo','61','Centro','Joinville','SC')
```

Com o envio de sua requisição, será retornado um cabeçalho Json, contendo um 'status', podendo ser 'sucesso' ou 'erro', e também uma mensagem com o tipo do erro, e caso o status seja de 'sucesso', o número do imóvel criado.

<br>

Para alterar um imóvel você deve utilizar a classe alteraImovel(), preenchendo todos os parâmetros como mostrado acima, porém dessa vez você deve enviar o número do imóvel a ser alterado junto a requisição, como mostra o exemplo abaixo:

```bash
alteraImovel('1234','email@corretor.com','1','1','50000','120','3','89201330','Rua Mario Lobo','61','Centro','Joinville','SC')
```

Todos os imóveis criados pela API serão gerados como um rascunho.

## Criar/Alterar uma pessoa

Para criar uma pessoa você deve ter o número do imóvel previamente criado e preencher os dados da pessoa em um array, como no exemplo abaixo:

```bash
criaPessoa('email@corretor.com', '1234', array[dados da pessoa] )
```
Com o envio de sua requisição, será retornado um cabeçalho Json, contendo um 'status', podendo ser 'sucesso' ou 'erro', e também uma mensagem com o tipo do erro, e caso o status seja de 'sucesso', o número da pessoa criada.

<br>

Caso queira alterar uma pessoa você deve utilizar a classe alteraPessoa(), seguindo a mesma ideia do exemplo acima, porém ao invés de mandar o número do imóvel, você deve enviar o id da pessoa:

```bash
alteraPessoa('email@corretor.com', '1212', array[dados da pessoa] )
```

## Criar/Alterar um cartão

Para criar um cartão você deve utilizar a classe criaCartao(), e preencher todos os parâmetros exigidos:

```bash
criaCartao('email@corretor.com','1212','MasterCard','5555555555555557','09/2022','100000','80000','15000')
```
Com o envio de sua requisição, será retornado um cabeçalho Json, contendo um 'status', podendo ser 'sucesso' ou 'erro', e também uma mensagem com o tipo do erro, e caso o status seja de 'sucesso' irá ser informado que seu cartão foi criado.

<br>

Para alteração, você deve utilizar a classe alteraCartao(), como no exemplo da alteração da pessoa, você deve adicionar como parâmetro o id da pessoa, como no exemplo abaixo:

```bash
criaCartao('1212','email@corretor.com','1212','MasterCard','5555555555555557','09/2022','100000','80000','15000')
```
Note que, caso o tipo de imóvel seja 'Universitário', e o inquilino universitário seja menor de 24 anos, o mesmo não necessita de um cartão de crédito, porém o seu tutor sendo corresponsável ou um inquilino, necessita normalmente de um cartão válido.


## Upload de documentos

Para o envio de um arquivo, sendo uma imagem ou um PDF, você deve utilizar a classe uploadPessoa(), contendo o e-mail do corretor e um array, cotendo o caminho do arquivo, tipo do arquivo e o nome do arquivo, caso não possua nenhum desses parâmetros, o servidor pode rejeitar o seu upload e bloquear sua chave por algumas horas, é necessário também o id da pessoa e o tipo de upload, como '1' sendo para faturas e '2' para documentos, exemplo abaixo:

```bash
uploadPessoa('email@corretor.com',array[tmp_name, type, name],'1212', 1)
```
Com o envio de sua requisição, será retornado um cabeçalho Json, contendo um 'status', podendo ser 'sucesso' ou 'erro', e também uma mensagem com o tipo do erro, e caso o status seja de 'sucesso' irá ser informado que seu upload foi enviado.

