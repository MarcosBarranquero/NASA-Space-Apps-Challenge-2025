<?php
$page_title = "Community Ranking";
$page_description = "Explore and rank the best space habitat designs created by our global community of engineers and designers";

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
  .community-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    background: radial-gradient(circle at 20% 50%, rgba(255, 209, 102, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(74, 144, 226, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(236, 72, 153, 0.08) 0%, transparent 50%);
    animation: gradientShift 25s ease infinite;
    pointer-events: none;
  }

  @keyframes gradientShift {
    0%, 100% { opacity: 1; }
    25% { opacity: 0.7; }
    50% { opacity: 0.9; }
    75% { opacity: 0.8; }
  }

  .community-grid {
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image: 
      linear-gradient(rgba(255, 209, 102, 0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255, 209, 102, 0.03) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
  }

  .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
    animation: float 12s ease-in-out infinite;
    z-index: 1;
    pointer-events: none;
  }

  .orb-1 {
    width: 450px;
    height: 450px;
    background: linear-gradient(135deg, var(--yellow), var(--orange));
    top: 15%;
    left: 5%;
    opacity: 0.15;
  }

  .orb-2 {
    width: 350px;
    height: 350px;
    background: linear-gradient(135deg, var(--purple), var(--pink));
    bottom: 25%;
    right: 15%;
    opacity: 0.12;
    animation-delay: -6s;
  }

  .orb-3 {
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, var(--blue), var(--cyan));
    top: 50%;
    right: 5%;
    opacity: 0.1;
    animation-delay: -3s;
  }

  @keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
    25% { transform: translate(40px, -20px) scale(1.1) rotate(90deg); }
    50% { transform: translate(-30px, 30px) scale(0.9) rotate(180deg); }
    75% { transform: translate(20px, -40px) scale(1.05) rotate(270deg); }
  }

  .content {
    position: relative;
    z-index: 10;
    color: #fff;
  }

  /* Page Header */
  .page-header-title {
    font-size: 2.5rem;
    font-weight: 900;
    background: linear-gradient(135deg, var(--yellow), var(--orange), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 30px rgba(255, 209, 102, 0.3);
    margin-bottom: 0.5rem;
    animation: titleGlow 3s ease-in-out infinite alternate;
  }

  @keyframes titleGlow {
    0% { filter: brightness(1); }
    100% { filter: brightness(1.2); }
  }

  .page-header-subtitle {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.1rem;
    font-weight: 500;
  }

  /* Block styles */
  .block {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(40px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 28px;
    margin-bottom: 2rem;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4), 
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .block::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--yellow), var(--orange), var(--pink), var(--purple), var(--blue));
    background-size: 300% 100%;
    animation: gradientMove 8s ease infinite;
  }

  @keyframes gradientMove {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
  }

  .block:hover {
    transform: translateY(-10px);
    box-shadow: 0 35px 100px rgba(255, 209, 102, 0.2),
                0 15px 40px rgba(139, 92, 246, 0.1);
  }

  .block-header {
    padding: 2rem 2.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    background: linear-gradient(135deg, 
                rgba(255, 209, 102, 0.08), 
                rgba(255, 107, 107, 0.05),
                rgba(139, 92, 246, 0.06));
    position: relative;
  }

  .block-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255, 209, 102, 0.5), transparent);
  }

  .block-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: #fff;
    margin: 0;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  }

  .block-content {
    padding: 2rem;
  }

  /* Ranking Cards */
  .ranking-item {
    background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.06), 
                rgba(255, 255, 255, 0.02));
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 24px;
    padding: 2rem;
    margin-bottom: 1.5rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }

  .ranking-item::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, 
                transparent, 
                rgba(255, 209, 102, 0.08),
                rgba(139, 92, 246, 0.05));
    opacity: 0;
    transition: all 0.4s ease;
  }

  .ranking-item:hover::before {
    opacity: 1;
  }

  .ranking-item:hover {
    transform: translateY(-8px) scale(1.02);
    border-color: rgba(255, 209, 102, 0.3);
    box-shadow: 0 25px 60px rgba(255, 209, 102, 0.15),
                0 10px 30px rgba(139, 92, 246, 0.1);
  }

  .rank-position {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    font-weight: 900;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
  }

  .rank-position::before {
    content: '';
    position: absolute;
    inset: 0;
    background: inherit;
    filter: blur(10px);
    opacity: 0.3;
  }

  .rank-position.gold {
    background: linear-gradient(135deg, #FFD700, #FFA500, #FF8C00);
    color: var(--navy);
    box-shadow: 0 12px 35px rgba(255, 215, 0, 0.5),
                inset 0 2px 10px rgba(255, 255, 255, 0.3);
  }

  .rank-position.silver {
    background: linear-gradient(135deg, #E6E6FA, #C0C0C0, #A9A9A9);
    color: var(--navy);
    box-shadow: 0 12px 35px rgba(192, 192, 192, 0.5),
                inset 0 2px 10px rgba(255, 255, 255, 0.3);
  }

  .rank-position.bronze {
    background: linear-gradient(135deg, #CD853F, #CD7F32, #B87333);
    color: #fff;
    box-shadow: 0 12px 35px rgba(205, 127, 50, 0.5),
                inset 0 2px 10px rgba(255, 255, 255, 0.2);
  }

  .rank-position.regular {
    background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.15), 
                rgba(139, 92, 246, 0.2));
    color: rgba(255, 255, 255, 0.8);
    box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
  }

  .habitat-avatar {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    border: 3px solid transparent;
    background: linear-gradient(var(--navy), var(--navy)) padding-box,
                linear-gradient(135deg, var(--yellow), var(--pink)) border-box;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
    text-transform: uppercase;
    box-shadow: 0 8px 25px rgba(255, 209, 102, 0.3);
    position: relative;
    overflow: hidden;
  }

  .habitat-avatar::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, 
                rgba(255, 209, 102, 0.1), 
                rgba(236, 72, 153, 0.1));
    opacity: 0;
    transition: opacity 0.3s;
  }

  .habitat-avatar:hover::before {
    opacity: 1;
  }

  .habitat-info h5 {
    font-size: 1.4rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
  }

  .habitat-author {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1rem;
    font-weight: 500;
  }

  .score-display {
    text-align: center;
    padding: 0.5rem;
  }

  .score-value {
    font-size: 2.2rem;
    font-weight: 900;
    background: linear-gradient(135deg, var(--yellow), var(--orange), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    display: block;
    text-shadow: 0 0 20px rgba(255, 209, 102, 0.3);
    animation: scoreGlow 2s ease-in-out infinite alternate;
  }

  @keyframes scoreGlow {
    0% { filter: brightness(1); }
    100% { filter: brightness(1.3); }
  }

  .score-meta {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 0.25rem;
  }

  /* Action Buttons */
  .action-buttons .btn {
    background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.08), 
                rgba(255, 255, 255, 0.04));
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 16px;
    color: rgba(255, 255, 255, 0.9);
    padding: 0.75rem 1rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    margin: 0 0.25rem;
  }

  .action-buttons .btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    opacity: 0;
    transition: opacity 0.3s;
  }

  .action-buttons .btn:hover::before {
    opacity: 0.2;
  }

  .action-buttons .btn:hover {
    background: linear-gradient(135deg, 
                rgba(255, 209, 102, 0.15), 
                rgba(139, 92, 246, 0.1));
    border-color: var(--yellow);
    color: #fff;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(255, 209, 102, 0.3);
  }

  .action-buttons .btn i {
    position: relative;
    z-index: 1;
  }

  /* Form Controls */
  .form-select {
    background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.08), 
                rgba(255, 255, 255, 0.04));
    border: 2px solid rgba(255, 255, 255, 0.15);
    border-radius: 16px;
    color: #fff;
    padding: 0.75rem 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .form-select:focus {
    background: linear-gradient(135deg, 
                rgba(255, 209, 102, 0.1), 
                rgba(139, 92, 246, 0.05));
    border-color: var(--yellow);
    box-shadow: 0 0 0 4px rgba(255, 209, 102, 0.2);
    color: #fff;
  }

  .form-select option {
    background: var(--navy);
    color: #fff;
  }

  .block-options {
    display: flex;
    align-items: center;
  }

  /* Modal Styles */
  .modal-content {
    background: rgba(10, 11, 30, 0.95);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    color: #fff;
  }

  .modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.05), rgba(139, 92, 246, 0.05));
  }

  .modal-title {
    font-size: 1.5rem;
    font-weight: 700;
  }

  .btn-close {
    filter: invert(1);
  }

  .form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: #fff;
  }

  .form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--blue);
    box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.2);
    color: #fff;
  }

  .form-label {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 600;
  }

  /* Detail Modal */
  .detail-avatar {
    width: 96px;
    height: 96px;
    border-radius: 50%;
    border: 4px solid transparent;
    background: linear-gradient(var(--navy), var(--navy)) padding-box,
                linear-gradient(135deg, var(--yellow), var(--pink)) border-box;
    box-shadow: 0 15px 40px rgba(255, 209, 102, 0.4);
  }

  .comment-box {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 1rem;
  }

  /* Toast */
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
<div class="community-bg"></div>
<div class="community-grid"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<!-- Main Container -->
<main id="main-container">
  <!-- Hero -->
  <div class="content">
    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
      <div class="flex-grow-1 mb-1 mb-md-0">
        <h1 class="page-header-title mb-2">
          🌌 Community Hub
        </h1>
        <h2 class="page-header-subtitle mb-0">
          Discover amazing habitat designs from space architects worldwide
        </h2>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Ranking -->
    <div class="block">
      <div class="block-header">
        <h3 class="block-title">
          <i class="fa fa-trophy me-2"></i>
          Top Community Habitats
        </h3>
        <div class="block-options">
          <select class="form-select form-select-sm" id="rankingFilter">
            <option>This week</option>
            <option>This month</option>
            <option>All time</option>
          </select>
        </div>
      </div>
      <div class="block-content" id="communityRanking">
        <!-- Filled by JS -->
      </div>
    </div>
    <!-- END Ranking -->
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Modal Detail -->
<div class="modal fade" id="habitatDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="habitatDetailTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="habitatDetailBody"></div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="/modules/dashboard/_data/seed-users.js"></script>
<script src="/modules/dashboard/_data/seed-habitats.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    renderCommunityRanking();
  });

  function renderCommunityRanking() {
    const container = document.getElementById('communityRanking');
    if (!window.SEED_USERS || !window.SEED_USERS.community) return;
    
    container.innerHTML = window.SEED_USERS.community.map((user, index) => {
      let rankClass = 'regular';
      if (index === 0) rankClass = 'gold';
      else if (index === 1) rankClass = 'silver';
      else if (index === 2) rankClass = 'bronze';
      
      // Generate initials from username
      const initials = user.username.split(' ').map(word => word[0]).join('').toUpperCase().slice(0, 2);
      
      return `
        <div class="ranking-item">
          <div class="row align-items-center">
            <div class="col-auto">
              <div class="rank-position ${rankClass}">
                ${index === 0 ? '🏆' : index === 1 ? '🥈' : index === 2 ? '🥉' : '#' + (index + 1)}
              </div>
            </div>
            <div class="col-auto">
              <div class="habitat-avatar">
                ${initials}
              </div>
            </div>
            <div class="col">
              <div class="habitat-info">
                <h5>${user.habitatName}</h5>
                <p class="habitat-author mb-0">by ${user.username}</p>
              </div>
            </div>
            <div class="col-auto">
              <div class="score-display">
                <span class="score-value">
                  <i class="fa fa-star"></i> ${user.score.toFixed(1)}
                </span>
                <div class="score-meta">${user.votes} votes</div>
              </div>
            </div>
            <div class="col-auto">
              <div class="action-buttons btn-group">
                <button class="btn" onclick="voteHabitat('${user.habitatId}', 1)" title="Vote">
                  <i class="fa fa-thumbs-up"></i>
                </button>
                <button class="btn" onclick="showHabitatDetail('${user.habitatId}')" title="View">
                  <i class="fa fa-eye"></i>
                </button>
                <button class="btn" onclick="viewComments('${user.habitatId}')" title="Comments">
                  <i class="fa fa-comment"></i> ${user.comments}
                </button>
              </div>
            </div>
          </div>
        </div>
      `;
    }).join('');
  }

  function voteHabitat(habitatId, vote) {
    const user = window.SEED_USERS.community.find(u => u.habitatId === habitatId);
    if (user) {
      user.votes += vote;
      user.score = Math.min(5.0, user.score + (vote * 0.1)); // Slight score increase
      renderCommunityRanking();
      showToast('✨ Vote registered! Thanks for participating!');
    }
  }

  function showHabitatDetail(habitatId) {
    const user = window.SEED_USERS.community.find(u => u.habitatId === habitatId);
    if (!user) return;
    
    // Generate initials from username
    const initials = user.username.split(' ').map(word => word[0]).join('').toUpperCase().slice(0, 2);
    
    document.getElementById('habitatDetailTitle').innerHTML = `
      <i class="fa fa-building me-2"></i>${user.habitatName}
    `;
    
    document.getElementById('habitatDetailBody').innerHTML = `
      <div class="row">
        <div class="col-md-4 text-center">
          <div class="detail-avatar mb-3" style="width: 96px; height: 96px; border-radius: 24px; border: 4px solid transparent; background: linear-gradient(var(--navy), var(--navy)) padding-box, linear-gradient(135deg, var(--yellow), var(--pink)) border-box; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 900; color: #fff; margin: 0 auto;">
            ${initials}
          </div>
          <h6 class="fw-bold">${user.username}</h6>
        </div>
        <div class="col-md-8">
          <div class="mb-3">
            <div class="score-value mb-2">
              <i class="fa fa-star"></i> ${user.score.toFixed(1)}
            </div>
            <div class="score-meta">${user.votes} votes • ${user.comments} comments</div>
          </div>
          
          <h6 class="fw-bold mb-2">Description</h6>
          <p style="color: rgba(255,255,255,0.7)">🚀 Optimized design for long-duration missions. Includes redundant systems and efficient zoning for maximum crew comfort and safety.</p>
          
          <h6 class="fw-bold mt-3 mb-2">Recent Comments</h6>
          <div class="comment-box">
            <p class="mb-2" style="color: rgba(255,255,255,0.8)"><strong>🌙 LunarEngineer:</strong> Excellent use of vertical space! The modular approach is brilliant.</p>
            <p class="mb-0" style="color: rgba(255,255,255,0.8)"><strong>🛰️ OrbitDesigner:</strong> I love the thermal zoning concept - very innovative!</p>
          </div>
        </div>
      </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('habitatDetailModal'));
    modal.show();
  }

  function viewComments(habitatId) {
    showHabitatDetail(habitatId);
  }

  function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.innerHTML = `<i class="fa fa-check-circle me-2"></i>${message}`;
    document.body.appendChild(toast);
    
    // Add entrance animation
    setTimeout(() => toast.style.transform = 'translateX(0)', 100);
    
    // Remove after 4 seconds with fade out
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100px)';
      setTimeout(() => toast.remove(), 300);
    }, 4000);
  }
</script>

<?php
include __DIR__.'/../../includes/footer.php';
?>