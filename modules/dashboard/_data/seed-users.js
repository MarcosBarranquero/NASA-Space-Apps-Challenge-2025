// Datos de usuario y comunidad
window.SEED_USERS = {
  current: {
    id: 'user-001',
    username: 'SpaceArchitect',
    email: 'architect@spacecrafter.app',
    avatar: '/modules/dashboard/assets/img/avatars/default.png',
    bio: 'Designer of space habitats. Passionate about extraterrestrial architecture.',
    stats: {
      habitatsCreated: 5,
      avgScore: 3.96,
      totalHours: 42.5,
      badges: ['first_habitat', 'lunar_expert', 'optimizer']
    },
    preferences: {
      theme: 'light',
      units: 'SI',
      language: 'en'
    }
  },
  community: [
    {
      id: 'user-002',
      username: 'MarsColonist',
      avatar: '/modules/dashboard/assets/img/avatars/user2.png',
      habitatId: 'HAB-COMM-001',
      habitatName: 'Red Planet Home',
      score: 4.8,
      votes: 127,
      comments: 23
    },
    {
      id: 'user-003',
      username: 'LunarEngineer',
      avatar: '/modules/dashboard/assets/img/avatars/user3.png',
      habitatId: 'HAB-COMM-002',
      habitatName: 'Moonbase Alpha',
      score: 4.6,
      votes: 98,
      comments: 15
    },
    {
      id: 'user-004',
      username: 'OrbitDesigner',
      avatar: '/modules/dashboard/assets/img/avatars/user4.png',
      habitatId: 'HAB-COMM-003',
      habitatName: 'ISS Next Gen',
      score: 4.5,
      votes: 85,
      comments: 19
    }
  ],
  comments: {
    'HAB-COMM-001': [
      { user: 'LunarEngineer', text: 'Excellent use of vertical space!', timestamp: '2025-10-04T14:20:00Z' },
      { user: 'OrbitDesigner', text: 'I love the thermal zoning', timestamp: '2025-10-04T16:45:00Z' }
    ]
  }
};
