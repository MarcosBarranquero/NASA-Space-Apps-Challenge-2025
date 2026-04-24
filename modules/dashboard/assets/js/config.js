/**
 * SpaceCrafter - Configuración Global
 */

window.SPACECRAFTER_CONFIG = {
  // Información de la aplicación
  app: {
    name: 'SpaceCrafter',
    version: '1.0.0',
    description: 'Herramienta visual para diseñar hábitats espaciales',
    competition: 'NASA Space Apps Challenge 2025'
  },

  // Rutas base
  paths: {
    base: '/modules/dashboard/',
    habitat: '/modules/habitat/',
    assets: '/modules/dashboard/assets/',
    data: '/modules/dashboard/_data/'
  },

  // Configuración de la aplicación
  settings: {
    defaultTheme: 'light',
    defaultUnits: 'SI',
    defaultLanguage: 'es',
    toastDuration: 3000,
    maxHabitats: 50,
    maxModulesPerHabitat: 100
  },

  // Límites y validaciones
  limits: {
    minCrew: 1,
    maxCrew: 20,
    minDuration: 1,
    maxDuration: 1000,
    minCells: 4,
    maxCells: 200,
    minScore: 0,
    maxScore: 5
  },

  // Categorías de módulos
  categories: {
    life_support: 'Soporte Vital',
    power: 'Energía',
    habitation: 'Habitación',
    operations: 'Operaciones',
    wellness: 'Bienestar',
    production: 'Producción',
    connectivity: 'Conectores'
  },

  // Estados de hábitat
  habitatStatus: {
    draft: { label: 'Borrador', color: 'secondary' },
    published: { label: 'Publicado', color: 'success' },
    archived: { label: 'Archivado', color: 'warning' }
  },

  // Tipos de conflictos/alertas
  conflictTypes: {
    warning: { icon: 'fa-exclamation-triangle', color: 'warning' },
    error: { icon: 'fa-times-circle', color: 'danger' },
    info: { icon: 'fa-info-circle', color: 'info' }
  },

  // Configuración de gráficas
  charts: {
    colors: {
      primary: 'rgba(54, 162, 235, 0.7)',
      success: 'rgba(75, 192, 192, 0.7)',
      warning: 'rgba(255, 206, 86, 0.7)',
      danger: 'rgba(255, 99, 132, 0.7)',
      info: 'rgba(153, 102, 255, 0.7)'
    },
    defaultOptions: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: 'bottom'
        }
      }
    }
  },

  // Textos y mensajes
  messages: {
    success: {
      saved: 'Guardado correctamente',
      exported: 'Exportado correctamente',
      published: 'Publicado en la comunidad',
      duplicated: 'Duplicado correctamente',
      deleted: 'Eliminado correctamente'
    },
    error: {
      notFound: 'No encontrado',
      invalidData: 'Datos inválidos',
      exportFailed: 'Error al exportar',
      saveFailed: 'Error al guardar'
    },
    confirm: {
      delete: '¿Estás seguro de eliminar este elemento?',
      publish: '¿Publicar este diseño en la comunidad?',
      reset: '¿Resetear todos los datos?'
    }
  },

  // URLs externas
  external: {
    nasaStandards: 'https://standards.nasa.gov/',
    esaEcss: 'https://ecss.nl/',
    documentation: '/modules/dashboard/README.md',
    repository: '#'
  },

  // Configuración de almacenamiento
  storage: {
    keys: {
      preferences: 'spacecrafter_prefs',
      habitats: 'spacecrafter_habitats',
      user: 'spacecrafter_user',
      cache: 'spacecrafter_cache'
    },
    maxSize: 5 * 1024 * 1024 // 5MB
  },

  // Configuración de features (para activar/desactivar funcionalidades)
  features: {
    enableCommunity: true,
    enableAnalytics: true,
    enableExport: true,
    enableImport: true,
    enableAI: false, // Para futuro asistente IA
    enableRealtime: false, // Para futuro sync en tiempo real
    enableComments: true,
    enableVoting: true,
    enableBadges: true
  },

  // Presets de búsqueda rápida
  quickSearchTerms: [
    'vital',
    'power',
    'cabin',
    'lab',
    'storage',
    'gym',
    'galley',
    'dock'
  ],

  // Configuración de módulos
  modules: {
    sizes: [
      { value: '1x1', label: '1×1', cells: 1 },
      { value: '2x2', label: '2×2', cells: 4 },
      { value: '3x3', label: '3×3', cells: 9 }
    ],
    defaultSize: '1x1'
  },

  // Métricas y scores
  metrics: {
    functionality: { key: 'f', label: 'Funcionalidad', icon: 'fa-cog' },
    durability: { key: 'd', label: 'Durabilidad', icon: 'fa-shield-alt' },
    weight: { key: 'w', label: 'Peso', icon: 'fa-weight' },
    cost: { key: 'cost', label: 'Costo', icon: 'fa-dollar-sign' },
    energy: { key: 'e', label: 'Energía', icon: 'fa-bolt' },
    ergonomics: { key: 'erg', label: 'Ergonomía', icon: 'fa-user' },
    materials: { key: 'mat', label: 'Materiales', icon: 'fa-cube' }
  },

  // Configuración de debug
  debug: {
    enabled: true, // Cambiar a false en producción
    logLevel: 'info', // 'error', 'warn', 'info', 'debug'
    showDevTools: true
  }
};

// Helper para obtener configuración
window.getConfig = function(path, defaultValue = null) {
  const keys = path.split('.');
  let value = window.SPACECRAFTER_CONFIG;
  
  for (const key of keys) {
    if (value && typeof value === 'object' && key in value) {
      value = value[key];
    } else {
      return defaultValue;
    }
  }
  
  return value;
};

// Log de configuración cargada
if (window.SPACECRAFTER_CONFIG.debug.enabled) {
  console.log('%c⚙️ SpaceCrafter Config Loaded', 'color: #667eea; font-weight: bold;');
  console.log('Version:', window.SPACECRAFTER_CONFIG.app.version);
  console.log('Debug mode:', window.SPACECRAFTER_CONFIG.debug.enabled);
}
