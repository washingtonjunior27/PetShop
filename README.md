<h1 align="center">🐾 PetShop Project - ERP Hospitalar e Estético</h1>

<p align="center">
  <a href="https://petshop-project.infinityfreeapp.com" target="_blank">
    <img src="https://img.shields.io/badge/Link%20da%20Demo-Acesse%20Aqui-green?style=for-the-badge&logo=googlechrome&logoColor=white" alt="Link da Demo">
  </a>
</p>

### 🔑 Credenciais de Teste (Uso Interno)
O sistema possui dashboards e permissões dinâmicas. Teste com os perfis abaixo:

| Perfil | Usuário | Senha | Funcionalidade Principal |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `123456` | Gestão financeira e controle total de cadastros. |
| **Atendente** | `atendente1` | `123456` | Agendamentos, Confirmações e Lembretes. |
| **Veterinário** | `vet1` | `123456` | Consultas, Diagnósticos e Vacinação. |
| **Esteticista** | `estet1` | `123456` | Fila de banho, tosa e serviços estéticos. |

---

### 💻 Sobre o Projeto
Sistema ERP desenvolvido para gerenciar o fluxo operacional completo de um Petshop. A solução resolve desde a recepção e pagamento até o prontuário médico e o pós-venda (lembretes de vacina).

- 🔄 **Fluxo de Status Inteligente:** Agendado → Confirmado → Pago (Em atendimento) → Finalizado.
- 🛡️ **Segurança de Dados:** Diagnósticos travados por atendimento para evitar duplicidade.
- 📅 **Agenda Dinâmica:** Bloqueio automático de horários baseado no profissional e categoria do serviço.
- 💉 **Gestão de Vacinas:** Sistema de retornos automático com calculo de próxima dose.

---

### 🛠️ Tecnologias Utilizadas
<p align="left">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="PHP" width="40" height="40">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="MySQL" width="40" height="40">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="JS" width="40" height="40">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-original.svg" alt="Bootstrap" width="40" height="40">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" alt="HTML" width="40" height="40">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg" alt="CSS" width="40" height="40">
</p>

- **Arquitetura:** MVC (Model-View-Controller)
- **Design Patterns:** Singleton (Conexão), Repository Pattern
- **Ambiente:** Servidor Linux (InfinityFree) com sincronização de Timezone UTC-4 (Manaus)

---

### 🔄 Demonstração do Fluxo Operacional

O sistema implementa uma lógica de **Fila de Espera Inteligente** baseada na categoria do serviço:

#### 1. Recepção e Triagem (Atendente)
Todo serviço começa na Agenda. O atendente filtra o profissional e o horário. Assim que o pagamento é confirmado, o status muda para **"Em Atendimento"**. É esse gatilho que faz o animal aparecer na lista do profissional responsável.

#### 2. Fluxo de Estética (Esteticista)
Diferente da clínica, o Esteticista possui o módulo **"Meus Serviços"**:
- **Fila de Trabalho:** Visualiza apenas agendamentos de categoria "Estética" que já foram pagos.
- **Execução:** O sistema permite adicionar observações específicas sobre a pelagem ou comportamento do pet durante o banho/tosa.
- **Finalização:** Ao concluir, o status é atualizado e o serviço sai da fila de pendentes, alimentando o histórico de produtividade do profissional.

#### 3. Fluxo Clínico (Veterinário)
O Veterinário acessa o módulo **"Atendimento"**:
- **Prontuário e Vacina:** Registro de anamnese e diagnósticos travados (um por agendamento).
- **Vacinação Integrada:** Ao aplicar uma vacina, o sistema registra automaticamente no histórico do pet e já gera um alerta para o módulo de Lembretes caso haja próxima dose.

#### 4. Pós-Venda e Retorno (Lembretes)
O ciclo se fecha com o Atendente monitorando a tela de **Lembretes**, onde vacinas próximas do vencimento geram alertas para que novos agendamentos sejam propostos aos clientes.

---

### 📸 Visualização por Perfil

#### **Dashboard Administrativo**
- Visão global de produtividade de todos os setores.
<p align="center">
<img src="public/Assets/screenshots/Admin-Dashboard.png" width="90%" title="Dashboard Admin">
</p>

#### **Módulo do Atendente**
- Foco em controle de agendamentos com criação e confirmação, bem como controle de vacinações pendentes.
<p align="center">
<img src="public/Assets/screenshots/Atendente-Dashboard.png" width="45%" title="Dashboard atendente">
<img src="public/Assets/screenshots/Atendente-Agendamentos.png" width="45%" title="Agendamentos Atendente">
</p>

#### **Módulo do Veterinário**
- Foco em dados clínicos e histórico de saúde.
<p align="center">
<img src="public/Assets/screenshots/Veterinario-Dashboard.png" width="45%" title="Dashboard Veterinario">
<img src="public/Assets/screenshots/Veterinario-Diagnostico.png" width="45%" title="Veterinario Diagnostico">
</p>

#### **Módulo do Esteticista**
- Interface limpa focada na execução dos serviços de banho e tosa.
<p align="center">
<img src="public/Assets/screenshots/Esteticista-Dashboard.png" width="45%" title="Dashboard Esteticista">
<img src="public/Assets/screenshots/Historico-de-Servicos-Esteticos.png" width="45%" title="Visualização de Historico de Atendimento Estetico">
</p>

---

### 🛠️ Especificações Técnicas
- **PHP 8.1 / MVC**
- **Repository Pattern:** Desacoplamento da lógica de persistência.
- **Timezone Sync:** Sincronização automática para o fuso de Manaus (UTC-4).
- **UX Segura:** Interfaces que desabilitam campos clínicos para serviços estéticos e vice-versa.

---

### 📷 Imagens
- Mais imagens em /public/Assets/screenshots

### 👨‍💻 Desenvolvedor
<h3 align="left">Washington Júnior</h3>
<p align="left">
  <a href="https://www.linkedin.com/in/washington-junior-bb1540245/" target="_blank">
    <img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn">
  </a>
  <a href="mailto:washjunior4444@gmail.com">
    <img src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white" alt="Gmail">
  </a>
</p>
