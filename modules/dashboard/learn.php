<?php
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
  .learning-bg {
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

  .learning-grid {
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image: 
      linear-gradient(rgba(74, 144, 226, 0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(74, 144, 226, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
    pointer-events: none;
  }

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
    background: linear-gradient(135deg, var(--cyan), var(--blue));
    top: 10%;
    left: 10%;
    opacity: 0.2;
  }

  .orb-2 {
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, var(--purple), var(--pink));
    bottom: 20%;
    right: 10%;
    opacity: 0.15;
    animation-delay: -4s;
  }

  .orb-3 {
    width: 350px;
    height: 350px;
    background: linear-gradient(135deg, var(--yellow), var(--orange));
    top: 50%;
    right: 20%;
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

  /* Page Header */
  .page-header-title {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--cyan), var(--purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .page-header-subtitle {
    color: rgba(255, 255, 255, 0.6);
  }

  /* Article Cards */
  .article-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }

  .article-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.05));
    opacity: 0;
    transition: opacity 0.4s;
  }

  .article-card:hover::before {
    opacity: 1;
  }

  .article-card:hover {
    transform: translateY(-8px);
    border-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 20px 50px rgba(74, 144, 226, 0.3);
  }

  .article-icon {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
  }

  .article-card:nth-child(1) .article-icon {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.2), rgba(79, 195, 247, 0.2));
    color: var(--cyan);
    box-shadow: 0 8px 25px rgba(79, 195, 247, 0.3);
  }

  .article-card:nth-child(2) .article-icon {
    background: linear-gradient(135deg, rgba(90, 211, 152, 0.2), rgba(79, 195, 247, 0.2));
    color: var(--green);
    box-shadow: 0 8px 25px rgba(90, 211, 152, 0.3);
  }

  .article-card:nth-child(3) .article-icon {
    background: linear-gradient(135deg, rgba(79, 195, 247, 0.2), rgba(139, 92, 246, 0.2));
    color: var(--blue);
    box-shadow: 0 8px 25px rgba(74, 144, 226, 0.3);
  }

  .article-card:nth-child(4) .article-icon {
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.2), rgba(255, 107, 107, 0.2));
    color: var(--yellow);
    box-shadow: 0 8px 25px rgba(255, 209, 102, 0.3);
  }

  .article-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.5rem;
  }

  .article-description {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
    margin: 0;
  }

  /* Challenges Block */
  .challenges-block {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
  }

  .challenges-block::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255, 209, 102, 0.5), transparent);
  }

  .block-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.05), rgba(255, 107, 107, 0.05));
  }

  .block-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    margin: 0;
  }

  .block-content {
    padding: 2rem;
  }

  /* Custom Checkboxes */
  .challenge-item {
    margin-bottom: 1rem;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    transition: all 0.3s;
  }

  .challenge-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
  }

  .form-check-input {
    width: 1.5rem;
    height: 1.5rem;
    background-color: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    cursor: pointer;
  }

  .form-check-input:checked {
    background-color: var(--green);
    border-color: var(--green);
  }

  .form-check-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
    cursor: pointer;
    margin-left: 0.5rem;
  }

  /* Achievement Alert */
  .achievement-alert {
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.15), rgba(255, 107, 107, 0.15));
    border: 1px solid rgba(255, 209, 102, 0.3);
    border-radius: 16px;
    padding: 1.25rem;
    margin-top: 1.5rem;
    color: #fff;
  }

  .achievement-alert strong {
    background: linear-gradient(135deg, var(--yellow), var(--orange));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
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
    padding: 1.5rem 2rem;
  }

  .modal-title {
    font-size: 1.75rem;
    font-weight: 700;
  }

  .modal-body {
    padding: 2rem;
  }

  .modal-body h6 {
    color: #fff;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .modal-body p {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.8;
  }

  .modal-body ul li,
  .modal-body ol li {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 0.5rem;
  }

  .modal-body .table {
    color: rgba(255, 255, 255, 0.9);
  }

  .modal-body .table thead {
    background: rgba(74, 144, 226, 0.1);
  }

  .modal-body .table th,
  .modal-body .table td {
    border-color: rgba(255, 255, 255, 0.1);
    padding: 0.75rem;
  }

  .alert-info {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.15), rgba(79, 195, 247, 0.15));
    border: 1px solid rgba(74, 144, 226, 0.3);
    border-radius: 12px;
    color: #fff;
  }

  .alert-warning {
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.15), rgba(255, 107, 107, 0.15));
    border: 1px solid rgba(255, 209, 102, 0.3);
    border-radius: 12px;
    color: #fff;
  }

  .bg-body-light {
    background: rgba(255, 255, 255, 0.05) !important;
    border-radius: 12px;
  }

  .btn-close {
    filter: invert(1);
  }

  .btn-alt-secondary {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: rgba(255, 255, 255, 0.8);
    padding: 0.5rem 1rem;
  }

  .btn-alt-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    color: #fff;
  }
</style>

<!-- Background Effects -->
<div class="learning-bg"></div>
<div class="learning-grid"></div>
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
          Learning Center
        </h1>
        <h2 class="page-header-subtitle mb-0">
          Educational resources and best practices in space habitat design
        </h2>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Articles -->
    <div class="row">
      <div class="col-lg-6">
        <div class="article-card" data-bs-toggle="modal" data-bs-target="#articleModal" onclick="loadArticle('zonificacion')">
          <div class="d-flex align-items-center">
            <div class="article-icon">
              <i class="fa fa-map-marked-alt"></i>
            </div>
            <div class="flex-grow-1 ms-3">
              <h4 class="article-title">Habitat Zoning</h4>
              <p class="article-description">Learn to organize spaces by functionality and safety</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="article-card" data-bs-toggle="modal" data-bs-target="#articleModal" onclick="loadArticle('adyacencia')">
          <div class="d-flex align-items-center">
            <div class="article-icon">
              <i class="fa fa-project-diagram"></i>
            </div>
            <div class="flex-grow-1 ms-3">
              <h4 class="article-title">Adjacency Rules</h4>
              <p class="article-description">Which modules should be together and which separated</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="article-card" data-bs-toggle="modal" data-bs-target="#articleModal" onclick="loadArticle('crew')">
          <div class="d-flex align-items-center">
            <div class="article-icon">
              <i class="fa fa-users"></i>
            </div>
            <div class="flex-grow-1 ms-3">
              <h4 class="article-title">Crew Requirements</h4>
              <p class="article-description">Resource calculation based on crew size</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="article-card" data-bs-toggle="modal" data-bs-target="#articleModal" onclick="loadArticle('bestpractices')">
          <div class="d-flex align-items-center">
            <div class="article-icon">
              <i class="fa fa-check-circle"></i>
            </div>
            <div class="flex-grow-1 ms-3">
              <h4 class="article-title">Best Practices NASA/ESA</h4>
              <p class="article-description">International standards for space design</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END Articles -->

    <!-- Challenges -->
    <div class="challenges-block">
      <div class="block-header">
        <h3 class="block-title">
          <i class="fa fa-trophy me-2"></i>Learning Challenges
        </h3>
      </div>
      <div class="block-content">
        <div class="row">
          <div class="col-md-6">
            <div class="challenge-item">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="challenge1">
                <label class="form-check-label" for="challenge1">
                  Design a lunar habitat for 4 people
                </label>
              </div>
            </div>
            <div class="challenge-item">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="challenge2">
                <label class="form-check-label" for="challenge2">
                  Optimize energy efficiency > 70%
                </label>
              </div>
            </div>
            <div class="challenge-item">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="challenge3">
                <label class="form-check-label" for="challenge3">
                  Include redundancy in vital systems
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="challenge-item">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="challenge4">
                <label class="form-check-label" for="challenge4">
                  Achieve score > 4.5 on a design
                </label>
              </div>
            </div>
            <div class="challenge-item">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="challenge5">
                <label class="form-check-label" for="challenge5">
                  Complete a Mars transit habitat
                </label>
              </div>
            </div>
            <div class="challenge-item">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="challenge6">
                <label class="form-check-label" for="challenge6">
                  Publish a design to the community
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="achievement-alert">
          <i class="fa fa-star me-2"></i>
          Complete all challenges to unlock the <strong>"Space Architect"</strong> badge
        </div>
      </div>
    </div>
    <!-- END Challenges -->
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Article Modal -->
<div class="modal fade" id="articleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="articleTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="articleBody"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
  const articles = {
    zonificacion: {
      title: 'Space Habitat Zoning',
      content: `
        <h6 class="fw-bold mb-3">Introduction</h6>
        <p>Zoning is fundamental to creating efficient and safe space habitats. It divides the space into functional areas that optimize workflow and safety.</p>
        
        <h6 class="fw-bold mb-3 mt-4">Main Zones</h6>
        <div class="row">
          <div class="col-md-6">
            <ul>
              <li><strong>Operations Zone:</strong> Laboratories, control centers</li>
              <li><strong>Habitation Zone:</strong> Dormitories, common areas</li>
              <li><strong>Life Support Zone:</strong> Critical systems, power</li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul>
              <li><strong>Service Zone:</strong> Storage, maintenance</li>
              <li><strong>Transit Zone:</strong> Corridors, access points</li>
              <li><strong>Emergency Zone:</strong> Evacuation routes, shelters</li>
            </ul>
          </div>
        </div>
        
        <div class="alert alert-info mt-3">
          <i class="fa fa-lightbulb me-2"></i>
          <strong>Tip:</strong> Group similar modules and separate noisy zones from rest areas.
        </div>
      `
    },
    adyacencia: {
      title: 'Module Adjacency Rules',
      content: `
        <h6 class="fw-bold mb-3">Adjacency Principles</h6>
        <p>Certain modules must be close for operational efficiency, while others must be separated for safety.</p>
        
        <h6 class="fw-bold mb-3 mt-4">Recommended Adjacencies</h6>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Module</th>
                <th>Should be near</th>
                <th>Should be far from</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Life Support</td>
                <td>Core, Power</td>
                <td>Dock, Storage</td>
              </tr>
              <tr>
                <td>Laboratory</td>
                <td>Storage, Corridors</td>
                <td>Dormitories, Galley</td>
              </tr>
              <tr>
                <td>Gymnasium</td>
                <td>Common areas</td>
                <td>Sensitive labs</td>
              </tr>
            </tbody>
          </table>
        </div>
      `
    },
    crew: {
      title: 'Crew Requirements',
      content: `
        <h6 class="fw-bold mb-3">Resource Calculation</h6>
        <p>The number of crew members determines the quantity and type of modules needed.</p>
        
        <h6 class="fw-bold mb-3 mt-4">Base Formulas (per crew member)</h6>
        <ul>
          <li><strong>Dormitories:</strong> 1 cabin every 2 people (minimum)</li>
          <li><strong>Life Support:</strong> 1 module every 4 people + 1 redundancy</li>
          <li><strong>Galley:</strong> 1 module every 6 people</li>
          <li><strong>Gymnasium:</strong> 1 module every 8 people</li>
          <li><strong>Storage:</strong> Minimum 2 base modules</li>
        </ul>
        
        <div class="alert alert-warning mt-3">
          <i class="fa fa-exclamation-triangle me-2"></i>
          These are minimum guidelines. Long missions require greater capacity.
        </div>
      `
    },
    bestpractices: {
      title: 'Best Practices NASA/ESA',
      content: `
        <h6 class="fw-bold mb-3">International Standards</h6>
        <p>Principles validated by NASA and ESA for space habitat design.</p>
        
        <h6 class="fw-bold mb-3 mt-4">Design Checklist</h6>
        <ol>
          <li><strong>Redundancy:</strong> Duplicated critical systems</li>
          <li><strong>Modularity:</strong> Replaceable components</li>
          <li><strong>Energy efficiency:</strong> Minimize consumption</li>
          <li><strong>Escape routes:</strong> Multiple exits</li>
          <li><strong>Thermal insulation:</strong> Temperature control</li>
          <li><strong>Radiation protection:</strong> Adequate shielding</li>
          <li><strong>Ergonomics:</strong> Spaces adapted to microgravity</li>
          <li><strong>Maintainability:</strong> Easy access to systems</li>
        </ol>
        
        <div class="bg-body-light p-3 rounded mt-3">
          <p class="fw-semibold mb-2">References:</p>
          <ul class="fs-sm mb-0">
            <li>NASA-STD-3001: Habitat design standards</li>
            <li>ESA ECSS-E-ST-10C: Space systems engineering</li>
          </ul>
        </div>
      `
    }
  };

  function loadArticle(id) {
    const article = articles[id];
    if (!article) return;
    
    document.getElementById('articleTitle').innerHTML = `<i class="fa fa-book me-2"></i>${article.title}`;
    document.getElementById('articleBody').innerHTML = article.content;
  }
</script>

<?php
include __DIR__.'/../../includes/footer.php';
?>