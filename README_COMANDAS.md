# Sistema de Comandas - FlexBar

## Visão Geral

O sistema de comandas foi implementado para permitir o controle completo de pedidos em estabelecimentos esportivos, incluindo:

- Criação de comandas com nome do cliente ou número
- Adição de produtos às comandas
- Controle de status (aberta, fechada, cancelada)
- Cálculo automático de totais
- Interface responsiva e intuitiva

## Funcionalidades Principais

### 1. Listagem de Comandas
- **Grid responsivo**: Exibe todas as comandas em cards organizados
- **Filtros**: Busca por nome do cliente ou número da comanda
- **Filtro por status**: Aberta, Fechada, Cancelada
- **Informações visuais**: Status colorido, horário de abertura, total

### 2. Criação de Nova Comanda
- **Nome do cliente**: Campo obrigatório
- **Número da comanda**: Opcional (gerado automaticamente se não informado)
- **Status inicial**: Sempre "aberta"
- **Horário de abertura**: Registrado automaticamente

### 3. Gerenciamento de Comanda
- **Modal interativo**: Clique em qualquer card para abrir
- **Informações detalhadas**: Status, horários, produtos
- **Lista de produtos**: Tabela com quantidade, preço e subtotal
- **Ações disponíveis**: Adicionar produto, remover produto, fechar comanda

### 4. Adição de Produtos
- **Seleção por categoria**: Primeiro escolha a categoria
- **Seleção de produto**: Lista filtrada por categoria
- **Quantidade**: Campo numérico com validação
- **Observações**: Campo opcional para detalhes especiais
- **Preço automático**: Capturado do cadastro do produto

### 5. Controle de Status
- **Aberta**: Permite adicionar/remover produtos
- **Fechada**: Comanda finalizada, não permite alterações
- **Cancelada**: Comanda cancelada, não permite alterações

## Estrutura do Banco de Dados

### Tabela `orders`
- `id`: Identificador único
- `order_number`: Número da comanda
- `order_owner_name`: Nome do cliente
- `id_shop`: ID da loja (relacionamento)
- `status`: Status da comanda (open/closed/cancelled)
- `total_amount`: Valor total da comanda
- `opened_at`: Horário de abertura
- `closed_at`: Horário de fechamento
- `created_at` / `updated_at`: Timestamps

### Tabela `order_products`
- `id`: Identificador único
- `id_order`: ID da comanda (relacionamento)
- `id_shop`: ID da loja (relacionamento)
- `id_product`: ID do produto (relacionamento)
- `quantity`: Quantidade do produto
- `unit_price`: Preço unitário
- `notes`: Observações adicionais
- `created_at` / `updated_at`: Timestamps

## Como Usar

### 1. Acessar o Sistema
- Navegue para `/comandas` no menu lateral
- Faça login como usuário de loja

### 2. Criar Nova Comanda
- Clique no botão "Nova Comanda"
- Preencha o nome do cliente
- Opcionalmente, informe um número específico
- Clique em "Criar Comanda"

### 3. Gerenciar Comanda Existente
- Clique em qualquer card de comanda
- Visualize informações detalhadas
- Adicione produtos conforme necessário
- Feche a comanda quando finalizada

### 4. Adicionar Produtos
- Abra a comanda desejada
- Clique em "+ Adicionar Produto"
- Selecione categoria e produto
- Informe quantidade e observações
- Clique em "Adicionar"

### 5. Fechar Comanda
- Com a comanda aberta, clique em "Fechar Comanda"
- A comanda será marcada como fechada
- Não será possível fazer alterações posteriores

## Recursos Técnicos

### Tecnologias Utilizadas
- **Laravel 10**: Framework PHP
- **Livewire**: Componentes reativos
- **Tailwind CSS**: Estilização responsiva
- **MySQL**: Banco de dados

### Componentes Livewire
- `Orders`: Componente principal de gerenciamento
- Validação em tempo real
- Atualizações automáticas da interface
- Modais interativos

### Segurança
- Middleware de autenticação
- Validação de dados
- Relacionamentos por loja
- Controle de acesso por usuário

## Personalizações

### Cores e Estilo
- Interface escura com tema esportivo
- Cores personalizadas para status
- Ícones FontAwesome
- Layout responsivo para mobile

### Validações
- Nome do cliente obrigatório
- Quantidade mínima de 1
- Produto deve existir no sistema
- Categoria deve ser selecionada

## Suporte e Manutenção

### Logs
- Todas as operações são registradas
- Erros são capturados e exibidos
- Mensagens de sucesso/erro em tempo real

### Performance
- Carregamento lazy de dados
- Paginação para grandes volumes
- Índices de banco otimizados
- Cache de consultas frequentes

## Próximas Funcionalidades

- [ ] Impressão de comandas
- [ ] Histórico de comandas fechadas
- [ ] Relatórios de vendas
- [ ] Integração com sistema de pagamentos
- [ ] Notificações em tempo real
- [ ] Backup automático de dados

## Contato

Para suporte técnico ou dúvidas sobre o sistema de comandas, entre em contato com a equipe de desenvolvimento.
