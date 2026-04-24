/**
 * SpaceCrafter Dashboard - Utilidades JavaScript Comunes
 */

// Función para mostrar toasts/notificaciones
function showToast(type, message, duration = 3000) {
  const toastContainer = document.createElement('div');
  toastContainer.style.position = 'fixed';
  toastContainer.style.top = '20px';
  toastContainer.style.right = '20px';
  toastContainer.style.zIndex = '9999';
  
  const alertClass = type === 'success' ? 'alert-success' : 
                     type === 'error' ? 'alert-danger' :
                     type === 'warning' ? 'alert-warning' : 'alert-info';
  
  toastContainer.innerHTML = `
    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
      <i class="fa fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `;
  
  document.body.appendChild(toastContainer);
  setTimeout(() => toastContainer.remove(), duration);
}

// Formatear fecha relativa
function formatRelativeDate(dateString) {
  const date = new Date(dateString);
  const now = new Date();
  const diffMs = now - date;
  const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
  const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
  const diffMinutes = Math.floor(diffMs / (1000 * 60));
  
  if (diffMinutes < 1) return 'Ahora mismo';
  if (diffMinutes < 60) return `Hace ${diffMinutes} min`;
  if (diffHours < 24) return `Hace ${diffHours}h`;
  if (diffDays === 0) return 'Hoy';
  if (diffDays === 1) return 'Ayer';
  if (diffDays < 7) return `Hace ${diffDays} días`;
  if (diffDays < 30) return `Hace ${Math.floor(diffDays / 7)} semanas`;
  
  return date.toLocaleDateString('es-ES', { day: 'numeric', month: 'short', year: 'numeric' });
}

// Formatear fecha absoluta
function formatAbsoluteDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString('es-ES', { 
    day: 'numeric', 
    month: 'long', 
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
}

// Descargar JSON
function downloadJSON(data, filename) {
  const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
}

// Copiar al portapapeles
async function copyToClipboard(text) {
  try {
    await navigator.clipboard.writeText(text);
    showToast('success', 'Copiado al portapapeles');
    return true;
  } catch (err) {
    showToast('error', 'Error al copiar');
    return false;
  }
}

// Obtener parámetro de URL
function getUrlParameter(name) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(name);
}

// Guardar en localStorage
function saveToLocalStorage(key, value) {
  try {
    localStorage.setItem(key, JSON.stringify(value));
    return true;
  } catch (err) {
    console.error('Error saving to localStorage:', err);
    return false;
  }
}

// Leer de localStorage
function loadFromLocalStorage(key, defaultValue = null) {
  try {
    const item = localStorage.getItem(key);
    return item ? JSON.parse(item) : defaultValue;
  } catch (err) {
    console.error('Error reading from localStorage:', err);
    return defaultValue;
  }
}

// Calcular puntuación promedio
function calculateAverageScore(habitats) {
  if (!habitats || habitats.length === 0) return 0;
  const sum = habitats.reduce((acc, h) => acc + (h.score || 0), 0);
  return sum / habitats.length;
}

// Filtrar por texto
function filterByText(items, searchText, fields) {
  if (!searchText) return items;
  
  const search = searchText.toLowerCase();
  return items.filter(item => {
    return fields.some(field => {
      const value = field.split('.').reduce((obj, key) => obj?.[key], item);
      return value?.toString().toLowerCase().includes(search);
    });
  });
}

// Ordenar array
function sortBy(items, field, direction = 'asc') {
  const sorted = [...items].sort((a, b) => {
    const aVal = field.split('.').reduce((obj, key) => obj?.[key], a);
    const bVal = field.split('.').reduce((obj, key) => obj?.[key], b);
    
    if (typeof aVal === 'string') {
      return direction === 'asc' 
        ? aVal.localeCompare(bVal) 
        : bVal.localeCompare(aVal);
    }
    
    return direction === 'asc' ? aVal - bVal : bVal - aVal;
  });
  
  return sorted;
}

// Generar ID único
function generateId(prefix = 'HAB') {
  const timestamp = Date.now();
  const random = Math.floor(Math.random() * 1000);
  return `${prefix}-${timestamp}-${random}`;
}

// Validar formulario
function validateForm(formId) {
  const form = document.getElementById(formId);
  if (!form) return false;
  
  const inputs = form.querySelectorAll('[required]');
  let isValid = true;
  
  inputs.forEach(input => {
    if (!input.value.trim()) {
      input.classList.add('is-invalid');
      isValid = false;
    } else {
      input.classList.remove('is-invalid');
    }
  });
  
  return isValid;
}

// Debounce para búsquedas
function debounce(func, wait = 300) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Confirmar acción
function confirmAction(message, onConfirm) {
  if (confirm(message)) {
    onConfirm();
  }
}

// Escapar HTML
function escapeHtml(text) {
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

// Truncar texto
function truncateText(text, maxLength) {
  if (!text || text.length <= maxLength) return text;
  return text.substring(0, maxLength) + '...';
}

// Inicializar tooltips de Bootstrap (si están disponibles)
function initTooltips() {
  if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
    const tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
  }
}

// Ejecutar al cargar el DOM
document.addEventListener('DOMContentLoaded', function() {
  initTooltips();
  
  // Agregar clase activa a enlaces de navegación según URL actual
  const currentPath = window.location.pathname;
  document.querySelectorAll('a[href]').forEach(link => {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });
});

// Exportar funciones para uso global
window.SpaceCrafterUtils = {
  showToast,
  formatRelativeDate,
  formatAbsoluteDate,
  downloadJSON,
  copyToClipboard,
  getUrlParameter,
  saveToLocalStorage,
  loadFromLocalStorage,
  calculateAverageScore,
  filterByText,
  sortBy,
  generateId,
  validateForm,
  debounce,
  confirmAction,
  escapeHtml,
  truncateText,
  initTooltips
};
