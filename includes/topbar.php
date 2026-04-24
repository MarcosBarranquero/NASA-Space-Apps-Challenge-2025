    <!-- Top Bar -->
    <header class="topbar">
      <div class="topbar-container">
        <!-- Left section -->
        <div class="topbar-left">
          <div class="page-title-section">
            <h1 class="page-title"><?= $pageTitle ?? 'Dashboard' ?></h1>
            <?php if (isset($pageSubtitle)): ?>
            <p class="page-subtitle"><?= htmlspecialchars($pageSubtitle) ?></p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Right section -->
        <div class="topbar-right">
          <!-- Notifications -->
          <div class="topbar-item">
            <button class="topbar-btn" id="notifications-btn" title="Notifications">
              <span class="topbar-icon">🔔</span>
              <span class="notification-badge">3</span>
            </button>
            
            <!-- Notifications dropdown -->
            <div class="dropdown-menu" id="notifications-dropdown">
              <div class="dropdown-header">
                <h3>Notifications</h3>
              </div>
              <div class="dropdown-content">
                <a href="#" class="notification-item">
                  <div class="notification-icon success">✓</div>
                  <div class="notification-text">
                    <div class="notification-title">Habitat saved successfully</div>
                    <div class="notification-time">5 min ago</div>
                  </div>
                </a>
                <a href="#" class="notification-item">
                  <div class="notification-icon info">ℹ</div>
                  <div class="notification-text">
                    <div class="notification-title">New module available</div>
                    <div class="notification-time">1 hour ago</div>
                  </div>
                </a>
                <a href="#" class="notification-item">
                  <div class="notification-icon warning">⚠</div>
                  <div class="notification-text">
                    <div class="notification-title">Score calculation updated</div>
                    <div class="notification-time">3 hours ago</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer">
                <a href="/notifications">View all notifications</a>
              </div>
            </div>
          </div>

          <!-- User menu -->
          <div class="topbar-item">
            <button class="topbar-btn user-btn" id="user-menu-btn">
              <div class="user-avatar">
                <?php 
                $userName = $_SESSION['name'] ?? 'Guest';
                echo strtoupper(substr($userName, 0, 1));
                ?>
              </div>
              <span class="user-name"><?= htmlspecialchars($userName) ?></span>
              <span class="user-dropdown-icon">▾</span>
            </button>

            <!-- User dropdown -->
            <div class="dropdown-menu" id="user-dropdown">
              <div class="dropdown-header user-info">
                <div class="user-avatar-large">
                  <?php echo strtoupper(substr($userName, 0, 1)); ?>
                </div>
                <div>
                  <div class="user-name-large"><?= htmlspecialchars($userName) ?></div>
                  <div class="user-email"><?= htmlspecialchars($_SESSION['email'] ?? '') ?></div>
                </div>
              </div>
              <div class="dropdown-divider"></div>
              <div class="dropdown-content">
                <a href="/profile" class="dropdown-item">
                  <span class="dropdown-icon">👤</span>
                  <span>My Profile</span>
                </a>
                <a href="/habitat/my-habitats" class="dropdown-item">
                  <span class="dropdown-icon">🏗️</span>
                  <span>My Habitats</span>
                </a>
                <a href="/settings" class="dropdown-item">
                  <span class="dropdown-icon">⚙️</span>
                  <span>Settings</span>
                </a>
              </div>
              <div class="dropdown-divider"></div>
              <div class="dropdown-content">
                <a href="/logout" class="dropdown-item logout">
                  <span class="dropdown-icon">🚪</span>
                  <span>Logout</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END Top Bar -->

    <style>
      .topbar {
        background: rgba(10, 11, 30, 0.8) !important;
        backdrop-filter: blur(20px) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        padding: 1rem 2rem !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 50 !important;
        width: 100% !important;
      }

      .topbar-container {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 2rem !important;
        max-width: 100% !important;
      }

      .topbar-left {
        flex: 1 !important;
      }

      .page-title {
        font-size: 1.5rem !important;
        font-weight: 800 !important;
        margin: 0 !important;
        background: linear-gradient(135deg, #fff, rgba(255, 255, 255, 0.8)) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
      }

      .page-subtitle {
        font-size: 0.875rem !important;
        color: rgba(255, 255, 255, 0.6) !important;
        margin: 0.25rem 0 0 0 !important;
      }

      .topbar-right {
        display: flex !important;
        align-items: center !important;
        gap: 1rem !important;
      }

      .topbar-item {
        position: relative !important;
      }

      .topbar-btn {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 12px !important;
        padding: 0.625rem 1rem !important;
        color: #fff !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        transition: all 0.3s !important;
        position: relative !important;
      }

      .topbar-btn:hover {
        background: rgba(255, 255, 255, 0.1) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
      }

      .topbar-icon {
        font-size: 1.25rem !important;
      }

      .notification-badge {
        position: absolute !important;
        top: -4px !important;
        right: -4px !important;
        background: linear-gradient(135deg, #FF6B6B, #EE5A6F) !important;
        color: #fff !important;
        font-size: 0.7rem !important;
        font-weight: 700 !important;
        padding: 0.125rem 0.375rem !important;
        border-radius: 10px !important;
        min-width: 18px !important;
        text-align: center !important;
      }

      .user-btn {
        padding: 0.5rem 1rem !important;
      }

      .user-avatar {
        width: 32px !important;
        height: 32px !important;
        background: linear-gradient(135deg, var(--blue), var(--purple)) !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
      }

      .user-name {
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        color: #fff !important;
      }

      .user-dropdown-icon {
        font-size: 0.75rem !important;
        opacity: 0.7 !important;
      }

      /* Dropdown menus */
      .dropdown-menu {
        position: absolute;
        top: calc(100% + 0.5rem);
        right: 0;
        background: rgba(15, 16, 32, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        min-width: 280px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s;
        z-index: 100;
      }

      .dropdown-menu.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
      }

      .dropdown-header {
        padding: 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .dropdown-header h3 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
      }

      .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
      }

      .user-avatar-large {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.25rem;
        flex-shrink: 0;
      }

      .user-name-large {
        font-weight: 700;
        font-size: 0.95rem;
      }

      .user-email {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 0.125rem;
      }

      .dropdown-content {
        padding: 0.5rem;
      }

      .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.2s;
      }

      .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
      }

      .dropdown-item.logout {
        color: #ff6b6b;
      }

      .dropdown-item.logout:hover {
        background: rgba(255, 107, 107, 0.15);
      }

      .dropdown-icon {
        font-size: 1.125rem;
        width: 24px;
        text-align: center;
      }

      .dropdown-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 0.5rem 0;
      }

      .dropdown-footer {
        padding: 0.75rem 1.25rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
      }

      .dropdown-footer a {
        color: var(--blue);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
      }

      .dropdown-footer a:hover {
        color: var(--purple);
      }

      .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        border-radius: 10px;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
      }

      .notification-item:hover {
        background: rgba(255, 255, 255, 0.05);
      }

      .notification-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
      }

      .notification-icon.success {
        background: rgba(72, 187, 120, 0.2);
        color: #48bb78;
      }

      .notification-icon.info {
        background: rgba(74, 144, 226, 0.2);
        color: var(--blue);
      }

      .notification-icon.warning {
        background: rgba(255, 209, 102, 0.2);
        color: var(--yellow);
      }

      .notification-text {
        flex: 1;
      }

      .notification-title {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.125rem;
      }

      .notification-time {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.5);
      }

      @media (max-width: 768px) {
        .topbar {
          padding: 1rem;
        }

        .user-name {
          display: none;
        }

        .page-title {
          font-size: 1.25rem;
        }
      }
    </style>

    <script>
      // Dropdown functionality
      document.addEventListener('DOMContentLoaded', function() {
        // Notifications dropdown
        const notificationsBtn = document.getElementById('notifications-btn');
        const notificationsDropdown = document.getElementById('notifications-dropdown');
        
        if (notificationsBtn && notificationsDropdown) {
          notificationsBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationsDropdown.classList.toggle('active');
            // Close user dropdown if open
            const userDropdown = document.getElementById('user-dropdown');
            if (userDropdown) userDropdown.classList.remove('active');
          });
        }

        // User dropdown
        const userMenuBtn = document.getElementById('user-menu-btn');
        const userDropdown = document.getElementById('user-dropdown');
        
        if (userMenuBtn && userDropdown) {
          userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
            // Close notifications dropdown if open
            if (notificationsDropdown) notificationsDropdown.classList.remove('active');
          });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
          if (notificationsDropdown) notificationsDropdown.classList.remove('active');
          if (userDropdown) userDropdown.classList.remove('active');
        });

        // Prevent dropdown from closing when clicking inside
        document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
          dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
          });
        });
      });
    </script>
