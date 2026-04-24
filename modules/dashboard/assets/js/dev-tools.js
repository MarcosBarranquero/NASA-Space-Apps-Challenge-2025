/**
 * SpaceCrafter - Script de Desarrollo
 * Utilidades para resetear datos y testing
 */

// Función para resetear todos los datos a valores por defecto
function resetAllData() {
  if (confirm('⚠️ Esto eliminará todos los cambios locales. ¿Continuar?')) {
    localStorage.clear();
    
    // Recargar datos desde los seed files
    if (window.SEED_HABITATS) {
      window.SEED_HABITATS.forEach(h => h.status = h.id === 'HAB-001' ? 'published' : 'draft');
    }
    
    showToast('success', 'Datos reseteados correctamente');
    setTimeout(() => location.reload(), 1000);
  }
}

// Función para exportar todos los datos actuales
function exportAllData() {
  const allData = {
    habitats: window.SEED_HABITATS || [],
    presets: window.SEED_PRESETS || [],
    user: window.SEED_USERS?.current || {},
    analytics: window.SEED_ANALYTICS || {},
    preferences: JSON.parse(localStorage.getItem('spacecrafter_prefs') || '{}'),
    timestamp: new Date().toISOString()
  };
  
  downloadJSON(allData, `spacecrafter-backup-${Date.now()}.json`);
  showToast('success', 'Datos exportados correctamente');
}

// Función para importar datos desde archivo JSON
function importData(file) {
  const reader = new FileReader();
  reader.onload = function(e) {
    try {
      const data = JSON.parse(e.target.result);
      
      if (data.habitats) window.SEED_HABITATS = data.habitats;
      if (data.user) window.SEED_USERS.current = data.user;
      if (data.preferences) {
        localStorage.setItem('spacecrafter_prefs', JSON.stringify(data.preferences));
      }
      
      showToast('success', 'Datos importados correctamente');
      setTimeout(() => location.reload(), 1000);
    } catch (err) {
      showToast('error', 'Error al importar datos: ' + err.message);
    }
  };
  reader.readAsText(file);
}

// Función para generar datos de prueba adicionales
function generateTestData(count = 5) {
  const tags = ['Luna', 'Marte', 'Tránsito', 'Órbita'];
  const statuses = ['draft', 'published'];
  const moduleTypes = ['vital', 'power', 'cabin', 'galley', 'lab', 'gym', 'storage', 'passage_h'];
  
  for (let i = 0; i < count; i++) {
    const id = `HAB-TEST-${Date.now()}-${i}`;
    const habitat = {
      id,
      name: `Test Habitat ${i + 1}`,
      tags: [tags[Math.floor(Math.random() * tags.length)]],
      score: (Math.random() * 2 + 3).toFixed(1),
      modules: Array.from({ length: Math.floor(Math.random() * 10) + 5 }, 
        () => moduleTypes[Math.floor(Math.random() * moduleTypes.length)]),
      status: statuses[Math.floor(Math.random() * statuses.length)],
      updatedAt: new Date(Date.now() - Math.random() * 30 * 24 * 60 * 60 * 1000).toISOString(),
      cellsUsed: Math.floor(Math.random() * 40) + 15
    };
    
    if (window.SEED_HABITATS) {
      window.SEED_HABITATS.push(habitat);
    }
  }
  
  showToast('success', `${count} hábitats de prueba generados`);
  setTimeout(() => location.reload(), 1000);
}

// Función para limpiar hábitats de prueba
function cleanTestData() {
  if (window.SEED_HABITATS) {
    const original = window.SEED_HABITATS.length;
    window.SEED_HABITATS = window.SEED_HABITATS.filter(h => !h.id.startsWith('HAB-TEST-'));
    const removed = original - window.SEED_HABITATS.length;
    showToast('success', `${removed} hábitats de prueba eliminados`);
    setTimeout(() => location.reload(), 1000);
  }
}

// Función para simular carga de presets
function loadPresetSimulation(presetId) {
  const preset = window.SEED_PRESETS?.find(p => p.id === presetId);
  if (!preset) {
    showToast('error', 'Preset no encontrado');
    return;
  }
  
  console.log('🚀 Cargando preset:', preset.title);
  console.log('Tripulación:', preset.crew);
  console.log('Duración:', preset.durationDays, 'días');
  console.log('Módulos:', preset.modules);
  
  showToast('info', `Preset "${preset.title}" cargado en consola`);
}

// Función para debug de módulos
function debugModules() {
  if (typeof MODULE_CATALOG === 'undefined') {
    console.error('❌ MODULE_CATALOG no está cargado. Asegúrate de importar specs.js');
    return;
  }
  
  console.log('📦 Total de módulos:', Object.keys(MODULE_CATALOG).length);
  console.log('Categorías:', [...new Set(Object.values(MODULE_CATALOG).map(m => m.category))]);
  console.table(Object.entries(MODULE_CATALOG).map(([key, val]) => ({
    key,
    name: val.name,
    category: val.category,
    hasImage: !!val.image
  })));
}

// Panel de desarrollo (agregar al DOM)
function showDevPanel() {
  const panel = document.createElement('div');
  panel.id = 'devPanel';
  panel.style.cssText = `
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #1a1a2e;
    color: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    z-index: 10000;
    min-width: 300px;
    font-family: monospace;
  `;
  
  panel.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
      <h4 style="margin: 0; font-size: 1rem;">🛠️ Dev Tools</h4>
      <button onclick="document.getElementById('devPanel').remove()" style="background: none; border: none; color: white; cursor: pointer; font-size: 1.2rem;">×</button>
    </div>
    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
      <button onclick="resetAllData()" style="padding: 0.5rem; background: #e74c3c; border: none; border-radius: 6px; color: white; cursor: pointer;">🔄 Reset Data</button>
      <button onclick="exportAllData()" style="padding: 0.5rem; background: #3498db; border: none; border-radius: 6px; color: white; cursor: pointer;">💾 Export All</button>
      <button onclick="generateTestData()" style="padding: 0.5rem; background: #2ecc71; border: none; border-radius: 6px; color: white; cursor: pointer;">🧪 Generate Tests</button>
      <button onclick="cleanTestData()" style="padding: 0.5rem; background: #f39c12; border: none; border-radius: 6px; color: white; cursor: pointer;">🧹 Clean Tests</button>
      <button onclick="debugModules()" style="padding: 0.5rem; background: #9b59b6; border: none; border-radius: 6px; color: white; cursor: pointer;">📦 Debug Modules</button>
    </div>
    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #444; font-size: 0.75rem; opacity: 0.7;">
      Presiona <kbd>Ctrl+Shift+D</kbd> para cerrar
    </div>
  `;
  
  document.body.appendChild(panel);
}

// Atajo de teclado para abrir panel de desarrollo
document.addEventListener('keydown', function(e) {
  if (e.ctrlKey && e.shiftKey && e.key === 'D') {
    e.preventDefault();
    const existing = document.getElementById('devPanel');
    if (existing) {
      existing.remove();
    } else {
      showDevPanel();
    }
  }
});

// Exportar funciones para uso en consola
window.DevTools = {
  resetAllData,
  exportAllData,
  importData,
  generateTestData,
  cleanTestData,
  loadPresetSimulation,
  debugModules,
  showDevPanel
};

// Mensaje de bienvenida en consola
console.log(`
%c🚀 SpaceCrafter Dev Tools
%cFunciones disponibles:
- DevTools.resetAllData() - Resetear datos
- DevTools.exportAllData() - Exportar backup
- DevTools.generateTestData(n) - Generar n hábitats de prueba
- DevTools.cleanTestData() - Limpiar datos de prueba
- DevTools.debugModules() - Ver módulos cargados
- DevTools.showDevPanel() - Mostrar panel de desarrollo
- Ctrl+Shift+D - Toggle panel de desarrollo

%c👨‍💻 Happy coding!
`, 
'color: #667eea; font-size: 18px; font-weight: bold;',
'color: #764ba2; font-size: 12px;',
'color: #2ecc71; font-size: 14px;'
);
