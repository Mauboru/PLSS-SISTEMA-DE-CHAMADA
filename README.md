# PLSS - Sistema de Chamada

## 📌 Sobre o Projeto
O **PLSS - Sistema de Chamada** é um sistema desenvolvido para gerenciamento de chamadas. Ele permite a categorização e o acompanhamento da situação das chamadas de maneira eficiente.

---

## 🚀 Como Instalar e Executar

Siga os passos abaixo para configurar e rodar o projeto localmente.


### 📦 1. Instalar Dependências
```sh
 composer install
```

### 🔑 2. Configurar o Ambiente
Crie um arquivo `.env` baseado no `.env.example`.
Se estiver configurando do zero, gere a chave da aplicação:
```sh
 php artisan key:generate
```

### 📂 3. Criar Estrutura do Banco de Dados
```sh
 php artisan migrate
```

### 🏷️ 4. Popular Banco de Dados
```sh
 php artisan db:seed --class=CategoriaSeeder
 php artisan db:seed --class=SituacaoSeeder
```

### ▶️ 5. Iniciar o Servidor
```sh
 php artisan serve
```
Acesse o sistema em: [http://localhost:8000](http://localhost:8000)

---

## 🛠 Tecnologias Utilizadas
- **PHP** (Laravel Framework)
- **Composer** (Gerenciador de dependências)
- **MySQL** (Banco de Dados)

---

## 📄 Licença
Este projeto está sob a licença MIT.

📌 Desenvolvido por **[Josué Henrique]**

