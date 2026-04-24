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
                <i class="fa fa-chart-line text-primary me-2"></i>Analíticas
              </h1>
              <h2 class="h6 fw-medium text-muted mb-0">
                Métricas de tus diseños y estadísticas personales
              </h2>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          <!-- Gráficas Row 1 -->
          <div class="row">
            <div class="col-lg-6">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Celdas por Categoría</h3>
                </div>
                <div class="block-content">
                  <canvas id="cellsByCategoryChart" style="height: 300px;"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Módulos Más Usados</h3>
                </div>
                <div class="block-content">
                  <canvas id="topModulesChart" style="height: 300px;"></canvas>
                </div>
              </div>
            </div>
          </div>
          <!-- END Row 1 -->

          <!-- Gráficas Row 2 -->
          <div class="row">
            <div class="col-lg-6">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Puntuación por Proyecto</h3>
                </div>
                <div class="block-content">
                  <canvas id="scoreByProjectChart" style="height: 300px;"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Tiempo de Edición (Semanal)</h3>
                  <div class="block-options">
                    <span class="badge bg-primary">Personal vs Comunidad</span>
                  </div>
                </div>
                <div class="block-content">
                  <canvas id="editingTimeChart" style="height: 300px;"></canvas>
                </div>
              </div>
            </div>
          </div>
          <!-- END Row 2 -->

          <!-- Estadísticas Resumidas -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Resumen de Actividad</h3>
            </div>
            <div class="block-content">
              <div class="row text-center">
                <div class="col-md-3">
                  <div class="py-3">
                    <div class="fs-1 fw-bold text-primary mb-2" id="totalProjects">0</div>
                    <div class="fs-sm text-muted">Proyectos Totales</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="py-3">
                    <div class="fs-1 fw-bold text-success mb-2" id="avgScoreDisplay">0.0</div>
                    <div class="fs-sm text-muted">Puntuación Media</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="py-3">
                    <div class="fs-1 fw-bold text-warning mb-2" id="totalHoursDisplay">0h</div>
                    <div class="fs-sm text-muted">Horas Totales</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="py-3">
                    <div class="fs-1 fw-bold text-info mb-2" id="rankPosition">#-</div>
                    <div class="fs-sm text-muted">Ranking Global</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Estadísticas -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Scripts -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
      <script src="/modules/dashboard/_data/seed-analytics.js"></script>
      
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          if (!window.SEED_ANALYTICS) return;
          
          const data = window.SEED_ANALYTICS;
          
          // Actualizar estadísticas resumidas
          document.getElementById('totalProjects').textContent = data.globalStats.totalHabitats;
          document.getElementById('avgScoreDisplay').textContent = data.globalStats.avgScore.toFixed(2);
          document.getElementById('totalHoursDisplay').textContent = data.globalStats.totalHours + 'h';
          document.getElementById('rankPosition').textContent = '#12';
          
          // Gráfica: Celdas por Categoría
          new Chart(document.getElementById('cellsByCategoryChart'), {
            type: 'bar',
            data: {
              labels: data.cellsByCategory.labels,
              datasets: [{
                label: 'Celdas',
                data: data.cellsByCategory.data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: { display: false }
              }
            }
          });
          
          // Gráfica: Módulos Más Usados
          new Chart(document.getElementById('topModulesChart'), {
            type: 'doughnut',
            data: {
              labels: data.topModules.labels,
              datasets: [{
                data: data.topModules.data,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.7)',
                  'rgba(54, 162, 235, 0.7)',
                  'rgba(255, 206, 86, 0.7)',
                  'rgba(75, 192, 192, 0.7)',
                  'rgba(153, 102, 255, 0.7)'
                ]
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false
            }
          });
          
          // Gráfica: Puntuación por Proyecto
          new Chart(document.getElementById('scoreByProjectChart'), {
            type: 'line',
            data: {
              labels: data.scoreByProject.labels,
              datasets: [{
                label: 'Puntuación',
                data: data.scoreByProject.data,
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                fill: true,
                tension: 0.4
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true,
                  max: 5
                }
              }
            }
          });
          
          // Gráfica: Tiempo de Edición
          new Chart(document.getElementById('editingTimeChart'), {
            type: 'bar',
            data: {
              labels: data.editingTime.labels,
              datasets: [
                {
                  label: 'Tu tiempo (h)',
                  data: data.editingTime.personal,
                  backgroundColor: 'rgba(75, 192, 192, 0.5)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
                },
                {
                  label: 'Media comunidad (h)',
                  data: data.editingTime.community,
                  backgroundColor: 'rgba(201, 203, 207, 0.5)',
                  borderColor: 'rgba(201, 203, 207, 1)',
                  borderWidth: 1
                }
              ]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false
            }
          });
        });
      </script>
<?php
include __DIR__.'/../../includes/footer.php';
?>
