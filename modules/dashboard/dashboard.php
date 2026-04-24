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
                <i class="fa fa-rocket text-primary me-2"></i>SpaceCrafter
              </h1>
              <h2 class="h6 fw-medium text-muted mb-0">
                Bienvenido <span class="fw-semibold" id="userName">SpaceArchitect</span>, todo luce perfecto.
              </h2>
            </div>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
              <a class="btn btn-sm btn-primary space-x-1" href="/modules/dashboard/habitats/new.php">
                <i class="fa fa-plus opacity-50"></i>
                <span>Nuevo Hábitat</span>
              </a>
              <a class="btn btn-sm btn-alt-secondary space-x-1" href="/modules/dashboard/presets/">
                <i class="fa fa-layer-group opacity-50"></i>
                <span>Cargar Preset</span>
              </a>
              <a class="btn btn-sm btn-alt-secondary space-x-1" href="/modules/dashboard/community.php">
                <i class="fa fa-trophy opacity-50"></i>
                <span>Ver Ranking</span>
              </a>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          <!-- Overview -->
          <div class="row items-push">
            <div class="col-sm-6 col-xxl-3">
              <!-- Hábitats Guardados -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold" id="totalHabitats">5</dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">Hábitats Guardados</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fa fa-building fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/modules/dashboard/my_habitats.php">
                    <span>Ver todos los hábitats</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END Hábitats Guardados -->
            </div>
            <div class="col-sm-6 col-xxl-3">
              <!-- Último Editado -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold text-truncate" id="lastEditedName">Lunar Shelter Alpha</dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">Último editado <span id="lastEditedTime">hace 1 día</span></dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fa fa-clock fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/modules/dashboard/habitats/new.php?id=HAB-001">
                    <span>Continuar edición</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END Último Editado -->
            </div>
            <div class="col-sm-6 col-xxl-3">
              <!-- Puntuación Media -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold" id="avgScore">3.96</dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">Puntuación Media</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fa fa-star fs-3 text-warning"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/modules/dashboard/analytics.php">
                    <span>Ver estadísticas</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END Puntuación Media -->
            </div>
            <div class="col-sm-6 col-xxl-3">
              <!-- Horas de Diseño -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold" id="totalHours">42.5h</dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">Horas de Diseño</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fa fa-chart-line fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/modules/dashboard/analytics.php">
                    <span>Ver analíticas</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END Horas de Diseño-->
            </div>
          </div>
          <!-- END Overview -->

          <!-- Notas y Alertas -->
          <div class="row">
            <div class="col-12">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">
                    <i class="fa fa-exclamation-triangle text-warning me-2"></i>
                    Conflictos y Recomendaciones
                  </h3>
                  <div class="block-options">
                    <button type="button" class="btn-block-option">
                      <i class="si si-settings"></i>
                    </button>
                  </div>
                </div>
                <div class="block-content" id="conflictsList">
                  <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                      <i class="fa fa-fw fa-exclamation-triangle"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <p class="mb-0">
                        <strong>HAB-005:</strong> Soporte vital sin redundancia
                      </p>
                    </div>
                  </div>
                  <div class="alert alert-info d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                      <i class="fa fa-fw fa-info-circle"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <p class="mb-0">
                        <strong>HAB-004:</strong> Muelle sin pasillo de seguridad
                      </p>
                    </div>
                  </div>
                  <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                      <i class="fa fa-fw fa-exclamation-triangle"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <p class="mb-0">
                        <strong>HAB-002:</strong> Eficiencia energética &lt; 50%
                      </p>
                    </div>
                  </div>
                  <div class="alert alert-info d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                      <i class="fa fa-fw fa-info-circle"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <p class="mb-0">
                        <strong>HAB-003:</strong> Considerar más espacio de almacenamiento
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Notas y Alertas -->

          <!-- Accesos Rápidos -->
          <div class="row">
            <div class="col-lg-4">
              <a class="block block-rounded block-link-shadow text-center" href="/modules/dashboard/modules.php">
                <div class="block-content block-content-full">
                  <div class="fs-2 fw-bold text-primary">
                    <i class="fa fa-cubes"></i>
                  </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                  <p class="fw-medium fs-sm text-muted mb-0">
                    Biblioteca de Módulos
                  </p>
                </div>
              </a>
            </div>
            <div class="col-lg-4">
              <a class="block block-rounded block-link-shadow text-center" href="/modules/dashboard/learn.php">
                <div class="block-content block-content-full">
                  <div class="fs-2 fw-bold text-success">
                    <i class="fa fa-book"></i>
                  </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                  <p class="fw-medium fs-sm text-muted mb-0">
                    Aprende Diseño Espacial
                  </p>
                </div>
              </a>
            </div>
            <div class="col-lg-4">
              <a class="block block-rounded block-link-shadow text-center" href="/modules/dashboard/community.php">
                <div class="block-content block-content-full">
                  <div class="fs-2 fw-bold text-info">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                  <p class="fw-medium fs-sm text-muted mb-0">
                    Comunidad y Ranking
                  </p>
                </div>
              </a>
            </div>
          </div>
          <!-- END Accesos Rápidos -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Scripts de datos -->
      <script src="/modules/dashboard/_data/seed-habitats.js"></script>
      <script src="/modules/dashboard/_data/seed-users.js"></script>
      <script src="/modules/dashboard/_data/seed-analytics.js"></script>
      
      <script>
        // Cargar datos en el dashboard
        document.addEventListener('DOMContentLoaded', function() {
          // Cargar estadísticas globales
          if (window.SEED_ANALYTICS && window.SEED_ANALYTICS.globalStats) {
            const stats = window.SEED_ANALYTICS.globalStats;
            document.getElementById('totalHabitats').textContent = stats.totalHabitats;
            document.getElementById('avgScore').textContent = stats.avgScore.toFixed(2);
            document.getElementById('totalHours').textContent = stats.totalHours + 'h';
          }
          
          // Cargar último editado
          if (window.SEED_HABITATS && window.SEED_HABITATS.length > 0) {
            const lastHabitat = window.SEED_HABITATS[0];
            document.getElementById('lastEditedName').textContent = lastHabitat.name;
            
            // Calcular tiempo relativo
            const lastUpdate = new Date(lastHabitat.updatedAt);
            const now = new Date();
            const diffDays = Math.floor((now - lastUpdate) / (1000 * 60 * 60 * 24));
            document.getElementById('lastEditedTime').textContent = diffDays === 0 ? 'hoy' : `hace ${diffDays} día${diffDays > 1 ? 's' : ''}`;
          }
          
          // Cargar nombre de usuario
          if (window.SEED_USERS && window.SEED_USERS.current) {
            document.getElementById('userName').textContent = window.SEED_USERS.current.username;
          }
        });
      </script>
<?php
include __DIR__.'/../../includes/footer.php';
?>
