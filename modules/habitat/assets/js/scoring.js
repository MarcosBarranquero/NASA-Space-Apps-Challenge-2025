import { MODULE_SCORES, WEIGHTS, applySizeModifier } from './specs.js';

export function computeWeightedModuleScore(type, sizeKey='medium'){
  const base = MODULE_SCORES[type];
  if(!base) return 0;
  const s = applySizeModifier(base, sizeKey);
  const w = WEIGHTS;
  const sum = s.f*w.f + s.d*w.d + s.w*w.w + s.cost*w.cost + s.e*w.e + s.erg*w.erg + s.mat*w.mat;
  return Number(sum.toFixed(2)); // 0..5
}

export function computeHabitatScore(placedModules){
  if(!placedModules?.length) return 0;
  const avg = placedModules.reduce((acc,m)=>acc+computeWeightedModuleScore(m.type, m.sizeKey),0)/placedModules.length;
  return Number(avg.toFixed(2));
}
