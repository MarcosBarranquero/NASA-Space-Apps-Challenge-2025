// Artículos educativos para la sección Learn
window.LEARN_ARTICLES = [
  {
    id: 'zonificacion',
    title: 'Zonificación de Hábitats Espaciales',
    category: 'Diseño',
    readTime: '5 min',
    difficulty: 'Principiante',
    image: '/modules/dashboard/assets/img/articles/zonificacion.jpg',
    summary: 'Aprende a organizar espacios según funcionalidad y seguridad',
    content: `
      <h6 class="fw-bold mb-3">Introducción</h6>
      <p>La zonificación es fundamental para crear hábitats espaciales eficientes y seguros...</p>
      <!-- Contenido completo en learn.php -->
    `
  },
  {
    id: 'adyacencia',
    title: 'Reglas de Adyacencia',
    category: 'Configuración',
    readTime: '7 min',
    difficulty: 'Intermedio',
    image: '/modules/dashboard/assets/img/articles/adyacencia.jpg',
    summary: 'Qué módulos deben estar juntos y cuáles separados',
    content: `<!-- Ver learn.php -->`
  },
  {
    id: 'crew-requirements',
    title: 'Requisitos por Tripulación',
    category: 'Planificación',
    readTime: '6 min',
    difficulty: 'Intermedio',
    image: '/modules/dashboard/assets/img/articles/crew.jpg',
    summary: 'Cálculo de recursos según número de tripulantes',
    content: `<!-- Ver learn.php -->`
  },
  {
    id: 'best-practices',
    title: 'Best Practices NASA/ESA',
    category: 'Estándares',
    readTime: '10 min',
    difficulty: 'Avanzado',
    image: '/modules/dashboard/assets/img/articles/nasa-esa.jpg',
    summary: 'Estándares internacionales de diseño espacial',
    content: `<!-- Ver learn.php -->`
  },
  {
    id: 'thermal-control',
    title: 'Control Térmico en el Espacio',
    category: 'Sistemas',
    readTime: '8 min',
    difficulty: 'Avanzado',
    image: '/modules/dashboard/assets/img/articles/thermal.jpg',
    summary: 'Gestión de temperatura en entornos extremos',
    content: `<p>El control térmico es crítico para la supervivencia...</p>`
  },
  {
    id: 'radiation-shielding',
    title: 'Protección contra Radiación',
    category: 'Seguridad',
    readTime: '9 min',
    difficulty: 'Avanzado',
    image: '/modules/dashboard/assets/img/articles/radiation.jpg',
    summary: 'Escudos y materiales para protección radiológica',
    content: `<p>La radiación espacial representa uno de los mayores desafíos...</p>`
  }
];

// Badges/Logros disponibles
window.AVAILABLE_BADGES = [
  {
    id: 'first_habitat',
    name: 'Primer Hábitat',
    description: 'Crea tu primer diseño de hábitat',
    icon: 'fa-rocket',
    color: 'primary',
    requirement: 'Crear 1 hábitat'
  },
  {
    id: 'lunar_expert',
    name: 'Experto Lunar',
    description: 'Completa 3 diseños lunares',
    icon: 'fa-moon',
    color: 'info',
    requirement: 'Completar 3 hábitats con tag "Luna"'
  },
  {
    id: 'optimizer',
    name: 'Optimizador',
    description: 'Logra eficiencia >75%',
    icon: 'fa-cog',
    color: 'success',
    requirement: 'Puntuación de eficiencia > 75%'
  },
  {
    id: 'mars_pioneer',
    name: 'Pionero Marciano',
    description: 'Diseña un hábitat marciano completo',
    icon: 'fa-globe',
    color: 'danger',
    requirement: 'Completar hábitat con tag "Marte"'
  },
  {
    id: 'community_star',
    name: 'Estrella Comunitaria',
    description: 'Recibe 50 votos en la comunidad',
    icon: 'fa-star',
    color: 'warning',
    requirement: '50 votos acumulados'
  },
  {
    id: 'master_architect',
    name: 'Arquitecto Maestro',
    description: 'Logra puntuación perfecta de 5.0',
    icon: 'fa-trophy',
    color: 'warning',
    requirement: 'Puntuación 5.0 en un diseño'
  },
  {
    id: 'educator',
    name: 'Educador Espacial',
    description: 'Completa todos los artículos educativos',
    icon: 'fa-graduation-cap',
    color: 'info',
    requirement: 'Leer todos los artículos de Learn'
  },
  {
    id: 'collaborator',
    name: 'Colaborador',
    description: 'Publica 5 diseños en la comunidad',
    icon: 'fa-users',
    color: 'primary',
    requirement: 'Publicar 5 hábitats'
  },
  {
    id: 'perfectionist',
    name: 'Perfeccionista',
    description: 'Crea un diseño sin conflictos',
    icon: 'fa-check-circle',
    color: 'success',
    requirement: '0 conflictos en un diseño'
  },
  {
    id: 'transit_master',
    name: 'Maestro del Tránsito',
    description: 'Completa un hábitat de tránsito a Marte',
    icon: 'fa-space-shuttle',
    color: 'danger',
    requirement: 'Completar preset "Transit to Mars"'
  }
];

// Recomendaciones del asistente (para usar en habitats/new.php)
window.DESIGN_RECOMMENDATIONS = {
  lunar: [
    'Coloca el Soporte Vital cerca del núcleo central',
    'Asegura redundancia en sistemas críticos (mínimo 2 módulos)',
    'Considera protección contra radiación solar',
    'Planifica rutas de evacuación claras',
    'Agrupa módulos de habitación lejos de operaciones'
  ],
  mars: [
    'Incluye al menos 2 módulos de almacenamiento',
    'Considera un invernadero para misiones largas',
    'Protección contra tormentas de polvo',
    'Sistema de reciclaje de agua robusto',
    'Zona de descompresión para salidas EVA'
  ],
  transit: [
    'Maximiza eficiencia espacial (cada m³ cuenta)',
    'Incluye gimnasio para mantener salud muscular',
    'Zona de recreación es crítica para moral',
    'Sistema de comunicaciones redundante',
    'Almacenamiento para 6+ meses de suministros'
  ],
  general: [
    'Evita pasillos sin salida',
    'Separa zonas ruidosas de dormitorios',
    'Coloca laboratorios con acceso a almacenamiento',
    'Sistemas de energía deben ser redundantes',
    'Considera mantenibilidad de todos los sistemas'
  ]
};

// Tips rápidos para el asistente
window.QUICK_TIPS = [
  '💡 El módulo Vital debe estar en una zona central y protegida',
  '⚡ Coloca generadores de energía cerca de sistemas de alto consumo',
  '🚪 Asegura al menos 2 rutas de evacuación por zona',
  '🔧 Deja espacio libre para mantenimiento (10-15% del total)',
  '🌡️ Agrupa módulos que requieren control térmico similar',
  '📦 Almacenamiento debe ser accesible pero no obstruir flujo',
  '🧪 Laboratorios lejos de dormitorios (ruido/vibraciones)',
  '🍽️ Cocina cerca de áreas comunes, lejos de laboratorios',
  '💪 Gimnasio en zona de baja interferencia',
  '🚀 Muelles deben tener pasillos de seguridad amplios'
];
