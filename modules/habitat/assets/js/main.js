// main.js
import {
  CATEGORY_ORDER, CATEGORIES, SIZES,
  CREW_SIZE_FIXED, MODULE_CATALOG
} from './specs.js';
import { computeWeightedModuleScore, computeHabitatScore } from './scoring.js';

/* ================== Constantes ================== */
const GRID_SIZE = 10;
const ALLOWED_SQUARES = [1, 2, 3]; // Solo tamaños cuadrados permitidos

/* ================== DOM ================== */
const grid         = document.getElementById('grid');
const modulesList  = document.getElementById('modulesList');
const categoryList = document.getElementById('categoryList');
document.getElementById('btnClear').onclick  = clearGrid;
document.getElementById('btnExport').onclick = exportLayout;

/* Bootstrap (seguro) */
const bs = (()=>{
  if (window.bootstrap) return window.bootstrap;
  try { if (typeof bootstrap !== 'undefined') return bootstrap; } catch {}
  return null;
})();

/* Modal grande (ficha/config) */
const moduleModalEl = document.getElementById('moduleModal');
const moduleModal   = (bs && moduleModalEl) ? new bs.Modal(moduleModalEl) : null;

const mmImage = document.getElementById('mmImage');
const mmIcon  = document.getElementById('mmIcon');
const mmTitle = document.getElementById('mmTitle');
const mmDesc  = document.getElementById('mmDesc');
const mmStats = document.getElementById('mmStats');

/* Quick-modal (acciones sobre un módulo ya colocado) */
const quickEl    = document.getElementById('moduleQuick');
const quickModal = (bs && quickEl) ? new bs.Modal(quickEl) : null;
const mqTitle = document.getElementById('mqTitle');
const mqS     = document.getElementById('mqSizeS');
const mqM     = document.getElementById('mqSizeM');
const mqL     = document.getElementById('mqSizeL');
const mqDel   = document.getElementById('mqDelete');

/* ================== Estado ================== */
let placedModules = [];
let currentCategory = CATEGORY_ORDER[0];
let draggedType = null;
let draggedSize = null; // { w,h,sizeKey }
const lastPickedByType = Object.create(null); // preferencia de talla por tipo

/* ================== Helpers ================== */
function isForced1x1(type) {
  const meta = MODULE_CATALOG[type] || {};
  return meta.fixedSide === 1 || /^passage_/.test(type);
}

/* ================== Grid inicial ================== */
for (let i = 0; i < GRID_SIZE * GRID_SIZE; i++) {
  const cell = document.createElement('div');
  cell.className = 'grid-cell';
  cell.dataset.index = i;
  grid.appendChild(cell);
}

/* ================== Render inicial ================== */
renderCategories();
renderModules(currentCategory);
updateStats();

/* ------------------------- UI: Categorías ------------------------- */
function renderCategories(){
  categoryList.innerHTML = CATEGORY_ORDER.map(k=>{
    const { name } = CATEGORIES[k];
    return `<button class="category-btn ${k===currentCategory?'active':''}" data-cat="${k}">${name}</button>`;
  }).join('');

  categoryList.querySelectorAll('.category-btn').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      currentCategory = btn.dataset.cat;
      categoryList.querySelectorAll('.category-btn').forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      renderModules(currentCategory);
    });
  });
}

/* -------------------- UI: Lista de módulos -------------------- */
function renderModules(catKey){
  const items = CATEGORIES[catKey]?.items || [];
  modulesList.innerHTML = items.map(type=>{
    const meta = MODULE_CATALOG[type]||{};
    const hardSmall = isForced1x1(type);
    const currentSize = hardSmall
      ? 'SMALL'
      : (lastPickedByType[type]?.sizeKey || 'medium').toUpperCase();
    
    // Rotar 90° si es passage_
    const imgStyle = /^passage_/.test(type) ? 'transform:rotate(90deg);' : '';
    
    return `
      <div class="module-item" data-type="${type}" draggable="true">
        <div class="module-thumb">
          ${meta.image ? `<img src="${meta.image}" alt="${meta.name || type}" onerror="this.style.display='none'">` : ''}
        </div>
        <div>
          <div class="module-title">${meta.name||type}</div>
          <div class="module-desc">
            Size: <strong data-size-label="${type}">${currentSize}</strong> — ${hardSmall ? 'Default 1×1' : 'click to configure'}
          </div>
        </div>
      </div>
    `;
  }).join('');

  attachListHandlers();
}

function attachListHandlers(){
  modulesList.querySelectorAll('.module-item').forEach(el=>{
    const type = el.dataset.type;

    // Drag desde la lista con tamaño elegido (por defecto M=2x2)
    el.addEventListener('dragstart', (e)=>{
      const hardSmall = isForced1x1(type);
      const sel = hardSmall
        ? { w:1, h:1, sizeKey:'small' }
        : (lastPickedByType[type] || { w:SIZES.medium.w, h:SIZES.medium.h, sizeKey:'medium' });

      draggedType = type;
      draggedSize = sel;
      try { e.dataTransfer.setData('text/plain', type); } catch {}
    });

    // Click → abrir modal de ficha/selección de talla
    el.addEventListener('click', (ev)=>{
      ev.preventDefault();
      ev.stopPropagation();
      openModuleModal(type);
    });
  });
}

/* --------------------- Modal de "ficha" del módulo --------------------- */
function openModuleModal(type){
  if(!moduleModal) return;

  const meta = MODULE_CATALOG[type] || { name:type, icon:'📦' };
  const is1x1Only = isForced1x1(type);

  // Media (fondo crema y contenido responsivo)
  const mediaBox = mmImage ? mmImage.parentElement : null;
  if (mediaBox) mediaBox.style.background = '#fdf5e4';

  if (meta.image) {
    if (mmImage) {
      mmImage.src = meta.image;
      mmImage.alt = meta.name || type;
      mmImage.style.display = 'block';
      // Rotar 90° si es passage_
      mmImage.style.transform = /^passage_/.test(type) ? 'rotate(90deg)' : '';
    }
    if (mmIcon) mmIcon.style.display = 'none';
  } else {
    if (mmImage) {
      mmImage.src = '';
      mmImage.style.display = 'none';
      mmImage.style.transform = '';
    }
    if (mmIcon) {
      mmIcon.textContent = meta.icon || '📦';
      mmIcon.style.display = 'inline-block';
    }
  }

  // Título + descripción
  if (mmTitle) mmTitle.textContent = meta.name || type;
  if (mmDesc)  mmDesc.textContent  = meta.desc || '—';

  // Stats (1..5) en barras
  if (mmStats) {
    const rows = [
      ['Functionality','f'], ['Dimensions','d'], ['Weight','w'], ['Cost','cost'],
      ['Efficiency','e'], ['Ergonomics','erg'], ['Materials','mat']
    ];
    mmStats.innerHTML = rows.map(([label,key])=>{
      const v = (meta.stats && meta.stats[key]) || (meta.base && meta.base[key]) || 3;
      const pct = (v/5)*100;
      return `
        <div class="d-flex align-items-center mb-1">
          <div class="me-2" style="min-width:120px">${label}</div>
          <div class="progress flex-grow-1" style="height:6px;">
            <div class="progress-bar" role="progressbar" style="width:${pct}%;" aria-valuenow="${v}" aria-valuemin="0" aria-valuemax="5"></div>
          </div>
          <div class="ms-2" style="width:20px;text-align:right">${v}</div>
        </div>
      `;
    }).join('');
  }

  // Botones de talla dentro del modal (1×1, 2×2, 3×3)
  const current = (lastPickedByType[type]?.sizeKey) || 'medium';
  moduleModalEl.querySelectorAll('.mm-size-btn').forEach(btn=>{
    const sizeKey = btn.dataset.size; // 'small' | 'medium' | 'large'
    btn.classList.toggle('active', sizeKey === current);

    // Texto 1×1 / 2×2 / 3×3
    const dim = btn.querySelector('.dim');
    if (dim) {
      if (sizeKey === 'small')  dim.textContent = '1×1';
      if (sizeKey === 'medium') dim.textContent = '2×2';
      if (sizeKey === 'large')  dim.textContent = '3×3';
    }

    // Bloquear botones si es 1×1 fijo
    if (is1x1Only && sizeKey !== 'small') {
      btn.disabled = true;
      btn.style.opacity = '0.3';
    } else {
      btn.disabled = false;
      btn.style.opacity = '1';
    }

    btn.onclick = ()=>{
      if (is1x1Only && sizeKey !== 'small') return; // Doble seguridad
      const map = { small:{w:1,h:1}, medium:{w:2,h:2}, large:{w:3,h:3} };
      lastPickedByType[type] = { ...map[sizeKey], sizeKey };
      const label = document.querySelector(`[data-size-label="${type}"]`);
      if (label) label.textContent = sizeKey.toUpperCase();
      moduleModal.hide();
    };
  });

  moduleModal.show();
}

/* ------------------- Drop en la cuadrícula ------------------- */
grid.addEventListener('dragover', (e)=>{
  e.preventDefault();
  const cell = e.target.closest('.grid-cell');
  if(cell){
    document.querySelectorAll('.grid-cell').forEach(c=>c.classList.remove('active'));
    if(!cell.classList.contains('occupied')) cell.classList.add('active');
  }
});
grid.addEventListener('dragleave', ()=>{
  document.querySelectorAll('.grid-cell').forEach(c=>c.classList.remove('active'));
});
grid.addEventListener('drop', (e)=>{
  e.preventDefault();
  const cell = e.target.closest('.grid-cell');
  document.querySelectorAll('.grid-cell').forEach(c=>c.classList.remove('active'));
  if(!cell || !draggedType) { draggedType=null; draggedSize=null; return; }

  const index = parseInt(cell.dataset.index, 10);
  let { w, h, sizeKey } = draggedSize || { w:SIZES.medium.w, h:SIZES.medium.h, sizeKey:'medium' };
  if (isForced1x1(draggedType)) {
    w = 1; h = 1; sizeKey = 'small';
  }

  if (canPlace(index, w, h)) {
    placeModule(index, draggedType, w, h, sizeKey);
  }
  draggedType=null; draggedSize=null;
});

/* ---------------------- Helpers de grid ---------------------- */
function getGridMetrics(){
  const cs = getComputedStyle(grid);
  const gap = parseFloat(cs.gap || cs.gridGap || '0') || 0;
  const cell = grid.children[0];
  const cellSize = cell ? cell.getBoundingClientRect().width : 0;
  const paddingLeft = parseFloat(cs.paddingLeft)||0;
  const paddingTop  = parseFloat(cs.paddingTop)||0;
  return { cellSize, gap, paddingLeft, paddingTop };
}

function positionModuleElement(module, el){
  const { cellSize, gap, paddingLeft, paddingTop } = getGridMetrics();
  const startRow = Math.floor(module.startIndex / GRID_SIZE);
  const startCol = module.startIndex % GRID_SIZE;
  const left = paddingLeft + startCol * (cellSize + gap);
  const top  = paddingTop  + startRow * (cellSize + gap);
  const width  = module.width  * cellSize + (module.width  - 1) * gap;
  const height = module.height * cellSize + (module.height - 1) * gap;
  el.style.left = `${left}px`; el.style.top = `${top}px`;
  el.style.width = `${width}px`; el.style.height = `${height}px`;
}

function canPlace(startIndex, w, h){
  const sr = Math.floor(startIndex/GRID_SIZE);
  const sc = startIndex%GRID_SIZE;
  if (sc + w > GRID_SIZE || sr + h > GRID_SIZE) return false;
  for (let r=0;r<h;r++) for (let c=0;c<w;c++){
    const idx = (sr+r)*GRID_SIZE + (sc+c);
    if (grid.children[idx].classList.contains('occupied')) return false;
  }
  return true;
}

/* ---------------------- Colocar módulo ---------------------- */
function placeModule(startIndex, type, widthArg, heightArg, sizeKey='medium'){
  const id = Date.now() + Math.random();

  // 🔒 Si es pasillo (forzado 1×1), ignora lo que venga y fija 1×1
  let width = widthArg;
  let height = heightArg;
  if (isForced1x1(type)) {
    width = 1;
    height = 1;
    sizeKey = 'small';
  }

  const cells = [];
  const sr = Math.floor(startIndex/GRID_SIZE);
  const sc = startIndex%GRID_SIZE;

  for (let r=0;r<height;r++) for (let c=0;c<width;c++){
    const idx = (sr+r)*GRID_SIZE + (sc+c);
    cells.push(idx);
    grid.children[idx].classList.add('occupied');
  }

  const el = document.createElement('div');
  el.className = `placed-module module-${type}`;
  el.dataset.id = id;
  el.dataset.width = width;
  el.dataset.height = height;
  el.dataset.sizeKey = sizeKey;

  const meta = MODULE_CATALOG[type] || {};
  if (meta.image) {
    el.style.backgroundImage    = `url('${meta.image}')`;
    el.style.backgroundRepeat   = 'no-repeat';
    el.style.backgroundPosition = 'center';
    el.style.backgroundSize     = 'contain'; // para que no se deforme
    el.style.backgroundColor    = 'hsla(41, 86%, 94%, 0.00)'; // tu color crema
  }

  grid.appendChild(el);

  const mod = { id, type, startIndex, width, height, sizeKey, cells };
  placedModules.push(mod);
  positionModuleElement(mod, el);
  makeInteractive(el, id);
  updateStats();
}

/* ----------------------- Quick-modal ----------------------- */
function openQuickModal(moduleId){
  if (!quickModal) return;
  const mod  = placedModules.find(m => m.id === moduleId);
  if (!mod) return;

  const meta = MODULE_CATALOG[mod.type] || { name: mod.type };
  mqTitle.textContent = meta.name || mod.type;

  // Si el tipo es 1x1 forzado, deshabilitamos M/L
  const forced1x1 = (meta.fixedSide === 1) || /^passage_/.test(mod.type);

  const mapBtns = [
    {btn: mqS, side: 1, key: 'small'},
    {btn: mqM, side: 2, key: 'medium'},
    {btn: mqL, side: 3, key: 'large'}
  ];

  mapBtns.forEach(({btn, side, key})=>{
    if (!btn) return;
    // asegura el texto correcto SIEMPRE
    const dim = btn.querySelector('.dim');
    if (dim) dim.textContent = `${side}×${side}`;

    // activo si coincide
    btn.classList.toggle('active', mod.width === side && mod.height === side);

    // deshabilitar según reglas
    let can = true;
    if (forced1x1 && side !== 1) can = false; // pasillos: solo 1x1
    if (can) {
      // quepa y no colisione
      can = canResizeModuleSquare(mod.id, side);
    }
    btn.disabled = !can;

    // click → aplicar tamaño
    btn.onclick = ()=>{
      if (!can) return;
      resizeModule(mod.id, side, side);
      quickModal.hide();
    };
  });

  // Eliminar
  if (mqDel) {
    mqDel.onclick = ()=>{
      removeModule(mod.id);
      quickModal.hide();
    };
  }

  quickModal.show();
}

/* -------------------- Clear / Export -------------------- */
function clearGrid(){
  if(!confirm('Remove layout?')) return;
  placedModules = [];
  grid.innerHTML = '';
  for (let i=0;i<GRID_SIZE*GRID_SIZE;i++){
    const cell = document.createElement('div');
    cell.className = 'grid-cell';
    cell.dataset.index = i;
    grid.appendChild(cell);
  }
  updateStats();
}

function exportLayout(){
  const modules = placedModules.map(m=>({
    type:m.type,
    size:m.sizeKey,
    position:[Math.floor(m.startIndex/GRID_SIZE), m.startIndex%GRID_SIZE],
    sizeCells:[m.width,m.height],
    score: computeWeightedModuleScore(m.type, m.sizeKey)
  }));
  const payload = {
    crewSize: CREW_SIZE_FIXED,
    grid: { size: GRID_SIZE, totalCells: GRID_SIZE*GRID_SIZE },
    modules,
    habitatScore: computeHabitatScore(placedModules)
  };
  console.log('Layout Export:', JSON.stringify(payload,null,2));
  alert('Layout exported to the console');
}

/* ----------------- Interact.js: mover/redimensionar ----------------- */
function makeInteractive(el, moduleId){
  let isDragging = false;
  let isResizing = false;
  let suppressClicksUntil = 0; // ms timestamp para ignorar clics "accidentales"

  const mod = placedModules.find(m=>m.id===moduleId);
  const forced = mod && isForced1x1(mod.type);

  // --- DRAG ---
  interact(el).draggable({
    listeners:{
      start(e){
        isDragging = true;
        e.target.classList.add('dragging');
        e.target.style.zIndex = '1000';

        const rect = e.target.getBoundingClientRect();
        const grect = grid.getBoundingClientRect();
        e.target.dataset.origLeft = rect.left - grect.left;
        e.target.dataset.origTop  = rect.top  - grect.top;
        e.target.dataset.dx = 0;
        e.target.dataset.dy = 0;
      },
      move(e){
        const dx = (+e.target.dataset.dx||0) + e.dx;
        const dy = (+e.target.dataset.dy||0) + e.dy;
        e.target.dataset.dx = dx;
        e.target.dataset.dy = dy;
        const left = +e.target.dataset.origLeft + dx;
        const top  = +e.target.dataset.origTop  + dy;
        e.target.style.left = `${left}px`;
        e.target.style.top  = `${top}px`;
      },
      end(e){
        const mod = placedModules.find(m=>m.id===moduleId);
        const { cellSize,gap,paddingLeft,paddingTop } = getGridMetrics();

        let left = parseFloat(e.target.style.left) - paddingLeft;
        let top  = parseFloat(e.target.style.top)  - paddingTop;

        const col = Math.round(left/(cellSize+gap));
        const row = Math.round(top /(cellSize+gap));

        const newCol = Math.max(0, Math.min(GRID_SIZE - mod.width,  col));
        const newRow = Math.max(0, Math.min(GRID_SIZE - mod.height, row));
        const newIndex = newRow*GRID_SIZE + newCol;

        e.target.style.zIndex = '';
        e.target.classList.remove('dragging');

        if(newIndex !== mod.startIndex && canMoveModule(moduleId, newIndex)){
          moveModule(moduleId, newIndex);
        } else {
          positionModuleElement(mod, e.target);
        }

        isDragging = false;
        // Ignora el click que viene inmediatamente después del drag
        suppressClicksUntil = Date.now() + 250;
      }
    }
  });

  // --- RESIZE (cuadrado) - solo si NO es forzado 1×1 ---
  if (!forced) {
    interact(el).resizable({
      edges:{ right:true, bottom:true },
      listeners:{
        start(e){
          isResizing = true;
          e.target.classList.add('resizing');
        },
        move(e){
          const side = Math.max(e.rect.width, e.rect.height);
          e.target.style.width  = `${side}px`;
          e.target.style.height = `${side}px`;
        },
        end(e){
          const mod = placedModules.find(m=>m.id===moduleId);
          const { cellSize, gap } = getGridMetrics();

          let tentative = Math.max(
            Math.round((e.rect.width  + gap) / (cellSize + gap)),
            Math.round((e.rect.height + gap) / (cellSize + gap))
          );

          let want = nearestAllowedSquare(tentative);

          const sr = Math.floor(mod.startIndex/GRID_SIZE);
          const sc = mod.startIndex % GRID_SIZE;
          const fits = ALLOWED_SQUARES.filter(s => sc+s<=GRID_SIZE && sr+s<=GRID_SIZE);

          const chosen = chooseBestSize(moduleId, want, fits);

          e.target.classList.remove('resizing');
          if (chosen && canResizeModuleSquare(moduleId, chosen)) {
            resizeModule(moduleId, chosen, chosen);
            positionModuleElement(placedModules.find(m=>m.id===moduleId), e.target);
          } else {
            positionModuleElement(mod, e.target);
          }

          isResizing = false;
          // Ignora el click posterior al resize
          suppressClicksUntil = Date.now() + 250;
        }
      }
    });
  }

  // --- CLICK "consciente": abre quick-modal si no acaba de arrastrar/redimensionar ---
  el.addEventListener('click', (ev)=>{
    const now = Date.now();
    if (isDragging || isResizing || now < suppressClicksUntil) {
      ev.stopPropagation();
      ev.preventDefault();
      return; // no abrir modal
    }
    // selección visual + abrir opciones
    document.querySelectorAll('.placed-module').forEach(m=>m.classList.remove('selected'));
    el.classList.add('selected');
    openQuickModal(moduleId);
  }, true);
}

/* ---------------- Enforcers cuadrado ---------------- */
function nearestAllowedSquare(n){
  // n = lado en celdas estimado
  if (n <= 1.5) return 1;
  if (n <= 2.5) return 2;
  return 3;
}

function chooseBestSize(moduleId, want, allowedFits){
  const order = [want, ...ALLOWED_SQUARES.filter(s=>s!==want).sort((a,b)=>b-a)];
  for (const s of order) {
    if (!allowedFits.includes(s)) continue;
    if (canResizeModuleSquare(moduleId, s)) return s;
  }
  return null;
}

function canResizeModuleSquare(moduleId, side){
  return canResizeModule(moduleId, side, side);
}

/* ----------------- Move/Resize core ----------------- */
function canMoveModule(moduleId,newStartIndex){
  const m=placedModules.find(x=>x.id===moduleId);
  const sr=Math.floor(newStartIndex/GRID_SIZE), sc=newStartIndex%GRID_SIZE;
  if(sc+m.width>GRID_SIZE || sr+m.height>GRID_SIZE) return false;
  for(let r=0;r<m.height;r++) for(let c=0;c<m.width;c++){
    const idx=(sr+r)*GRID_SIZE+(sc+c); const cell=grid.children[idx];
    if(cell.classList.contains('occupied') && !m.cells.includes(idx)) return false;
  }
  return true;
}
function moveModule(moduleId,newStartIndex){
  const m=placedModules.find(x=>x.id===moduleId);
  m.cells.forEach(idx=>grid.children[idx].classList.remove('occupied'));
  const sr=Math.floor(newStartIndex/GRID_SIZE), sc=newStartIndex%GRID_SIZE, newCells=[];
  for(let r=0;r<m.height;r++) for(let c=0;c<m.width;c++){
    const idx=(sr+r)*GRID_SIZE+(sc+c); newCells.push(idx); grid.children[idx].classList.add('occupied');
  }
  m.startIndex=newStartIndex; m.cells=newCells;
  const el=document.querySelector(`[data-id="${moduleId}"]`); if(el) positionModuleElement(m,el);
  updateStats();
}

function canResizeModule(moduleId,newW,newH){
  const m=placedModules.find(x=>x.id===moduleId);
  const sr=Math.floor(m.startIndex/GRID_SIZE), sc=m.startIndex%GRID_SIZE;
  if(sc+newW>GRID_SIZE || sr+newH>GRID_SIZE) return false;
  for(let r=0;r<newH;r++) for(let c=0;c<newW;c++){
    const idx=(sr+r)*GRID_SIZE+(sc+c); const cell=grid.children[idx];
    if(cell.classList.contains('occupied') && !m.cells.includes(idx)) return false;
  }
  return true;
}
function resizeModule(moduleId,newW,newH){
  const m=placedModules.find(x=>x.id===moduleId);
  m.cells.forEach(idx=>grid.children[idx].classList.remove('occupied'));
  const sr=Math.floor(m.startIndex/GRID_SIZE), sc=m.startIndex%GRID_SIZE, newCells=[];
  for(let r=0;r<newH;r++) for(let c=0;c<newW;c++){
    const idx=(sr+r)*GRID_SIZE+(sc+c); newCells.push(idx); grid.children[idx].classList.add('occupied');
  }
  m.width=newW; m.height=newH; m.cells=newCells;
  const el=document.querySelector(`[data-id="${moduleId}"]`);
  if(el){ el.dataset.width=newW; el.dataset.height=newH; positionModuleElement(m,el); }
  updateStats();
}

/* ----------------- Eliminar módulo ----------------- */
function removeModule(id){
  const m=placedModules.find(x=>x.id===id); if(!m) return;
  m.cells.forEach(idx=>grid.children[idx].classList.remove('occupied'));
  placedModules = placedModules.filter(x=>x.id!==id);
  const el=document.querySelector(`[data-id="${id}"]`); if(el) el.remove();
  updateStats();
}
window.removeModule = removeModule;

/* ----------------- Stats / UI panel derecho ----------------- */
function updateStats(){
  const occupied=placedModules.reduce((s,m)=>s+m.cells.length,0);
  const total=GRID_SIZE*GRID_SIZE;
  document.getElementById('occupiedCells').textContent = `${occupied} / ${total}`;
  document.getElementById('moduleCount').textContent = placedModules.length.toString();
  document.getElementById('efficiency').textContent = `${Math.round((occupied/total)*100)}%`;
  document.getElementById('crewSize').textContent = CREW_SIZE_FIXED;

  const habScore=computeHabitatScore(placedModules);
  document.getElementById('habScore').textContent = habScore.toFixed(2);

  const active = document.getElementById('activeModules');
  active.innerHTML = placedModules.length===0
    ? '<div style="color:var(--muted); font-size:12px">There are no modules.</div>'
    : placedModules.map(m=>{
        const meta = MODULE_CATALOG[m.type]||{};
        const sizeLabel = (m.sizeKey||'medium').toUpperCase();
        const thumb = meta.image
          ? `<img src="${meta.image}" alt="${meta.name || m.type}" style="width:18px;height:18px;border-radius:4px;object-fit:cover;margin-right:6px">`
          : `<span style="display:inline-block;width:18px;height:18px;border-radius:4px;background:#e0e0e0;margin-right:6px"></span>`;
        return `
          <div class="module-list-item">
            <span>${thumb}${meta.name||m.type} — ${sizeLabel}</span>
            <button class="btn btn-xs btn-alt-primary" onclick="document.querySelector('[data-id=&quot;${m.id}&quot;]').click()">Options</button>
          </div>
        `;
      }).join('');
}
