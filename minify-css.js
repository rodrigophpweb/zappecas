const fs = require('fs');
const path = require('path');
const postcss = require('postcss');
const cssnano = require('cssnano');

// Diretórios para processar
const directories = [
  './assets/css/components',
  './assets/css/pages'
];

// Função para processar um arquivo CSS
async function minifyFile(filePath) {
  try {
    const css = fs.readFileSync(filePath, 'utf8');
    
    // Processar com PostCSS e cssnano
    const result = await postcss([
      cssnano({
        preset: ['default', {
          discardComments: { removeAll: true },
          normalizeWhitespace: true
        }]
      })
    ]).process(css, { from: filePath });

    // Criar o nome do arquivo minificado
    const dir = path.dirname(filePath);
    const ext = path.extname(filePath);
    const base = path.basename(filePath, ext);
    const minFilePath = path.join(dir, `${base}.min${ext}`);

    // Salvar arquivo minificado
    fs.writeFileSync(minFilePath, result.css);
    console.log(`✓ Minificado: ${filePath} → ${minFilePath}`);
  } catch (error) {
    console.error(`✗ Erro ao minificar ${filePath}:`, error.message);
  }
}

// Função para processar todos os arquivos CSS de um diretório
function processDirectory(dir) {
  if (!fs.existsSync(dir)) {
    console.log(`⚠ Diretório não encontrado: ${dir}`);
    return;
  }

  const files = fs.readdirSync(dir);
  
  files.forEach(file => {
    const filePath = path.join(dir, file);
    const stat = fs.statSync(filePath);
    
    // Processar apenas arquivos .css (não .min.css)
    if (stat.isFile() && file.endsWith('.css') && !file.endsWith('.min.css')) {
      minifyFile(filePath);
    }
  });
}

// Executar a minificação
console.log('🚀 Iniciando minificação de CSS...\n');

directories.forEach(dir => {
  console.log(`📁 Processando: ${dir}`);
  processDirectory(dir);
  console.log('');
});

console.log('✅ Minificação concluída!');
