<?php
include __DIR__.'/../../../includes/header.php';
include __DIR__.'/../../../includes/sidebar-right.php';
include __DIR__.'/../../../includes/sidebar-left.php';
include __DIR__.'/../../../includes/topbar.php';
?>
      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        <div class="content">
          <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
              <h1 class="h3 fw-bold mb-2">
                <i class="fa fa-layer-group text-primary me-2"></i>Presets de Escenarios
              </h1>
              <h2 class="h6 fw-medium text-muted mb-0">
                Escenarios predefinidos optimizados por NASA y ESA
              </h2>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          <div class="row" id="presetsGrid">
            <!-- Se llena dinámicamente -->
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Modal Detalle Preset -->
      <div class="modal fade" id="presetDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="presetDetailTitle"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="presetDetailBody"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Cerrar</button>
              <a href="#" class="btn btn-sm btn-primary" id="loadPresetBtn">
                <i class="fa fa-rocket me-1"></i>Cargar en Editor
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Scripts -->
      <script src="/modules/dashboard/_data/seed-presets.js"></script>
      
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          renderPresets();
        });

        function renderPresets() {
          const grid = document.getElementById('presetsGrid');
          
          grid.innerHTML = window.SEED_PRESETS.map(preset => `
            <div class="col-md-6 col-xl-4">
              <div class="block block-rounded h-100">
                <div class="block-content block-content-full">
                  <div class="text-center mb-3">
                    <div class="bg-body-light rounded p-4 mb-3">
                      <i class="fa fa-rocket fa-4x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-2">${preset.title}</h4>
                    <p class="text-muted fs-sm">${preset.description}</p>
                  </div>
                  
                  <div class="row g-3 mb-3">
                    <div class="col-6">
                      <div class="bg-body-light rounded p-3 text-center">
                        <div class="fs-xs text-muted mb-1">Tripulación</div>
                        <div class="fs-4 fw-bold text-primary">${preset.crew}</div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="bg-body-light rounded p-3 text-center">
                        <div class="fs-xs text-muted mb-1">Duración</div>
                        <div class="fs-4 fw-bold text-primary">${preset.durationDays}d</div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="fs-xs text-muted mb-2">Módulos incluidos:</div>
                    <span class="badge bg-primary rounded-pill">${preset.modules.length} módulos</span>
                  </div>
                  
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-alt-secondary flex-fill" onclick="showPresetDetail('${preset.id}')">
                      <i class="fa fa-info-circle me-1"></i>Detalles
                    </button>
                    <a href="/modules/dashboard/habitats/new.php?preset=${preset.id}" class="btn btn-sm btn-primary flex-fill">
                      <i class="fa fa-rocket me-1"></i>Cargar
                    </a>
                  </div>
                </div>
              </div>
            </div>
          `).join('');
        }

        function showPresetDetail(presetId) {
          const preset = window.SEED_PRESETS.find(p => p.id === presetId);
          if (!preset) return;
          
          document.getElementById('presetDetailTitle').innerHTML = `
            <i class="fa fa-rocket me-2"></i>${preset.title}
          `;
          
          document.getElementById('presetDetailBody').innerHTML = `
            <div class="row">
              <div class="col-md-4">
                <div class="bg-body-light rounded p-5 text-center mb-3">
                  <i class="fa fa-rocket fa-5x text-primary"></i>
                </div>
                <div class="text-center">
                  <div class="mb-2">
                    <span class="badge bg-primary">Tripulación: ${preset.crew}</span>
                  </div>
                  <div class="mb-2">
                    <span class="badge bg-info">Duración: ${preset.durationDays} días</span>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <h6 class="fw-bold mb-2">Descripción</h6>
                <p class="text-muted">${preset.description}</p>
                
                <h6 class="fw-bold mt-3 mb-2">Módulos Incluidos</h6>
                <div class="mb-3">
                  ${preset.modules.map(m => `<span class="badge bg-primary-light text-primary me-1 mb-1">${m}</span>`).join('')}
                </div>
                
                <h6 class="fw-bold mt-3 mb-2">Requisitos</h6>
                <ul class="fs-sm">
                  <li>Celdas mínimas: ${preset.requirements.minCells}</li>
                  <li>Celdas máximas: ${preset.requirements.maxCells}</li>
                  <li>Categorías requeridas: ${preset.requirements.categories.length}</li>
                </ul>
                
                <div class="alert alert-info mt-3">
                  <i class="fa fa-info-circle me-2"></i>
                  Este preset ha sido optimizado según estándares NASA/ESA
                </div>
              </div>
            </div>
          `;
          
          document.getElementById('loadPresetBtn').href = `/modules/dashboard/habitats/new.php?preset=${preset.id}`;
          
          const modal = new bootstrap.Modal(document.getElementById('presetDetailModal'));
          modal.show();
        }
      </script>
<?php
include __DIR__.'/../../../includes/footer.php';
?>
