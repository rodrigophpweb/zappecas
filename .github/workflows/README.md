# 🚀 Fluxo de Deploy - Zappecas

## 📋 Ambientes Configurados

### 🔧 Homologação (Staging)
- **URL:** zp.programadorweb.com.br
- **Branch:** `staging`
- **Servidor FTP:** ftp.zp.programadorweb.com.br
- **Usuário:** dev@zp.programadorweb.com.br
- **Diretório:** /home3/prog3796/zp.programadorweb.com.br/wp-content/themes/zappecas/
- **Workflow:** `.github/workflows/deploy-staging.yml`

### 🌟 Produção
- **URL:** zappecas.com.br
- **Branch:** `main`
- **Servidor FTP:** ftp.zappecas.com.br
- **Usuário:** dev@zappecas.com.br
- **Diretório:** public_html/wp-content/themes/zappecas/
- **Workflow:** `.github/workflows/deploy.yml`

---

## 🔐 Secrets do GitHub

Configure os seguintes secrets no repositório GitHub:

1. Acesse: `Settings` → `Secrets and variables` → `Actions`
2. Adicione os secrets:
   - `FTP_PASSWORD_STAGING` - Senha FTP do ambiente de homologação
   - `FTP_PASSWORD_PRODUCTION` - Senha FTP do ambiente de produção

---

## 📝 Fluxo de Trabalho

### 1️⃣ Desenvolvimento e Homologação

```bash
# Crie ou mude para a branch staging
git checkout -b staging
# ou
git checkout staging

# Faça suas alterações
git add .
git commit -m "feat: nova funcionalidade"

# Envie para homologação
git push origin staging
```

✅ O deploy automático será executado para **zp.programadorweb.com.br**

### 2️⃣ Validação do Cliente

Após o cliente validar as alterações em homologação, promova para produção:

```bash
# Volte para a branch main
git checkout main

# Faça merge da branch staging
git merge staging

# Envie para produção
git push origin main
```

✅ O deploy automático será executado para **zappecas.com.br**

---

## 🔄 Comandos Úteis

### Criar a branch staging pela primeira vez
```bash
git checkout -b staging
git push -u origin staging
```

### Atualizar staging com as alterações da main
```bash
git checkout staging
git merge main
git push origin staging
```

### Ver status dos deploys
Acesse: `Actions` no GitHub para ver os logs dos deploys

---

## ⚠️ Importante

- **NUNCA** faça push direto para `main` sem passar por `staging`
- Sempre valide em homologação antes de promover para produção
- Em caso de emergência, você pode fazer hotfix direto na `main`, mas depois sincronize com `staging`

---

## 🆘 Troubleshooting

### Deploy não executou
1. Verifique se os secrets estão configurados corretamente
2. Verifique os logs em `Actions` no GitHub
3. Confirme que está fazendo push para a branch correta

### Erro de conexão FTP
1. Verifique se o servidor FTP está acessível
2. Confirme usuário e senha nos secrets
3. Verifique se o caminho do diretório está correto

### Arquivos não aparecem no servidor
1. Confirme o `server-dir` no arquivo de workflow
2. Verifique permissões do diretório no servidor
3. Aguarde alguns minutos (pode haver cache)
