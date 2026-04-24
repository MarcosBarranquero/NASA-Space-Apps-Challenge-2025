<?php
include __DIR__.'/../../includes/header.php';
include __DIR__.'/../../includes/sidebar-right.php';
include __DIR__.'/../../includes/sidebar-left.php';
include __DIR__.'/../../includes/topbar.php';
?>
      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        <div class="content">
          <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
              <h1 class="h3 fw-bold mb-2">
                <i class="fa fa-cubes text-primary me-2"></i>Biblioteca de Módulos
              </h1>
              <h2 class="h6 fw-medium text-muted mb-0">
                Explora los módulos disponibles para tus diseños
              </h2>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          <!-- Filtros -->
          <div class="block block-rounded">
            <div class="block-content">
              <div class="row g-3">
                <div class="col-md-4">
                  <input type="text" class="form-control" id="searchModules" placeholder="Buscar módulos...">
                </div>
                <div class="col-md-4">
                  <select class="form-select" id="filterCategory">
                    <option value="">Todas las categorías</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select class="form-select" id="sortModules">
                    <option value="name">Ordenar por nombre</option>
                    <option value="type">Ordenar por tipo</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- END Filtros -->

          <!-- Grid de Módulos -->
          <div class="row" id="modulesGrid">
            <!-- Se llena dinámicamente -->
          </div>
          <!-- END Grid de Módulos -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Modal Detalle Módulo -->
      <div class="modal fade" id="moduleDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="moduleDetailTitle"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="moduleDetailBody">
              <!-- Se llena dinámicamente -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Cerrar</button>
              <a href="#" class="btn btn-sm btn-primary" id="useModuleBtn">
                <i class="fa fa-plus me-1"></i>Usar en Editor
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Scripts -->
      <script type="module">
        import { MODULE_CATALOG, MODULE_SCORES, CATEGORIES } from '/modules/habitat/assets/js/specs.js';
        
        let allModules = [];
        let filteredModules = [];
        
        document.addEventListener('DOMContentLoaded', function() {
          // Preparar datos de módulos
          allModules = Object.entries(MODULE_CATALOG).map(([key, meta]) => ({
            key,
            ...meta,
            scores: MODULE_SCORES[key] || { f:3, d:3, w:3, cost:3, e:3, erg:3, mat:3 }
          }));
          
          filteredModules = [...allModules];
          
          // Cargar categorías
          loadCategories();
          renderModules();
          
          // Event listeners
          document.getElementById('searchModules').addEventListener('input', applyFilters);
          document.getElementById('filterCategory').addEventListener('change', applyFilters);
          document.getElementById('sortModules').addEventListener('change', applyFilters);
        });

        function loadCategories() {
          const select = document.getElementById('filterCategory');
          const categories = [...new Set(allModules.map(m => m.category))].filter(Boolean);
          
          categories.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat;
            option.textContent = cat.charAt(0).toUpperCase() + cat.slice(1);
            select.appendChild(option);
          });
        }

        function applyFilters() {
          const search = document.getElementById('searchModules').value.toLowerCase();
          const category = document.getElementById('filterCategory').value;
          const sort = document.getElementById('sortModules').value;
          
          filteredModules = allModules.filter(m => {
            const matchSearch = !search || m.name.toLowerCase().includes(search) || m.desc?.toLowerCase().includes(search);
            const matchCategory = !category || m.category === category;
            return matchSearch && matchCategory;
          });
          
          // Ordenar
          if (sort === 'name') {
            filteredModules.sort((a, b) => a.name.localeCompare(b.name));
          } else if (sort === 'type') {
            filteredModules.sort((a, b) => (a.category || '').localeCompare(b.category || ''));
          }
          
          renderModules();
        }

        function renderModules() {
          const grid = document.getElementById('modulesGrid');
          
          grid.innerHTML = filteredModules.map(module => `
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="block block-rounded block-link-shadow h-100" style="cursor: pointer;" onclick="window.showModuleDetail('${module.key}')">
                <div class="block-content block-content-full">
                  ${module.image ? `
                    <div class="bg-body-light rounded p-3 mb-3 text-center" style="background-color: #0a0e18 !important;">
                      <img src="${module.image}" alt="${module.name}" style="max-width: 100%; height: 120px; object-fit: contain;">
                    </div>
                  ` : `
                    <div class="bg-body-light rounded p-4 mb-3 text-center">
                      <i class="${module.icon || 'fa fa-cube'} fa-3x text-primary"></i>
                    </div>
                  `}
                  <h5 class="fw-bold mb-2">${module.name}</h5>
                  <p class="fs-sm text-muted mb-3" style="min-height: 40px;">${(module.desc || '').substring(0, 80)}${(module.desc || '').length > 80 ? '...' : ''}</p>
                  
                  <div class="mb-3">
                    <div class="fs-xs text-muted mb-1">Tamaños disponibles:</div>
                    <span class="badge bg-primary-light text-primary me-1">1×1</span>
                    <span class="badge bg-primary-light text-primary me-1">2×2</span>
                    <span class="badge bg-primary-light text-primary">3×3</span>
                  </div>
                  
                  <div class="d-flex justify-content-between fs-xs">
                    <span title="Funcionalidad"><i class="fa fa-cog text-primary"></i> ${module.scores.f}/5</span>
                    <span title="Durabilidad"><i class="fa fa-shield-alt text-success"></i> ${module.scores.d}/5</span>
                    <span title="Peso"><i class="fa fa-weight text-warning"></i> ${module.scores.w}/5</span>
                    <span title="Energía"><i class="fa fa-bolt text-info"></i> ${module.scores.e}/5</span>
                  </div>
                </div>
              </div>
            </div>
          `).join('');
          
          if (filteredModules.length === 0) {
            grid.innerHTML = `
              <div class="col-12">
                <div class="block block-rounded">
                  <div class="block-content text-center py-5">
                    <i class="fa fa-search fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No se encontraron módulos con los filtros aplicados</p>
                  </div>
                </div>
              </div>
            `;
          }
        }

        // Función global para mostrar detalle
        window.showModuleDetail = function(moduleKey) {
          const module = allModules.find(m => m.key === moduleKey);
          if (!module) return;
          
          document.getElementById('moduleDetailTitle').innerHTML = `
            <i class="${module.icon || 'fa fa-cube'} me-2"></i>${module.name}
          `;
          
          document.getElementById('moduleDetailBody').innerHTML = `
            <div class="row">
              <div class="col-md-5">
                ${module.image ? `
                  <div class="bg-body-light rounded p-4 text-center mb-3" style="background-color: #fdf5e4 !important;">
                    <img src="${module.image}" alt="${module.name}" style="max-width: 100%; max-height: 250px; object-fit: contain;">
                  </div>
                ` : `
                  <div class="bg-body-light rounded p-5 text-center mb-3">
                    <i class="${module.icon || 'fa fa-cube'} fa-5x text-primary"></i>
                  </div>
                `}
                <div class="mb-3">
                  <h6 class="fw-bold mb-2">Tamaños disponibles:</h6>
                  <span class="badge bg-primary me-1">1×1</span>
                  <span class="badge bg-primary me-1">2×2</span>
                  <span class="badge bg-primary">3×3</span>
                </div>
              </div>
              <div class="col-md-7">
                <h6 class="fw-bold mb-2">Descripción</h6>
                <p class="text-muted">${module.desc || 'Módulo esencial para hábitats espaciales.'}</p>
                
                <h6 class="fw-bold mt-3 mb-2">Métricas de Rendimiento</h6>
                <div class="mb-2">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="fs-sm">Funcionalidad</span>
                    <span class="fs-sm fw-semibold">${module.scores.f}/5</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: ${module.scores.f * 20}%"></div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="fs-sm">Durabilidad</span>
                    <span class="fs-sm fw-semibold">${module.scores.d}/5</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" style="width: ${module.scores.d * 20}%"></div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="fs-sm">Peso</span>
                    <span class="fs-sm fw-semibold">${module.scores.w}/5</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-warning" style="width: ${module.scores.w * 20}%"></div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="fs-sm">Costo</span>
                    <span class="fs-sm fw-semibold">${module.scores.cost}/5</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-danger" style="width: ${module.scores.cost * 20}%"></div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="fs-sm">Energía</span>
                    <span class="fs-sm fw-semibold">${module.scores.e}/5</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-info" style="width: ${module.scores.e * 20}%"></div>
                  </div>
                </div>

                <h6 class="fw-bold mt-4 mb-2">Sugerencias de Colocación</h6>
                <ul class="fs-sm">
                  <li>Colocar cerca de módulos complementarios</li>
                  <li>Considerar acceso a pasillos principales</li>
                  <li>Verificar requisitos de adyacencia</li>
                </ul>
              </div>
            </div>
          `;
          
          document.getElementById('useModuleBtn').href = `/modules/dashboard/habitats/new.php?add=${moduleKey}`;
          
          const modal = new bootstrap.Modal(document.getElementById('moduleDetailModal'));
          modal.show();
        };
      </script>
<?php
include __DIR__.'/../../includes/footer.php';
?>

      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        <div class="content">
          <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
              <h1 class="h3 fw-bold mb-2">
                Modules
              </h1>
              <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                Browse and learn about habitat modules
              </h2>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          <!-- Coming Soon -->
          <div class="block block-rounded">
            <div class="block-content block-content-full text-center py-5">
              <i class="fa fa-cubes fa-4x text-primary mb-3"></i>
              <h3 class="fw-bold mb-2">Module Library</h3>
              <p class="text-muted">
                Detailed specifications, comparisons, and information about all available habitat modules. Coming soon!
              </p>
            </div>
          </div>
          <!-- END Coming Soon -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
<?php
include __DIR__.'/../../includes/footer.php';
?>
