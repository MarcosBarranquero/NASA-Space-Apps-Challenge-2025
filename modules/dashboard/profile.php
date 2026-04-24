<?php
$page_title = "User Profile";
$page_description = "Manage your profile, view your habitat designs, and track your contributions to the SpaceCrafter community";

include __DIR__.'/../../includes/header.php';
include __DIR__.'/../../includes/sidebar-right.php';
include __DIR__.'/../../includes/sidebar-left.php';
include __DIR__.'/../../includes/topbar.php';
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

  #main-container {
    background: var(--navy);
    min-height: 100vh;
    position: relative;
  }

  /* Animated background */
  .profile-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    background: radial-gradient(circle at 20% 50%, rgba(74, 144, 226, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 209, 102, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    animation: gradientShift 20s ease infinite;
    pointer-events: none;
  }

  @keyframes gradientShift {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
  }

  .profile-grid {
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image: 
      linear-gradient(rgba(74, 144, 226, 0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(74, 144, 226, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
    pointer-events: none;
  }

  /* Orbs flotantes */
  .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    animation: float 8s ease-in-out infinite;
    z-index: 1;
    pointer-events: none;
  }

  .orb-1 {
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    top: 10%;
    left: 10%;
    opacity: 0.2;
  }

  .orb-2 {
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, var(--pink), var(--orange));
    bottom: 20%;
    right: 10%;
    opacity: 0.15;
    animation-delay: -4s;
  }

  .orb-3 {
    width: 350px;
    height: 350px;
    background: linear-gradient(135deg, var(--cyan), var(--green));
    top: 50%;
    left: 50%;
    opacity: 0.12;
    animation-delay: -2s;
  }

  @keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -30px) scale(1.05); }
    66% { transform: translate(-20px, 20px) scale(0.95); }
  }

  .content {
    position: relative;
    z-index: 10;
    color: #fff;
  }

  /* Block with enhanced visuals */
  .block {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    margin-bottom: 1.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .block::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(74, 144, 226, 0.5), transparent);
    opacity: 0;
    transition: opacity 0.4s;
  }

  .block:hover::before {
    opacity: 1;
  }

  .block:hover {
    transform: translateY(-4px);
    border-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 25px 70px rgba(74, 144, 226, 0.2);
  }

  .block-content {
    padding: 2rem;
  }

  .block-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.05), rgba(139, 92, 246, 0.05));
  }

  .block-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #fff;
    margin: 0;
  }

  /* Profile Card */
  .profile-avatar-container {
    position: relative;
    margin-bottom: 1rem;
  }

  .img-avatar {
    width: 96px;
    height: 96px;
    border-radius: 50%;
    border: 4px solid transparent;
    background: linear-gradient(var(--navy), var(--navy)) padding-box,
                linear-gradient(135deg, var(--yellow), var(--pink)) border-box;
    box-shadow: 0 15px 40px rgba(255, 209, 102, 0.4);
    animation: avatarGlow 3s ease-in-out infinite;
  }

  @keyframes avatarGlow {
    0%, 100% {
      box-shadow: 0 15px 40px rgba(255, 209, 102, 0.4);
    }
    50% {
      box-shadow: 0 20px 50px rgba(236, 72, 153, 0.5);
    }
  }

  .profile-username {
    font-size: 1.75rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 0.5rem;
  }

  .profile-level {
    color: rgba(255, 255, 255, 0.65);
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
  }

  .profile-email-text {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.9rem;
    margin-bottom: 1rem;
  }

  .profile-bio {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
  }

  /* Stats with gradient backgrounds */
  .stats-row {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.08), rgba(139, 92, 246, 0.08));
    border-radius: 16px;
    padding: 1.5rem;
  }

  .stat-item {
    text-align: center;
    position: relative;
  }

  .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    margin-bottom: 0.25rem;
    position: relative;
    display: inline-block;
  }

  .stat-item:nth-child(1) .stat-value {
    background: linear-gradient(135deg, var(--blue), var(--cyan));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-item:nth-child(2) .stat-value {
    background: linear-gradient(135deg, var(--yellow), var(--orange));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-item:nth-child(3) .stat-value {
    background: linear-gradient(135deg, var(--purple), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Badge items with colorful variants */
  .badge-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
  }

  .badge-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 1.25rem 0.75rem;
    text-align: center;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
  }

  .badge-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.05));
    opacity: 0;
    transition: opacity 0.3s;
  }

  .badge-card:hover::before {
    opacity: 1;
  }

  .badge-card:hover {
    transform: translateY(-5px) scale(1.02);
    border-color: rgba(255, 255, 255, 0.2);
  }

  .badge-card.unlocked {
    border-color: rgba(255, 209, 102, 0.3);
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.08), rgba(255, 107, 107, 0.08));
  }

  .badge-card.locked {
    opacity: 0.4;
    filter: grayscale(0.8);
  }

  .badge-icon {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    display: block;
    filter: drop-shadow(0 4px 12px rgba(255, 209, 102, 0.3));
  }

  .badge-name {
    font-size: 0.75rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
  }

  .badge-status {
    font-size: 0.7rem;
    margin-top: 0.25rem;
  }

  /* Form elements with enhanced styling */
  .form-label {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
  }

  .form-select,
  .form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: #fff;
    padding: 0.75rem 1rem;
    transition: all 0.3s;
  }

  .form-select:focus,
  .form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--blue);
    box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.2);
    color: #fff;
    outline: none;
  }

  .form-select option {
    background: var(--navy);
    color: #fff;
  }

  .form-check-input {
    background-color: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    width: 3rem;
    height: 1.5rem;
  }

  .form-check-input:checked {
    background-color: var(--blue);
    border-color: var(--blue);
  }

  .form-check-label {
    color: rgba(255, 255, 255, 0.8);
    margin-left: 0.5rem;
  }

  /* Enhanced buttons */
  .btn-primary {
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border: none;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    color: #fff;
    transition: all 0.3s;
    box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4);
    position: relative;
    overflow: hidden;
  }

  .btn-primary::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2));
    transform: translateX(-100%);
    transition: transform 0.5s;
  }

  .btn-primary:hover::before {
    transform: translateX(100%);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 35px rgba(74, 144, 226, 0.6);
  }

  /* Activity items with colorful icons */
  .activity-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .activity-item {
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s;
  }

  .activity-item:last-child {
    border-bottom: none;
  }

  .activity-item:hover {
    transform: translateX(8px);
  }

  .activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.25rem;
  }

  .activity-icon.edit {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.2), rgba(79, 195, 247, 0.2));
    color: var(--cyan);
  }

  .activity-icon.trophy {
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.2), rgba(255, 107, 107, 0.2));
    color: var(--yellow);
  }

  .activity-icon.plus {
    background: linear-gradient(135deg, rgba(90, 211, 152, 0.2), rgba(79, 195, 247, 0.2));
    color: var(--green);
  }

  .activity-icon.share {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(236, 72, 153, 0.2));
    color: var(--purple);
  }

  .activity-content {
    flex: 1;
  }

  .activity-title {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    font-size: 0.95rem;
  }

  .activity-time {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.8rem;
  }

  /* Page header */
  .page-header-title {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--yellow), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .page-header-subtitle {
    color: rgba(255, 255, 255, 0.6);
    font-size: 1rem;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .badge-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  /* Toast notification */
  .toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    background: linear-gradient(135deg, rgba(90, 211, 152, 0.95), rgba(79, 195, 247, 0.95));
    backdrop-filter: blur(20px);
    border: 1px solid rgba(90, 211, 152, 0.3);
    border-radius: 16px;
    padding: 1rem 1.5rem;
    color: #fff;
    font-weight: 600;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
    animation: slideIn 0.3s ease-out;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(100px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
</style>

<!-- Background Effects -->
<div class="profile-bg"></div>
<div class="profile-grid"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

<!-- Main Container -->
<main id="main-container">
  <!-- Hero -->
  <div class="content">
    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
      <div class="flex-grow-1 mb-1 mb-md-0">
        <h1 class="page-header-title mb-2">
          My Profile
        </h1>
        <h2 class="page-header-subtitle mb-0">
          Manage your account, preferences and achievements
        </h2>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <div class="row">
      <!-- Profile Card -->
      <div class="col-lg-4">
        <div class="block">
          <div class="block-content text-center">
            <div class="profile-avatar-container">
              <img src="/modules/dashboard/assets/img/avatars/default.png" class="img-avatar" alt="Avatar" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23FFD166%22 width=%22100%22 height=%22100%22/%3E%3Ctext fill=%22%230A0B1E%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-size=%2240%22 font-weight=%22800%22%3EJS%3C/text%3E%3C/svg%3E'">
            </div>
            <h4 class="profile-username" id="profileUsername">SpaceArchitect</h4>
            <p class="profile-level">Level 8 • Space Architect</p>
            <p class="profile-email-text" id="profileEmail">architect@spacecrafter.app</p>
            <p class="profile-bio mb-3" id="profileBio">Space habitat designer. Passionate about extraterrestrial architecture.</p>
          </div>
          <div class="block-content">
            <div class="stats-row">
              <div class="row text-center">
                <div class="col-4 stat-item">
                  <div class="stat-value" id="profileHabitats">5</div>
                  <div class="stat-label">Habitats</div>
                </div>
                <div class="col-4 stat-item">
                  <div class="stat-value" id="profileScore">3.96</div>
                  <div class="stat-label">Score</div>
                </div>
                <div class="col-4 stat-item">
                  <div class="stat-value" id="profileBadges">3</div>
                  <div class="stat-label">Badges</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Badges -->
        <div class="block">
          <div class="block-header">
            <h3 class="block-title">Achievements</h3>
          </div>
          <div class="block-content">
            <div class="badge-grid" id="badgesContainer">
              <!-- Filled by JS -->
            </div>
          </div>
        </div>
      </div>
      <!-- END Profile Card -->

      <!-- Preferences & Activity -->
      <div class="col-lg-8">
        <!-- Preferences -->
        <div class="block">
          <div class="block-header">
            <h3 class="block-title">Preferences</h3>
          </div>
          <div class="block-content">
            <form id="preferencesForm">
              <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="form-label">Theme</label>
                  <select class="form-select" id="themeSelect">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                    <option value="auto">Automatic</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Units</label>
                  <select class="form-select" id="unitsSelect">
                    <option value="SI">International System (SI)</option>
                    <option value="imperial">Imperial</option>
                  </select>
                </div>
              </div>
              
              <div class="mb-3">
                <label class="form-label">Language</label>
                <select class="form-select" id="languageSelect">
                  <option value="es">Español</option>
                  <option value="en">English</option>
                  <option value="fr">Français</option>
                </select>
              </div>

              <div class="mb-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="notificationsCheck" checked>
                  <label class="form-check-label" for="notificationsCheck">
                    Receive update notifications
                  </label>
                </div>
              </div>

              <div class="mb-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="communityCheck" checked>
                  <label class="form-check-label" for="communityCheck">
                    Show my designs in the community
                  </label>
                </div>
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-save me-1"></i>Save Preferences
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="block">
          <div class="block-header">
            <h3 class="block-title">Recent Activity</h3>
          </div>
          <div class="block-content">
            <ul class="activity-list">
              <li class="activity-item">
                <div class="activity-icon edit">
                  <i class="fa fa-edit"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">You edited "Lunar Shelter Alpha"</div>
                  <div class="activity-time">1 day ago</div>
                </div>
              </li>
              <li class="activity-item">
                <div class="activity-icon trophy">
                  <i class="fa fa-trophy"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">You unlocked "Lunar Expert"</div>
                  <div class="activity-time">2 days ago</div>
                </div>
              </li>
              <li class="activity-item">
                <div class="activity-icon plus">
                  <i class="fa fa-plus"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">You created "Mars Transit Hub"</div>
                  <div class="activity-time">3 days ago</div>
                </div>
              </li>
              <li class="activity-item">
                <div class="activity-icon share">
                  <i class="fa fa-share"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">You published "Olympus Base"</div>
                  <div class="activity-time">5 days ago</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- END Preferences & Activity -->
    </div>
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Scripts -->
<script src="/modules/dashboard/_data/seed-users.js"></script>

<script>
  const badges = [
    { id: 'first_habitat', name: 'First Habitat', icon: 'fa-rocket', unlocked: true },
    { id: 'lunar_expert', name: 'Lunar Expert', icon: 'fa-moon', unlocked: true },
    { id: 'optimizer', name: 'Optimizer', icon: 'fa-cog', unlocked: true },
    { id: 'mars_pioneer', name: 'Mars Pioneer', icon: 'fa-globe', unlocked: false },
    { id: 'community_star', name: 'Community Star', icon: 'fa-star', unlocked: false },
    { id: 'master_architect', name: 'Master Architect', icon: 'fa-trophy', unlocked: false }
  ];

  document.addEventListener('DOMContentLoaded', function() {
    loadProfile();
    renderBadges();
    
    document.getElementById('preferencesForm').addEventListener('submit', savePreferences);
    loadPreferences();
  });

  function loadProfile() {
    if (!window.SEED_USERS || !window.SEED_USERS.current) return;
    
    const user = window.SEED_USERS.current;
    document.getElementById('profileUsername').textContent = user.username;
    document.getElementById('profileEmail').textContent = user.email;
    document.getElementById('profileBio').textContent = user.bio;
    document.getElementById('profileHabitats').textContent = user.stats.habitatsCreated;
    document.getElementById('profileScore').textContent = user.stats.avgScore.toFixed(2);
    document.getElementById('profileBadges').textContent = user.stats.badges.length;
  }

  function renderBadges() {
    const container = document.getElementById('badgesContainer');
    
    container.innerHTML = badges.map(badge => `
      <div class="badge-card ${badge.unlocked ? 'unlocked' : 'locked'}">
        <i class="fa ${badge.icon} badge-icon"></i>
        <div class="badge-name">${badge.name}</div>
        <div class="badge-status">
          ${badge.unlocked ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-lock text-muted"></i>'}
        </div>
      </div>
    `).join('');
  }

  function savePreferences(e) {
    e.preventDefault();
    
    const prefs = {
      theme: document.getElementById('themeSelect').value,
      units: document.getElementById('unitsSelect').value,
      language: document.getElementById('languageSelect').value,
      notifications: document.getElementById('notificationsCheck').checked,
      community: document.getElementById('communityCheck').checked
    };
    
    localStorage.setItem('spacecrafter_prefs', JSON.stringify(prefs));
    
    showToast('Preferences saved successfully');
  }

  function loadPreferences() {
    const saved = localStorage.getItem('spacecrafter_prefs');
    if (!saved) return;
    
    const prefs = JSON.parse(saved);
    document.getElementById('themeSelect').value = prefs.theme || 'dark';
    document.getElementById('unitsSelect').value = prefs.units || 'SI';
    document.getElementById('languageSelect').value = prefs.language || 'en';
    document.getElementById('notificationsCheck').checked = prefs.notifications !== false;
    document.getElementById('communityCheck').checked = prefs.community !== false;
  }

  function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.innerHTML = `<i class="fa fa-check-circle me-2"></i>${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }
</script>

<?php
include __DIR__.'/../../includes/footer.php';
?>