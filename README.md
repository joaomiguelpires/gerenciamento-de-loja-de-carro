# 🚗 Sistema de Gerenciamento de Loja de Carros

Sistema completo para gerenciamento de estoque de carros com interface moderna e funcionalidades CRUD.

## ✨ Funcionalidades

- ✅ **Login/Logout** com autenticação
- ✅ **Listagem** de carros com busca
- ✅ **Cadastro** de novos carros
- ✅ **Edição** de carros existentes
- ✅ **Exclusão** de carros
- ✅ **Interface responsiva** e moderna
- ✅ **Validação** de formulários
- ✅ **Mensagens** de feedback

## 🛠️ Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)
- XAMPP, WAMP ou similar

## 📦 Instalação

### 1. Configuração do Banco de Dados

1. Acesse o phpMyAdmin ou seu gerenciador MySQL
2. Execute o arquivo `database.sql` para criar:
   - Banco de dados `loja_carros`
   - Tabela `carros` com estrutura completa
   - Dados de exemplo

### 2. Configuração do Projeto

1. Clone ou baixe os arquivos para a pasta do seu servidor web
2. Verifique se a configuração do banco está correta em `config/database.php`:
   ```php
   private $host = 'localhost';
   private $db_name = 'loja_carros';
   private $username = 'root';
   private $password = '';
   ```

### 3. Acesso ao Sistema

1. Acesse `http://localhost/seu-projeto/login.php`
2. Use as credenciais padrão:
   - **Usuário:** `admin`
   - **Senha:** `1234`

## 🎨 Interface

O sistema possui uma interface moderna com:

- **Design responsivo** para desktop e mobile
- **Gradientes** e animações suaves
- **Ícones** do Bootstrap Icons
- **Feedback visual** para todas as ações
- **Validação** em tempo real

## 📋 Estrutura do Projeto

```
workphp/
├── assets/
│   ├── css/
│   │   └── style.css          # Estilos personalizados
│   ├── js/
│   │   └── scripts.js         # JavaScript
│   └── imagens/               # Imagens do projeto
├── config/
│   └── database.php           # Configuração do banco
├── controllers/
│   └── CarroController.php    # Lógica de negócio
├── models/
│   └── CarroModel.php         # Acesso aos dados
├── views/
│   └── carros/
│       ├── listar.php         # Lista de carros
│       └── criar.php          # Formulário de cadastro
├── index.php                  # Página principal
├── login.php                  # Página de login
├── logout.php                 # Logout
├── database.sql               # Estrutura do banco
└── README.md                  # Este arquivo
```

## 🔧 Funcionalidades Detalhadas

### Cadastro de Carros
- Modelo e marca (obrigatórios)
- Ano de fabricação e modelo
- Cor, placa e chassi
- Quilometragem
- Preços de compra e venda
- Status (disponível, vendido, reservado, manutenção)

### Listagem e Busca
- Tabela responsiva com todos os carros
- Busca por marca
- Status com badges coloridos
- Ações de editar e excluir

### Segurança
- Autenticação obrigatória
- Validação de dados
- Proteção contra SQL injection
- Sessões seguras

## 🚀 Como Usar

1. **Login:** Acesse o sistema com as credenciais
2. **Listar:** Visualize todos os carros cadastrados
3. **Novo:** Clique em "Novo Carro" para cadastrar
4. **Editar:** Use o botão editar para modificar
5. **Excluir:** Confirme a exclusão no botão excluir
6. **Buscar:** Use a barra de busca para filtrar
7. **Logout:** Clique em "Sair" para encerrar

## 🔒 Segurança

- **Autenticação:** Sistema de login obrigatório
- **Validação:** Todos os dados são validados
- **SQL Injection:** Proteção com prepared statements
- **XSS:** Escape de dados na saída

## 📱 Responsividade

O sistema é totalmente responsivo e funciona em:
- 📱 Smartphones
- 📱 Tablets
- 💻 Desktops
- 🖥️ Monitores grandes

## 🎯 Próximas Melhorias

- [ ] Upload de imagens dos carros
- [ ] Relatórios de vendas
- [ ] Dashboard com gráficos
- [ ] Sistema de usuários múltiplos
- [ ] Backup automático
- [ ] API REST

## 📞 Suporte

Para dúvidas ou problemas:
1. Verifique se o banco está configurado corretamente
2. Confirme se o PHP e MySQL estão funcionando
3. Verifique os logs de erro do servidor

---

**Desenvolvido com ❤️ usando PHP, MySQL e Bootstrap** 