<?php
include __DIR__.'/../../includes/header.php';
include __DIR__.'/../../includes/sidebar-right.php';
include __DIR__.'/../../includes/sidebar-left.php';
include __DIR__.'/../../includes/topbar.php';
?>

<!-- Estilos del habitat designer -->
<link rel="stylesheet" href="/modules/habitat/assets/css/style.css">

<style>
      /* ===== Modal grande (ficha) ===== */
    #moduleModal .block-header.bg-primary .block-title,
    #moduleModal .block-header.bg-primary .block-title * { color:#fff !important; }

    /* Fondo crema para la media */
    #moduleModal .mm-media {
      background:#fdf5e4;
      width:100%;
      aspect-ratio:16/10;
      display:flex; align-items:center; justify-content:center; overflow:hidden;
      border:1px solid rgba(0,0,0,.08); border-radius:.5rem;
    }
    #moduleModal #mmImage { max-width:100%; max-height:100%; object-fit:contain; display:none; }
    #moduleModal #mmIcon  { font-size:48px; line-height:1; display:none; }

    /* Títulos y textos con contraste negro sobre fondo claro */
    #moduleModal .text-on-light,
    #moduleModal #mmDesc { color:#111 !important; }

    /* Etiqueta “característica” y valor con buen contraste */
    #mmStats .me-2 { color:#111 !important; font-weight:600; }
    #mmStats .ms-2 { color:#111 !important; font-weight:600; }
    #moduleModal .progress { height:8px; }

    /* Botones de talla centrados; números SIEMPRE en blanco */
    #moduleModal .mm-size-btn { min-width:140px; }
    #moduleModal .mm-size-btn .dim { color:#fff !important; font-weight:700; }
    #moduleModal .mm-size-btn.active {
      border-color: var(--bs-primary);
      background-color: var(--bs-primary);
      color:#fff;
    }

    /* ===== Quick-modal (opciones del módulo) ===== */
    #moduleQuick .block-header { background:#fff; color:#111; border-bottom:1px solid rgba(0,0,0,.08); }
    #moduleQuick .block-title { color:#111 !important; }
  #moduleQuick .mm-size-btn .dim { color:#fff !important; font-weight:700; }
  #moduleQuick .mm-size-btn.active,
  #moduleQuick .mm-size-btn.btn-primary { color:#fff; }
</style>

      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        <div class="content">
          <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
              <h1 class="h3 fw-bold mb-2">
                🛰️ Habitat Designer
              </h1>
              <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                Design and optimize your space habitat layout
              </h2>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content content-full">
          <div class="designer">
      <!-- Panel izquierdo: categorías + módulos -->
      <aside class="modules-panel">
        <h2>Categories</h2>
        <div id="categoryList"></div>
        <hr class="divider">
        <h2>Modules</h2>
        <div id="modulesList"></div>
      </aside>

            <!-- Centro: grid -->
            <main class="grid-area">
              <div class="grid-controls">
                <h2>🗺️ Layout del Hábitat</h2>
                <div>
                  <button id="btnClear">Clean</button>
                  <button id="btnExport">Export</button>
                </div>
              </div>
              <div class="habitat-grid" id="grid"></div>
            </main>

      <!-- Derecha: stats -->
      <aside class="info-panel">
        <h2>Information</h2>

        <div class="stat-item">
          <div class="stat-label">Occupied cells</div>
          <div class="stat-value" id="occupiedCells">0 / 100</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Modules installed</div>
          <div class="stat-value" id="moduleCount">0</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Occupied area</div>
          <div class="stat-value" id="efficiency">0%</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Crew (default)</div>
          <div class="stat-value" id="crewSize">6</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Total score (1–5)</div>
          <div class="stat-value" id="habScore">0.00</div>
        </div>

        <div class="module-list">
          <strong class="list-title">Active modules:</strong>
          <div id="activeModules"></div>
              </div>
            </aside>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

  <!-- ========== Modal: Ficha/Configuración (grande) ========== -->
  <div class="modal fade" id="moduleModal" tabindex="-1" aria-labelledby="moduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="block block-rounded mb-0">
          <div class="block-header bg-primary text-white">
            <h3 class="block-title text-white text-uppercase mb-0" id="moduleModalLabel">
              <span id="mmTitle">Module</span>
            </h3>
            <div class="block-options">
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times me-1"></i> Close
              </button>
            </div>
          </div>

          <div class="block-content">
            <div class="row g-4 align-items-start">
              <!-- Media -->
              <div class="col-md-5">
                <div class="mm-media">
                  <img id="mmImage" alt="preview">
                  <span id="mmIcon"></span>
                </div>
              </div>

              <!-- Texto + stats -->
              <div class="col-md-7">
                <p id="mmDesc" class="fs-sm text-on-light mb-3">—</p>

                <h6 class="fw-semibold text-on-light mb-2">Characteristics (1–5)</h6>
                <div id="mmStats"></div>
              </div>
            </div>
          </div>

          <!-- Footer: solo selección de tamaño, centrada -->
          <div class="block-content block-content-full bg-body">
            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
              <button type="button" class="btn btn-sm mm-size-btn btn-alt-primary" data-size="small">
                Small <span class="dim ms-2">1×1</span>
              </button>
              <button type="button" class="btn btn-sm mm-size-btn btn-alt-primary" data-size="medium">
                Medium <span class="dim ms-2">2×2</span>
              </button>
              <button type="button" class="btn btn-sm mm-size-btn btn-alt-primary" data-size="large">
                Large <span class="dim ms-2">3×3</span>
              </button>
            </div>
          </div>

        </div><!-- /.block -->
      </div>
    </div>
  </div>

  <!-- ========== Quick Modal: opciones sobre módulo colocado ========== -->
  <div class="modal fade" id="moduleQuick" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="block block-rounded mb-0">
          <div class="block-header">
            <h3 class="block-title" id="mqTitle">Configure module</h3>
            <div class="block-options">
              <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>

          <div class="block-content">
            <div class="text-center mb-3" style="color:#111">Size (always square)</div>

            <div class="d-flex justify-content-center gap-2 flex-wrap">
              <button id="mqSizeS" type="button" class="btn btn-sm btn-outline-primary mm-size-btn">
                Small <span class="dim ms-2">1×1</span>
              </button>
              <button id="mqSizeM" type="button" class="btn btn-sm btn-outline-primary mm-size-btn">
                Medium <span class="dim ms-2">2×2</span>
              </button>
              <button id="mqSizeL" type="button" class="btn btn-sm btn-outline-primary mm-size-btn">
                Large <span class="dim ms-2">3×3</span>
              </button>
            </div>

            <hr class="my-3">
            <div class="d-flex justify-content-center">
              <button id="mqDelete" type="button" class="btn btn-sm btn-alt-danger">
                <i class="fa fa-trash me-1"></i> Remove module
              </button>
            </div>
          </div>

        </div><!-- /.block -->
      </div>
    </div>
  </div>

  <!-- libs -->
  <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

  <!-- Shim: injerta MODULE_SCORES como stats dentro de MODULE_CATALOG (para el modal grande) -->
  <script type="module">
    import { MODULE_CATALOG, MODULE_SCORES } from '/modules/habitat/assets/js/specs.js';
    for (const k in MODULE_SCORES) {
      if (!MODULE_CATALOG[k]) MODULE_CATALOG[k] = {};
      MODULE_CATALOG[k].stats = MODULE_SCORES[k];
    }
  </script>

  <!-- app -->
  <script type="module" src="/modules/habitat/assets/js/main.js"></script>

<?php
include __DIR__.'/../../includes/footer.php';
?>
