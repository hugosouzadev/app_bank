# Sistema de transferência

Para entender melhor a funcionalidade do sistema leia a [documentação](https://drive.google.com/file/d/1zYsOgMEg4IzVyleSFWnRp0AXCAbhHJys/view?usp=sharing)

## Tenha instalado em sua maquina

- Docker
- Composer
- Git

## Setup do projeto

- PHP v7.4
- MySQL v8.0.17
- Framework: Laravel v7.24
- Ambiente Docker

## Passos para configurar o sistema

- Configure a raiz as varivaveis do MySQL dentro do arquivo **.env.example**.
- Dentro da pasta **infra\app**, configure o arquivo **.env.example** com as dados do seu ambiente laravel.
- Execute o arquivo **docker-compose.yml** na raíz do projeto.
- Execute as migrations e rode a seeder **Database**. (obs.: Usuarios comum são com ID's Pares e lojistas Impares)
- Agora é só executar os testes e pronto.