// Presets de escenarios predefinidos
window.SEED_PRESETS = [
  {
    id: 'preset-lunar',
    title: 'Lunar Outpost',
    crew: 4,
    durationDays: 30,
    thumb: '/modules/dashboard/assets/img/presets/lunar.png',
    description: 'Estación lunar compacta para misiones de corta duración. Optimizada para 4 tripulantes durante 30 días.',
    modules: ['vital', 'power', 'cabin', 'cabin', 'galley', 'lab', 'passage_h'],
    requirements: {
      minCells: 20,
      maxCells: 30,
      categories: ['life_support', 'power', 'habitation', 'operations']
    }
  },
  {
    id: 'preset-transit',
    title: 'Transit to Mars',
    crew: 6,
    durationDays: 180,
    thumb: '/modules/dashboard/assets/img/presets/transit.png',
    description: 'Hábitat de tránsito para viaje prolongado a Marte. Capacidad para 6 tripulantes durante 6 meses.',
    modules: ['vital', 'vital', 'power', 'cabin', 'cabin', 'cabin', 'galley', 'gym', 'lab', 'storage', 'passage_h', 'passage_v'],
    requirements: {
      minCells: 35,
      maxCells: 50,
      categories: ['life_support', 'power', 'habitation', 'operations', 'wellness']
    }
  },
  {
    id: 'preset-mars',
    title: 'Martian Surface',
    crew: 8,
    durationDays: 540,
    thumb: '/modules/dashboard/assets/img/presets/mars.png',
    description: 'Base marciana permanente para misiones de larga duración. Diseñada para 8 tripulantes durante 18 meses.',
    modules: ['vital', 'vital', 'power', 'power', 'cabin', 'cabin', 'cabin', 'cabin', 'galley', 'gym', 'lab', 'lab', 'greenhouse', 'storage', 'storage', 'dock', 'passage_h', 'passage_v'],
    requirements: {
      minCells: 50,
      maxCells: 80,
      categories: ['life_support', 'power', 'habitation', 'operations', 'wellness', 'production']
    }
  }
];
