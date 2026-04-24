// ===== Categorías =====
export const CATEGORY_ORDER = [
  'primary-functions',
  'crew',
  'food-resources',
  'science-ops',
  'energy-structure',
  'ops-access'
];

export const CATEGORIES = {
  'primary-functions': {
    name: 'Primary Functions',
    items: ['life_support', 'thermal_control', 'waste_hygiene']
  },
  'crew': {
    name: 'Crew Modules',
    items: ['sleeping_quarters', 'recreation_observation', 'exercise', 'medical']
  },
  'food-resources': {
    name: 'Food and Resources',
    items: ['galley', 'supply_storage', 'plant_growth']
  },
  'science-ops': {
    name: 'Science and operations',
    items: ['science_lab', 'comms_mission']
  },
  'energy-structure': {
    name: 'Energy and structure',
    items: ['power', 'solar_panel', 'core_hub']
  },
  'ops-access': {
    name: 'Operations and space access',
    items: [
      'docking_logistics',
      'airlock',
      'passage_h', 'passage_v',
      'robotic_arm'
    ]
  }
};

// === TALLAS (S/M/L) en celdas ===
export const SIZES = {
  small:  { label:'Small', w:1, h:1 },
  medium: { label:'Medium', w:2, h:2 },
  large:  { label:'Large',  w:3, h:3 }
};


// Tripulación fija
export const CREW_SIZE_FIXED = 6;

// ===== Catálogo =====
const IMG_BASE = '/modules/habitat/assets/img/';

export const MODULE_CATALOG = {
  // Primary
  life_support: {
    name: 'Life Support Module',
    image: `${IMG_BASE}support.webp`,
    desc: 'Oxygen, carbon dioxide, air and water recycling; maintains habitable environment'
  },
  thermal_control: {
    name: 'Thermal Control Module',
    image: `${IMG_BASE}thermal.webp`,
    desc: 'Keeps temperature within safe and comfortable levels'
  },
  waste_hygiene: {
    name: 'Waste & Hygiene Module',
    image: `${IMG_BASE}hygiene.webp`,
    desc: 'Toilets, cleaning, and waste recycling for crew health'
  },

  // Crew
  sleeping_quarters: {
    name: 'Crew Sleeping Quarters',
    image: `${IMG_BASE}sleeping.webp`,
    desc: 'Personal rooms providing privacy and rest for crew members'
  },
  recreation_observation: {
    name: 'Recreation & Observation Module',
    image: `${IMG_BASE}observation.webp`,
    desc: 'Entertainment and relaxation, with views of Earth or space'
  },
  exercise: {
    name: 'Exercise Module',
    image: `${IMG_BASE}exercise.webp`,
    desc: 'Resistance machines, treadmills and stationary bikes to maintain fitness'
  },
  medical: {
    name: 'Medical Module',
    image: `${IMG_BASE}medical.webp`,
    desc: 'Emergency care, first aid supplies, and telemedicine support'
  },

  // Food
  galley: {
    name: 'Galley & Food Preparation',
    image: `${IMG_BASE}food.webp`,
    desc: 'Preparation of meals and drinks for crew'
  },
  supply_storage: {
    name: 'Supply Storage',
    image: `${IMG_BASE}storage.webp`,
    desc: 'Storage of food, water, and mission supplies'
  },
  plant_growth: {
    name: 'Plant Growth Module',
    image: `${IMG_BASE}plant.webp`,
    desc: 'Produces oxygen and fresh food through plant cultivation'
  },

  // Science
  science_lab: {
    name: 'Science Laboratory',
    image: `${IMG_BASE}lab.webp`,
    desc: 'For experiments, research, and scientific observations'
  },
  comms_mission: {
    name: 'Communications & Mission Control',
    image: `${IMG_BASE}control.webp`,
    desc: 'Manages internal and external communications and monitors mission operations'
  },

  // Energy
  power: {
    name: 'Power Module',
    image: `${IMG_BASE}power.webp`,
    desc: 'Solar panels, batteries, and energy distribution to all systems'
  },
  solar_panel: {
    name: 'Solar Panel Array',
    image: `${IMG_BASE}solar.webp`,
    desc: 'External solar arrays that convert sunlight into electrical energy for the habitat',
    fixedSide: 1
  },
  core_hub: {
    name: 'Core Hub / Node Module',
    image: `${IMG_BASE}hub.webp`,
    desc: 'Central connection point linking all other modules together'
  },

  // Ops
  docking_logistics: {
    name: 'Docking & Logistics Module',
    image: `${IMG_BASE}docking.webp`,
    desc: 'Central connection point linking all other modules together'
  },
  airlock: {
    name: 'Airlock Module',
    image: `${IMG_BASE}airlock.webp`,
    desc: 'Allows safe entry and exit for spacewalks and external operations'
  },
// --- Pasillos (1×1 fijo) ---
passage_v: {
  name: 'Connecting Passageway (vertical)',
  image: `${IMG_BASE}passage_v.webp`,
  desc: 'Tubes connecting modules, allowing safe crew movement',
  fixedSide: 1
},
passage_h: {
  name: 'Connecting Passageway (horizontal)',
  image: `${IMG_BASE}passage_h.webp`,
  desc: 'Tubes connecting modules, allowing safe crew movement',
  fixedSide: 1
},
  robotic_arm: {
    name: 'Robotic Arm',
    image: `${IMG_BASE}robot_arm.webp`,
    desc: 'Used for installing modules, moving cargo, and assisting in external repairs'
  }
};

// ===== Scores (simplificado de antes) =====
export const MODULE_SCORES = {
  life_support: { f:5,d:3,w:5,cost:5,e:4,erg:4,mat:4 },
  thermal_control: { f:5,d:3,w:4,cost:4,e:4,erg:3,mat:4 },
  waste_hygiene: { f:4,d:3,w:3,cost:3,e:3,erg:4,mat:3 },

  sleeping_quarters: { f:4,d:4,w:3,cost:3,e:3,erg:5,mat:4 },
  recreation_observation:{ f:2,d:4,w:2,cost:3,e:2,erg:4,mat:3 },
  exercise: { f:3,d:3,w:3,cost:3,e:4,erg:4,mat:3 },
  medical: { f:5,d:3,w:3,cost:4,e:4,erg:4,mat:4 },

  galley: { f:4,d:3,w:3,cost:3,e:3,erg:4,mat:3 },
  supply_storage: { f:4,d:4,w:4,cost:3,e:4,erg:3,mat:4 },
  plant_growth: { f:2,d:3,w:3,cost:4,e:3,erg:3,mat:4 },

  science_lab: { f:4,d:3,w:3,cost:4,e:4,erg:3,mat:4 },
  comms_mission: { f:5,d:3,w:3,cost:4,e:5,erg:4,mat:4 },

  power: { f:5,d:3,w:5,cost:5,e:5,erg:3,mat:5 },
  solar_panel: { f:5,d:2,w:1,cost:2,e:4,erg:2,mat:5 },
  core_hub: { f:5,d:5,w:4,cost:4,e:5,erg:5,mat:4 },

  docking_logistics: { f:4,d:3,w:4,cost:4,e:4,erg:3,mat:4 },
  airlock: { f:5,d:3,w:3,cost:3,e:5,erg:3,mat:4 },

  passage_h: { f:5,d:5,w:4,cost:3,e:5,erg:4,mat:3 },
  passage_v: { f:5,d:5,w:4,cost:3,e:5,erg:4,mat:3 },

  robotic_arm: { f:4,d:3,w:3,cost:4,e:4,erg:3,mat:4 }
};

export const WEIGHTS = { f:0.25, d:0.10, w:0.05, cost:0.10, e:0.20, erg:0.15, mat:0.15 };

export function applySizeModifier(base, sizeKey){
  const s = { ...base };
  if (sizeKey === 'small') { s.d += 0.5; s.e += 0.2; }
  if (sizeKey === 'large') { s.d -= 0.3; s.e -= 0.2; }
  for (const k of Object.keys(s)) s[k] = Math.max(1, Math.min(5, s[k]));
  return s;
}
