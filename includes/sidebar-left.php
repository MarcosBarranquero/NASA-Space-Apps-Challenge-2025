<!-- Sidebar Left -->
<?php
// Detectar la página actual
$current_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$current_page = trim($current_path, '/');
if (empty($current_page)) $current_page = 'dashboard';

// Función helper para marcar activo
function is_active($page) {
  global $current_page;
  return ($current_page === $page) ? 'active' : '';
}
?>

<style>
  :root {
    --yellow: #FFD166;
    --blue: #4A90E2;
    --purple: #8B5CF6;
    --pink: #EC4899;
    --green: #5AD398;
    --orange: #FF6B6B;
    --cyan: #4FC3F7;
    --navy: #0A0B1E;
  }

  /* Sidebar Container - FIJO A LA IZQUIERDA */
  #sidebar {
    position: fixed !important;
    top: 0;
    left: 0;
    bottom: 0;
    width: 250px;
    background: rgba(10, 11, 30, 0.95) !important;
    backdrop-filter: blur(30px) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
    z-index: 1000;
    overflow-y: auto;
    overflow-x: hidden;
    transition: all 0.3s ease-in-out;
  }

  /* Gradient line on right edge */
  #sidebar::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 1px;
    height: 100%;
    background: linear-gradient(180deg, transparent, rgba(74, 144, 226, 0.4) 30%, rgba(139, 92, 246, 0.4) 70%, transparent);
    pointer-events: none;
  }

  /* Header del Sidebar */
  #sidebar .content-header {
    background: rgba(255, 255, 255, 0.02) !important;
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
    padding: 1.25rem 1rem !important;
    position: sticky;
    top: 0;
    z-index: 10;
  }

  #sidebar .content-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 10%;
    right: 10%;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(74, 144, 226, 0.5), transparent);
  }

  /* Logo - SPACECRAFTER */
  #sidebar .content-header a.fw-semibold {
    background: linear-gradient(135deg, var(--yellow), var(--orange)) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    background-clip: text !important;
    font-weight: 800 !important;
    font-size: 1.3rem !important;
    letter-spacing: 0.5px !important;
    transition: all 0.3s;
    text-decoration: none !important;
  }

  #sidebar .content-header a.fw-semibold:hover {
    opacity: 0.8;
    transform: translateX(2px);
  }

  #sidebar .content-header .smini-visible i {
    background: linear-gradient(135deg, var(--yellow), var(--orange));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.5rem;
  }

  /* Botones del header */
  #sidebar .btn-alt-secondary {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: rgba(255, 255, 255, 0.7) !important;
    border-radius: 10px !important;
    width: 32px;
    height: 32px;
    padding: 0 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s !important;
  }

  #sidebar .btn-alt-secondary:hover {
    background: rgba(255, 255, 255, 0.1) !important;
    border-color: var(--blue) !important;
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
  }

  /* Dropdown menus */
  #sidebar .dropdown-menu {
    background: rgba(10, 11, 30, 0.98) !important;
    backdrop-filter: blur(30px) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 16px !important;
    padding: 0.5rem !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5) !important;
    min-width: 180px !important;
  }

  #sidebar .dropdown-item {
    color: rgba(255, 255, 255, 0.8) !important;
    border-radius: 10px !important;
    padding: 0.5rem 0.75rem !important;
    transition: all 0.3s !important;
    margin-bottom: 2px;
  }

  #sidebar .dropdown-item:hover {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.15), rgba(139, 92, 246, 0.15)) !important;
    color: #fff !important;
    transform: translateX(4px);
  }

  #sidebar .dropdown-divider {
    border-color: rgba(255, 255, 255, 0.1) !important;
    margin: 0.5rem 0 !important;
  }

  /* Color circles */
  .text-default { color: #5c80d1 !important; }
  .text-amethyst { color: #8b5cf6 !important; }
  .text-city { color: #4fc3f7 !important; }
  .text-flat { color: #5ad398 !important; }
  .text-modern { color: #4a90e2 !important; }
  .text-smooth { color: #ec4899 !important; }

  /* Navigation Area */
  #sidebar .js-sidebar-scroll {
    height: calc(100vh - 80px);
    overflow-y: auto;
    overflow-x: hidden;
  }

  #sidebar .content-side {
    padding: 1rem 0.5rem !important;
  }

  /* Headings de secciones */
  #sidebar .nav-main-heading {
    color: rgba(255, 255, 255, 0.4) !important;
    font-size: 0.7rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 1.5px !important;
    padding: 1.5rem 1rem 0.5rem 1rem !important;
    margin-top: 0.5rem !important;
    position: relative;
  }

  #sidebar .nav-main-heading::before {
    content: '';
    position: absolute;
    left: 1rem;
    bottom: 0;
    width: 24px;
    height: 2px;
    background: linear-gradient(90deg, var(--blue), transparent);
    opacity: 0.6;
  }

  /* Nav Items */
  #sidebar .nav-main-item {
    margin-bottom: 0.25rem;
  }

  #sidebar .nav-main-link {
    color: rgba(255, 255, 255, 0.7) !important;
    border-radius: 12px !important;
    padding: 0.75rem 1rem !important;
    margin: 0 0.5rem !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    position: relative;
    overflow: hidden;
    background: transparent !important;
    border: 1px solid transparent !important;
    display: flex;
    align-items: center;
  }

  /* Gradient hover effect */
  #sidebar .nav-main-link::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.08), rgba(139, 92, 246, 0.08));
    opacity: 0;
    transition: opacity 0.3s;
  }

  #sidebar .nav-main-link:hover {
    color: #fff !important;
    background: rgba(255, 255, 255, 0.03) !important;
    border-color: rgba(255, 255, 255, 0.1) !important;
    transform: translateX(4px);
  }

  #sidebar .nav-main-link:hover::before {
    opacity: 1;
  }

  /* Active state - MEJORADO */
  #sidebar .nav-main-link.active {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.15), rgba(139, 92, 246, 0.15)) !important;
    border: 1px solid rgba(74, 144, 226, 0.3) !important;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.2);
  }

  #sidebar .nav-main-link.active::after {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 60%;
    background: linear-gradient(180deg, var(--blue), var(--purple));
    border-radius: 0 3px 3px 0;
  }

  /* Icons */
  #sidebar .nav-main-link-icon {
    font-size: 1.2rem !important;
    margin-right: 0.75rem !important;
    opacity: 0.8;
    transition: all 0.3s;
    position: relative;
    z-index: 1;
  }

  #sidebar .nav-main-link:hover .nav-main-link-icon {
    opacity: 1;
    transform: scale(1.1);
  }

  #sidebar .nav-main-link.active .nav-main-link-icon {
    opacity: 1;
    background: linear-gradient(135deg, var(--blue), var(--cyan));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* Link text */
  #sidebar .nav-main-link-name {
    font-weight: 600 !important;
    font-size: 0.9rem;
    position: relative;
    z-index: 1;
  }

  /* Custom Scrollbar */
  #sidebar .js-sidebar-scroll::-webkit-scrollbar {
    width: 6px;
  }

  #sidebar .js-sidebar-scroll::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
  }

  #sidebar .js-sidebar-scroll::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, rgba(74, 144, 226, 0.3), rgba(139, 92, 246, 0.3));
    border-radius: 10px;
  }

  #sidebar .js-sidebar-scroll::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, rgba(74, 144, 226, 0.5), rgba(139, 92, 246, 0.5));
  }

  /* Mini sidebar mode */
  @media (min-width: 992px) {
    .sidebar-mini #sidebar {
      width: 70px !important;
    }
    
    .sidebar-mini #sidebar .nav-main-link {
      justify-content: center;
      padding: 0.75rem 0 !important;
    }
    
    .sidebar-mini #sidebar .nav-main-link-icon {
      margin-right: 0 !important;
    }
  }

  /* Mobile - ocultar sidebar */
  @media (max-width: 991px) {
    #sidebar {
      transform: translateX(-100%);
    }
    
    #sidebar.show {
      transform: translateX(0);
    }
  }
</style>

<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="content-header">
    <!-- Logo -->
    <a class="fw-semibold text-dual" href="/dashboard">
      <span class="smini-visible">
        <i class="fa fa-rocket"></i>
      </span>
      <span class="smini-hide fs-5 tracking-wider">
        SpaceCrafter
      </span>
    </a>
    <!-- END Logo -->

    <!-- Extra -->
    <div class="d-flex align-items-center gap-1">
      <!-- Close Sidebar (Mobile) -->
      <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
        <i class="fa fa-fw fa-times"></i>
      </a>
    </div>
    <!-- END Extra -->
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">
        <!-- Dashboard -->
        <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('dashboard'); ?>" href="/dashboard">
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">Dashboard</span>
          </a>
        </li>

        <!-- Habitat Creator -->
        <li class="nav-main-heading">Habitat Creator</li>
        <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('creator'); ?>" href="/creator">
            <i class="nav-main-link-icon si si-energy"></i>
            <span class="nav-main-link-name">Create Habitat</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('my_habitats'); ?>" href="/my_habitats">
            <i class="nav-main-link-icon si si-grid"></i>
            <span class="nav-main-link-name">My Habitats</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('module_library'); ?>" href="/module_library">
            <i class="nav-main-link-icon si si-puzzle"></i>
            <span class="nav-main-link-name">Module Library</span>
          </a>
        </li>

        <!-- Insights & Learning -->
        <li class="nav-main-heading">Insights & Learning</li>
<!--         <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('analytics'); ?>" href="/analytics">
            <i class="nav-main-link-icon si si-graph"></i>
            <span class="nav-main-link-name">Analytics</span>
          </a>
        </li> -->
        <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('learn'); ?>" href="/learn">
            <i class="nav-main-link-icon si si-graduation"></i>
            <span class="nav-main-link-name">Learn</span>
          </a>
        </li>

        <!-- Community -->
        <li class="nav-main-heading">Community</li>
        <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('community'); ?>" href="/community">
            <i class="nav-main-link-icon si si-users"></i>
            <span class="nav-main-link-name">Community</span>
          </a>
        </li>

        <!-- User -->
        <li class="nav-main-heading">User</li>
        <li class="nav-main-item">
          <a class="nav-main-link <?php echo is_active('profile'); ?>" href="/profile">
            <i class="nav-main-link-icon si si-user"></i>
            <span class="nav-main-link-name">Profile</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->