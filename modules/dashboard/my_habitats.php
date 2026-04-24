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
                <i class="fa fa-building text-primary me-2"></i>Mis Hábitats
              </h1>
              <h2 class="h6 fw-medium text-muted mb-0">
                Gestiona y edita tus diseños de hábitats espaciales
              </h2>
            </div>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
              <button type="button" class="btn btn-sm btn-alt-secondary" id="toggleView">
                <i class="fa fa-th-large me-1"></i>
                <span id="toggleViewText">Vista Cards</span>
              </button>
              <a class="btn btn-sm btn-primary" href="/modules/dashboard/habitats/new.php">
                <i class="fa fa-plus opacity-50 me-1"></i>
                Crear Nuevo Hábitat
              </a>
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
                <div class="col-md-3">
                  <label class="form-label">Etiqueta</label>
                  <select class="form-select" id="filterTag">
                    <option value="">Todas</option>
                    <option value="Luna">Luna</option>
                    <option value="Tránsito">Tránsito</option>
                    <option value="Marte">Marte</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Estado</label>
                  <select class="form-select" id="filterStatus">
                    <option value="">Todos</option>
                    <option value="draft">Borrador</option>
                    <option value="published">Publicado</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Ordenar por</label>
                  <select class="form-select" id="sortBy">
                    <option value="date">Fecha</option>
                    <option value="name">Nombre</option>
                    <option value="score">Puntuación</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Buscar</label>
                  <input type="text" class="form-control" id="searchInput" placeholder="Buscar hábitats...">
                </div>
              </div>
            </div>
          </div>
          <!-- END Filtros -->

          <!-- Vista Tabla -->
          <div class="block block-rounded" id="tableView">
            <div class="block-header block-header-default">
              <h3 class="block-title">Listado de Hábitats</h3>
              <div class="block-options">
                <span class="badge bg-primary" id="habitatCount">0</span>
              </div>
            </div>
            <div class="block-content block-content-full">
              <div class="table-responsive">
                <table class="table table-hover table-vcenter">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th class="d-none d-md-table-cell">Fecha</th>
                      <th class="text-center">Puntuación</th>
                      <th class="d-none d-lg-table-cell">Módulos</th>
                      <th class="text-center">Estado</th>
                      <th class="text-end">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="habitatsTableBody" class="fs-sm">
                    <!-- Se llena dinámicamente -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- END Vista Tabla -->

          <!-- Vista Cards -->
          <div id="cardsView" class="d-none">
            <div class="row" id="habitatsCardsContainer">
              <!-- Se llena dinámicamente -->
            </div>
          </div>
          <!-- END Vista Cards -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Modal Export JSON -->
      <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exportModalLabel">Exportar Hábitat</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="text-muted">Copia el siguiente JSON de tu hábitat:</p>
              <pre id="exportJsonContent" class="bg-body-light p-3 rounded" style="max-height: 300px; overflow-y: auto;"></pre>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-sm btn-primary" id="copyJsonBtn">
                <i class="fa fa-copy me-1"></i>Copiar
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Scripts -->
      <script src="/modules/dashboard/_data/seed-habitats.js"></script>
      
      <script>
        let currentView = 'table';
        let currentHabitats = [];

        document.addEventListener('DOMContentLoaded', function() {
          currentHabitats = [...window.SEED_HABITATS];
          renderHabitats();
          
          // Toggle vista
          document.getElementById('toggleView').addEventListener('click', function() {
            currentView = currentView === 'table' ? 'cards' : 'table';
            document.getElementById('tableView').classList.toggle('d-none');
            document.getElementById('cardsView').classList.toggle('d-none');
            document.getElementById('toggleViewText').textContent = currentView === 'table' ? 'Vista Cards' : 'Vista Tabla';
          });

          // Filtros y búsqueda
          document.getElementById('filterTag').addEventListener('change', applyFilters);
          document.getElementById('filterStatus').addEventListener('change', applyFilters);
          document.getElementById('sortBy').addEventListener('change', applyFilters);
          document.getElementById('searchInput').addEventListener('input', applyFilters);
        });

        function applyFilters() {
          let filtered = [...window.SEED_HABITATS];
          
          const tag = document.getElementById('filterTag').value;
          const status = document.getElementById('filterStatus').value;
          const sortBy = document.getElementById('sortBy').value;
          const search = document.getElementById('searchInput').value.toLowerCase();
          
          if (tag) filtered = filtered.filter(h => h.tags.includes(tag));
          if (status) filtered = filtered.filter(h => h.status === status);
          if (search) filtered = filtered.filter(h => h.name.toLowerCase().includes(search));
          
          // Ordenar
          filtered.sort((a, b) => {
            if (sortBy === 'name') return a.name.localeCompare(b.name);
            if (sortBy === 'score') return b.score - a.score;
            return new Date(b.updatedAt) - new Date(a.updatedAt);
          });
          
          currentHabitats = filtered;
          renderHabitats();
        }

        function renderHabitats() {
          const tableBody = document.getElementById('habitatsTableBody');
          const cardsContainer = document.getElementById('habitatsCardsContainer');
          
          document.getElementById('habitatCount').textContent = currentHabitats.length;
          
          // Render tabla
          tableBody.innerHTML = currentHabitats.map(habitat => `
            <tr>
              <td>
                <span class="fw-semibold">${habitat.name}</span>
                <div class="fs-xs text-muted">${habitat.id}</div>
              </td>
              <td class="d-none d-md-table-cell text-muted">${formatDate(habitat.updatedAt)}</td>
              <td class="text-center">
                <span class="badge bg-warning rounded-pill">
                  <i class="fa fa-star"></i> ${habitat.score.toFixed(1)}
                </span>
              </td>
              <td class="d-none d-lg-table-cell">
                <span class="badge bg-primary rounded-pill">${habitat.modules.length} módulos</span>
                <span class="fs-xs text-muted ms-2">${habitat.cellsUsed} celdas</span>
              </td>
              <td class="text-center">
                <span class="badge ${habitat.status === 'published' ? 'bg-success' : 'bg-secondary'}">
                  ${habitat.status === 'published' ? 'Publicado' : 'Borrador'}
                </span>
              </td>
              <td class="text-end">
                <div class="btn-group btn-group-sm" role="group">
                  <a href="/modules/dashboard/habitats/new.php?id=${habitat.id}" class="btn btn-sm btn-alt-secondary" title="Editar">
                    <i class="fa fa-edit"></i>
                  </a>
                  <button type="button" class="btn btn-sm btn-alt-secondary" onclick="duplicateHabitat('${habitat.id}')" title="Duplicar">
                    <i class="fa fa-copy"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-alt-secondary" onclick="exportHabitat('${habitat.id}')" title="Exportar">
                    <i class="fa fa-download"></i>
                  </button>
                  <button type="button" class="btn btn-sm ${habitat.status === 'published' ? 'btn-alt-secondary' : 'btn-alt-success'}" onclick="togglePublish('${habitat.id}')" title="${habitat.status === 'published' ? 'Despublicar' : 'Publicar'}">
                    <i class="fa fa-${habitat.status === 'published' ? 'eye-slash' : 'globe'}"></i>
                  </button>
                </div>
              </td>
            </tr>
          `).join('');
          
          // Render cards
          cardsContainer.innerHTML = currentHabitats.map(habitat => `
            <div class="col-md-6 col-xl-4">
              <div class="block block-rounded">
                <div class="block-content block-content-full">
                  <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                      <h4 class="h5 mb-1">${habitat.name}</h4>
                      <p class="fs-sm text-muted mb-2">${habitat.id}</p>
                    </div>
                    <span class="badge ${habitat.status === 'published' ? 'bg-success' : 'bg-secondary'}">
                      ${habitat.status === 'published' ? 'Publicado' : 'Borrador'}
                    </span>
                  </div>
                  <div class="mb-3">
                    ${habitat.tags.map(tag => `<span class="badge bg-primary-light text-primary me-1">${tag}</span>`).join('')}
                  </div>
                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <div class="fs-xs text-muted">Puntuación</div>
                      <div class="fw-semibold"><i class="fa fa-star text-warning"></i> ${habitat.score.toFixed(1)}</div>
                    </div>
                    <div class="col-6">
                      <div class="fs-xs text-muted">Módulos</div>
                      <div class="fw-semibold">${habitat.modules.length} unidades</div>
                    </div>
                  </div>
                  <div class="fs-xs text-muted mb-3">
                    <i class="fa fa-clock me-1"></i> ${formatDate(habitat.updatedAt)}
                  </div>
                  <div class="d-flex gap-1">
                    <a href="/modules/dashboard/habitats/new.php?id=${habitat.id}" class="btn btn-sm btn-primary flex-fill">
                      <i class="fa fa-edit me-1"></i> Editar
                    </a>
                    <button class="btn btn-sm btn-alt-secondary" onclick="duplicateHabitat('${habitat.id}')">
                      <i class="fa fa-copy"></i>
                    </button>
                    <button class="btn btn-sm btn-alt-secondary" onclick="exportHabitat('${habitat.id}')">
                      <i class="fa fa-download"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          `).join('');
        }

        function formatDate(dateString) {
          const date = new Date(dateString);
          const now = new Date();
          const diffDays = Math.floor((now - date) / (1000 * 60 * 60 * 24));
          
          if (diffDays === 0) return 'Hoy';
          if (diffDays === 1) return 'Ayer';
          if (diffDays < 7) return `Hace ${diffDays} días`;
          return date.toLocaleDateString('es-ES');
        }

        function duplicateHabitat(id) {
          const habitat = currentHabitats.find(h => h.id === id);
          if (habitat) {
            showToast('success', `Hábitat "${habitat.name}" duplicado correctamente`);
            // En una app real, aquí clonarías el hábitat
          }
        }

        function exportHabitat(id) {
          const habitat = currentHabitats.find(h => h.id === id);
          if (habitat) {
            document.getElementById('exportJsonContent').textContent = JSON.stringify(habitat, null, 2);
            const modal = new bootstrap.Modal(document.getElementById('exportModal'));
            modal.show();
          }
        }

        function togglePublish(id) {
          const habitat = window.SEED_HABITATS.find(h => h.id === id);
          if (habitat) {
            habitat.status = habitat.status === 'published' ? 'draft' : 'published';
            applyFilters();
            showToast('success', `Hábitat ${habitat.status === 'published' ? 'publicado' : 'despublicado'} correctamente`);
          }
        }

        function showToast(type, message) {
          // Toast simple con Bootstrap
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

        // Copiar JSON
        document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('copyJsonBtn')?.addEventListener('click', function() {
            const content = document.getElementById('exportJsonContent').textContent;
            navigator.clipboard.writeText(content).then(() => {
              showToast('success', 'JSON copiado al portapapeles');
            });
          });
        });
      </script>
<?php
include __DIR__.'/../../includes/footer.php';
?>
