# API RESTful Consultamais
O consumo desta api é simples, seguindo o padrão `RESTful.

Aqui destrinchamos o exemplo de requisição que você vai encontrar no arquivo PHP `index.php` que constitui este repositório.
              
# Inicio
No começo do código iniciamos o cURL
```
2   $curl = curl_init();
```

# Método da requisição
Requisições só serão aceitas utilizando o método REST `GET`. <br>
Setamos o método diretamente em uma variável.
```
4   $tipoRequisicao = "GET";
```

# Parametros enviados na requisição
Para realizar a consulta é necessário o envio do [ID da consulta](#lista-das-consultas), e o número do documento a ser consultado. <br>
```
6    $idConsulta = 00;
7    $documento = 00000000000;
```

Os dois parâmetros são abstraídos da URL.
```
8   $url = "https://api.consultamais.dev/consulta/id/{$idConsulta}/documento/{$documento}";
```

Exemplo de URL para requisição com números fictícios.
```
GET https://api.consultamais.dev/consulta/id/00/documento/00000000000
```

# Autenticação
Autenticação utiliza um `token JWT` gerado automaticamente, para acessalo você precisa acessar a sua conta no Consultamais e [entrar pa página de API](https://consultamais.com.br/api-consultamais/), copiar o token e utilizar no cabeçalho das requisições. O tipo de autenticação é `Bearer
```
10    $tipoAutenticacao = "Bearer";
11    $token = "000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000";
```

 

# Declaração do cURL
Declaramos o CURL e setamos todas as variáveis declaradas previamente. 
```
13    curl_setopt_array($curl, array(
14        CURLOPT_URL => $url,
15        CURLOPT_RETURNTRANSFER => true,
16        CURLOPT_ENCODING => "",
17        CURLOPT_MAXREDIRS => 10,
18        CURLOPT_TIMEOUT => 30,
19        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
20        CURLOPT_CUSTOMREQUEST => $tipoRequisicao,
21        CURLOPT_POSTFIELDS => "",
22        CURLOPT_HTTPHEADER => array(
23            "authorization: {$tipoAutenticacao} {$token}"
24        ),
25    ));
```

# Finalizando requisição
Finalizando a requisição.
```
27    $response = curl_exec($curl);
28    $err = curl_error($curl);
29    
30    curl_close($curl);
31    
32    if ($err) {
33        echo "cURL Error #:" . $err;
34    } else {
35        echo $response;
36    }
```

# Resposta - Sucesso
```
STATUS HTTP 200
```

###### Cabeçalho
```
Date	Thu, 20 Aug 2020 14:51:09 GMT
Server	Apache
Cache-Control	max-age=0, must-revalidate, private
Expires	Thu, 20 Aug 2020 14:51:16 GMT
Vary	Authorization
Transfer-Encoding	chunked
Content-Type	application/json
```

###### Corpo
```
{
  "versao": "1.0",
  "retorno": {
    "status": {
      "codigo": 200,
      "menssage": "Requisição finalizada com sucesso."
    },
    "solicitante": {
      "nome": "Matheus Camargo Xavier",
      "email": "matheus@consultamais.com.br",
      "ip": [
        "123.45.6.7"
      ],
      "data": "01\/08\/2020 22:27:13"
    },
    "consulta": {
      
      }
    }
  }
}
```

# Resposta - Erro
```
400: Bad request
401: Unauthorized
404: Cannot be found 
50X: Server Error
```

###### Erro autenticação
```
{
  "versao": "1.0",
  "retorno": {
    "status": {
      "codigo": 401,
      "menssage": "Falha na autenticação."
    },
    "solicitante": [
      null
    ],
    "consulta": [
      null
    ]
  }
}
```

###### Erro no ID da consulta
```
{
  "versao": "1.0",
  "retorno": {
    "status": {
      "codigo": 400,
      "menssage": "Consulta inválida."
    },
    "solicitante": {
      "nome": "Matheus Camargo Xavier",
      "email": "matheus@consultamais.com.br",
      "ip": [
        "123.45.6.7"
      ],
      "data": "01\/08\/2020 22:27:13"
    },
    "consulta": [
      null
    ]
  }
}
```

###### Erro na validação do documento
```
{
  "versao": "1.0",
  "retorno": {
    "status": {
      "codigo": 400,
      "menssage": "Documento inválido."
    },
    "solicitante": {
      "nome": "Matheus Camargo Xavier",
      "email": "matheus@consultamais.com.br",
      "ip": [
        "123.45.6.7"
      ],
      "data": "01\/08\/2020 22:27:13"
    },
    "consulta": [
      null
    ]
  }
}
```

###### Erro créditos
```
{
  "versao": "1.0",
  "retorno": {
    "status": {
      "codigo": 400,
      "menssage": "Créditos insuficientes, faça uma recarga."
    },
    "solicitante": {
      "nome": "Matheus Camargo Xavier",
      "email": "matheus@consultamais.com.br",
      "ip": [
        "123.45.6.7"
      ],
      "data": "01\/08\/2020 22:27:13"
    },
    "consulta": [
      null
    ]
  }
}
```

# Lista das consultas
- ID 68 - [Consulta Essencial Positivo CPF](https://consultamais.com.br/essencial-positivo/)
- ID 56 - [Consulta Básica CPF](https://consultamais.com.br/basica/)
- ID 57 - [Consulta Essencial CPF](https://consultamais.com.br/consulta-essencial/)
- ID 58 - [Consulta Completa CPF](https://consultamais.com.br/consulta-completa/)
- ID 59 - [Consulta Econômica CPF](https://consultamais.com.br/economica/)
- ID 60 - [Consulta Cheque CPF](https://consultamais.com.br/consulta-cheque-cpf/)
- ID 61 - [Consulta cheque CNPJ](https://consultamais.com.br/consulta-cheque-cnpj/)
- ID 62 - [Consulta Cadastro CPF](https://consultamais.com.br/cadastro-cpf/)
- ID 63 - [Completa CNPJ](https://consultamais.com.br/completa-empresa/)
- ID 64 - [Consulta Risco CNPJ](https://consultamais.com.br/consulta-risco/)
- ID 65 - [Consulta Cadastro CNPJ](https://consultamais.com.br/cadastro-cnpj/)
- ID 66 - [Consulta Relatório Analítico Nacional CNPJ](https://consultamais.com.br/relatorio-analitico-nacional/)


# Outras informações
Todas as suas consultas ficam salvas.
Você pode busca-las dentro do nosso site com o id de registro que é enviado junto com a consulta.
Qualquer dúvida sobre a implementação ficamos a disposição para informações.

Matheus Camargo Xavier - matheus@consultamais.com.br <br>
Arthur Bonilha - arthur.bonilha@consultamais.com.br
____________

