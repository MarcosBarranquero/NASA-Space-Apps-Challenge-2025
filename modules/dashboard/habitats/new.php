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
                <i class="fa fa-pencil-ruler text-primary me-2"></i>Editor de Hábitat
              </h1>
              <h2 class="h6 fw-medium text-muted mb-0">
                Diseña y optimiza tu hábitat espacial
              </h2>
            </div>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
              <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#presetModal">
                <i class="fa fa-layer-group me-1"></i>
                Cargar Preset
              </button>
              <button type="button" class="btn btn-sm btn-alt-secondary" id="exportBtn">
                <i class="fa fa-download me-1"></i>
                Exportar JSON
              </button>
              <button type="button" class="btn btn-sm btn-success" id="saveBtn">
                <i class="fa fa-save me-1"></i>
                Guardar
              </button>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          <!-- Integración del maquetador existente -->
          <div class="alert alert-info d-flex align-items-center mb-3">
            <i class="fa fa-info-circle me-2"></i>
            <div>
              <strong>Editor integrado:</strong> El maquetador visual de hábitats se cargará aquí. 
              Los estilos y scripts del módulo /modules/habitat/ se mantienen intactos.
            </div>
          </div>

          <!-- Aquí se incluiría el iframe o contenido del maquetador -->
          <div class="block block-rounded">
            <div class="block-content p-0">
              <!-- Placeholder para el maquetador existente -->
              <div class="text-center py-5">
                <i class="fa fa-tools fa-4x text-muted mb-3"></i>
                <h4 class="mb-2">Maquetador de Hábitats</h4>
                <p class="text-muted">
                  Aquí se integraría el maquetador existente de /modules/habitat/<br>
                  Manteniendo todos sus estilos, scripts y funcionalidad intactos.
                </p>
                <div class="mt-4">
                  <p class="fw-semibold mb-2">Enlaces necesarios para integrar:</p>
                  <code class="d-block bg-body-light p-2 mb-2">&lt;link rel="stylesheet" href="/modules/habitat/assets/css/style.css"&gt;</code>
                  <code class="d-block bg-body-light p-2 mb-2">&lt;script type="module" src="/modules/habitat/assets/js/main.js"&gt;&lt;/script&gt;</code>
                  <code class="d-block bg-body-light p-2">&lt;script type="module" src="/modules/habitat/assets/js/specs.js"&gt;&lt;/script&gt;</code>
                </div>
                <a href="/modules/habitat/" class="btn btn-primary mt-4">
                  <i class="fa fa-external-link-alt me-1"></i>
                  Ver Maquetador Original
                </a>
              </div>
            </div>
          </div>

          <!-- Sidebar de recomendaciones -->
          <div class="row mt-3">
            <div class="col-lg-8">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">
                    <i class="fa fa-lightbulb text-warning me-2"></i>
                    Recomendaciones de Diseño
                  </h3>
                </div>
                <div class="block-content">
                  <ul class="list-unstyled" id="recommendationsList">
                    <li class="mb-2">
                      <i class="fa fa-check-circle text-success me-2"></i>
                      Coloca el Soporte Vital cerca del núcleo central
                    </li>
                    <li class="mb-2">
                      <i class="fa fa-check-circle text-success me-2"></i>
                      Asegura redundancia en sistemas críticos
                    </li>
                    <li class="mb-2">
                      <i class="fa fa-check-circle text-success me-2"></i>
                      Agrupa módulos por función para optimizar flujo
                    </li>
                    <li class="mb-2">
                      <i class="fa fa-check-circle text-success me-2"></i>
                      Considera rutas de evacuación claras
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Estadísticas</h3>
                </div>
                <div class="block-content">
                  <div class="mb-3">
                    <div class="fs-sm text-muted mb-1">Celdas ocupadas</div>
                    <div class="fs-3 fw-bold text-primary" id="cellsCount">0</div>
                  </div>
                  <div class="mb-3">
                    <div class="fs-sm text-muted mb-1">Módulos totales</div>
                    <div class="fs-3 fw-bold text-primary" id="modulesCount">0</div>
                  </div>
                  <div class="mb-3">
                    <div class="fs-sm text-muted mb-1">Puntuación estimada</div>
                    <div class="fs-3 fw-bold text-warning" id="scoreEstimate">0.0</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Modal Presets -->
      <div class="modal fade" id="presetModal" tabindex="-1" aria-labelledby="presetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="presetModalLabel">
                <i class="fa fa-layer-group me-2"></i>Cargar Preset
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row" id="presetsContainer">
                <!-- Se llena dinámicamente -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Scripts -->
      <script src="/modules/dashboard/_data/seed-presets.js"></script>
      <script src="/modules/dashboard/_data/seed-habitats.js"></script>
      
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Cargar presets en modal
          loadPresets();
          
          // Guardar
          document.getElementById('saveBtn').addEventListener('click', function() {
            showToast('success', 'Hábitat guardado correctamente');
          });
          
          // Exportar
          document.getElementById('exportBtn').addEventListener('click', function() {
            const dummyExport = {
              id: 'HAB-NEW',
              name: 'Nuevo Hábitat',
              modules: [],
              score: 0,
              createdAt: new Date().toISOString()
            };
            downloadJSON(dummyExport, 'habitat-export.json');
            showToast('success', 'Hábitat exportado correctamente');
          });
          
          // Si hay query param ?id, simular carga
          const urlParams = new URLSearchParams(window.location.search);
          const habitatId = urlParams.get('id');
          if (habitatId) {
            const habitat = window.SEED_HABITATS?.find(h => h.id === habitatId);
            if (habitat) {
              document.querySelector('.h3').innerHTML = `<i class="fa fa-pencil-ruler text-primary me-2"></i>Editando: ${habitat.name}`;
              document.getElementById('cellsCount').textContent = habitat.cellsUsed;
              document.getElementById('modulesCount').textContent = habitat.modules.length;
              document.getElementById('scoreEstimate').textContent = habitat.score.toFixed(1);
            }
          }
        });

        function loadPresets() {
          const container = document.getElementById('presetsContainer');
          if (!window.SEED_PRESETS) return;
          
          container.innerHTML = window.SEED_PRESETS.map(preset => `
            <div class="col-md-4 mb-3">
              <div class="block block-rounded block-link-shadow h-100" style="cursor: pointer;" onclick="loadPreset('${preset.id}')">
                <div class="block-content text-center">
                  <div class="py-3">
                    <i class="fa fa-rocket fa-3x text-primary mb-2"></i>
                    <h5 class="fw-bold mb-1">${preset.title}</h5>
                    <p class="fs-sm text-muted mb-2">${preset.description}</p>
                    <div class="d-flex justify-content-around mt-3">
                      <div>
                        <div class="fs-xs text-muted">Tripulación</div>
                        <div class="fw-semibold">${preset.crew}</div>
                      </div>
                      <div>
                        <div class="fs-xs text-muted">Duración</div>
                        <div class="fw-semibold">${preset.durationDays}d</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          `).join('');
        }

        function loadPreset(presetId) {
          const preset = window.SEED_PRESETS?.find(p => p.id === presetId);
          if (preset) {
            bootstrap.Modal.getInstance(document.getElementById('presetModal')).hide();
            showToast('success', `Preset "${preset.title}" cargado correctamente`);
          }
        }

        function showToast(type, message) {
          const toastContainer = document.createElement('div');
          toastContainer.style.position = 'fixed';
          toastContainer.style.top = '20px';
          toastContainer.style.right = '20px';
          toastContainer.style.zIndex = '9999';
          toastContainer.innerHTML = `
            <div class="alert alert-${type === 'success' ? 'success' : 'info'} alert-dismissible fade show" role="alert">
              ${message}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          `;
          document.body.appendChild(toastContainer);
          setTimeout(() => toastContainer.remove(), 3000);
        }

        function downloadJSON(data, filename) {
          const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
          const url = URL.createObjectURL(blob);
          const a = document.createElement('a');
          a.href = url;
          a.download = filename;
          a.click();
          URL.revokeObjectURL(url);
        }
      </script>
<?php
include __DIR__.'/../../../includes/footer.php';
?>
