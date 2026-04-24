// Datos para analíticas y métricas
window.SEED_ANALYTICS = {
  cellsByCategory: {
    labels: ['Soporte Vital', 'Energía', 'Habitación', 'Operaciones', 'Bienestar', 'Producción', 'Conectores'],
    data: [18, 12, 28, 24, 15, 8, 22]
  },
  topModules: {
    labels: ['Cabin', 'Passage H', 'Vital', 'Power', 'Lab'],
    data: [12, 10, 8, 7, 6]
  },
  scoreByProject: {
    labels: ['HAB-001', 'HAB-002', 'HAB-003', 'HAB-004', 'HAB-005'],
    data: [4.3, 3.8, 4.7, 4.1, 2.9]
  },
  editingTime: {
    labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
    personal: [5.2, 3.8, 6.1, 4.5, 7.3, 2.1, 1.5],
    community: [4.1, 3.9, 4.2, 4.0, 4.5, 3.2, 2.8]
  },
  globalStats: {
    totalHabitats: 5,
    avgScore: 3.96,
    totalHours: 42.5,
    lastEdited: 'HAB-001',
    conflicts: [
      { type: 'warning', message: 'Soporte vital sin redundancia', habitatId: 'HAB-005' },
      { type: 'info', message: 'Muelle sin pasillo de seguridad', habitatId: 'HAB-004' },
      { type: 'warning', message: 'Eficiencia energética < 50%', habitatId: 'HAB-002' },
      { type: 'info', message: 'Considerar más espacio de almacenamiento', habitatId: 'HAB-003' }
    ]
  }
};
