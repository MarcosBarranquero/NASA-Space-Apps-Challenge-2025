<?php
// modules/auth/signup.php — Registro con diseño SpaceCrafter

require_once __DIR__ . '/../../app/csrf.php';
require_once __DIR__ . '/../../app/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!csrf_check($_POST['csrf'] ?? null)) {
    $error = 'Invalid CSRF token';
  } else {
    $name  = trim($_POST['signup-username'] ?? '');
    $email = trim($_POST['signup-email'] ?? '');
    $pass1 = $_POST['signup-password'] ?? '';
    $pass2 = $_POST['signup-password-confirm'] ?? '';
    $terms = isset($_POST['signup-terms']);

    if (!$terms) {
      $error = 'You must accept the terms and conditions';
    } elseif ($pass1 !== $pass2) {
      $error = 'Passwords do not match';
    } else {
      $res = auth_register($name, $email, $pass1);

      if ($res['ok']) {
        header("Location: /dashboard");
        exit;
      } else {
        $error = $res['error'];
      }
    }
  }
}

$csrf = csrf_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SpaceCrafter - Sign Up</title>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  :root {
    --yellow: #FFD166;
    --blue: #4A90E2;
    --purple: #8B5CF6;
    --navy: #0A0B1E;
  }

  body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Inter', sans-serif;
    background: var(--navy);
    color: #fff;
    min-height: 100vh;
    display: flex;
    position: relative;
    overflow: hidden;
  }

  /* Animated background */
  .bg-gradient {
    position: fixed;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(74, 144, 226, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 209, 102, 0.15) 0%, transparent 50%);
    animation: gradientShift 20s ease infinite;
  }

  @keyframes gradientShift {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
  }

  .bg-grid {
    position: fixed;
    inset: 0;
    background-image: 
      linear-gradient(rgba(74, 144, 226, 0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(74, 144, 226, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
  }

  /* Orbs */
  .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    animation: float 8s ease-in-out infinite;
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
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    bottom: 20%;
    right: 10%;
    opacity: 0.15;
    animation-delay: -4s;
  }

  @keyframes float {
    0%, 100% { transform: translate(0, 0); }
    50% { transform: translate(30px, -30px); }
  }

  /* Split layout */
  .container {
    display: flex;
    width: 100%;
    height: 100vh;
    position: relative;
    z-index: 10;
  }

  /* Left panel - Visual (35%) */
  .left-panel {
    flex: 0 0 35%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    position: relative;
  }

  .visual-content {
    max-width: 100%;
    width: 100%;
  }

  .logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 2rem;
  }

  .logo-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    box-shadow: 0 12px 35px rgba(255, 209, 102, 0.5);
  }

  .logo-text {
    font-size: 1.75rem;
    font-weight: 900;
  }

  .visual-title {
    font-size: 1.75rem;
    font-weight: 900;
    margin-bottom: 0.75rem;
    line-height: 1.2;
  }

  .visual-subtitle {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 2rem;
    line-height: 1.6;
  }

  /* Carousel container */
  .carousel-container {
    position: relative;
    width: 100%;
    min-height: 400px;
  }

  .carousel-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.6s ease, visibility 0.6s ease;
  }

  .carousel-slide.active {
    opacity: 1;
    visibility: visible;
  }

  /* Slide 1: Station Image */
  .habitat-preview {
    width: 100%;
    aspect-ratio: 1;
    max-width: 380px;
    margin: 0 auto;
    position: relative;
  }

  .station-image {
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 28px;
    padding: 1.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  /* Slide 2: AI Assistant */
  .ai-preview {
    width: 100%;
    max-width: 380px;
    margin: 0 auto;
  }

  .ai-avatar {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    margin: 0 auto 2rem;
    animation: float 4s ease-in-out infinite;
    box-shadow: 0 20px 50px rgba(74, 144, 226, 0.5);
  }

  .ai-messages {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .ai-message {
    padding: 1rem 1.25rem;
    border-radius: 20px;
    background: rgba(255, 209, 102, 0.15);
    border: 1px solid rgba(255, 209, 102, 0.3);
    margin-left: auto;
    max-width: 80%;
    animation: slideInRight 0.5s ease-out;
  }

  .ai-response {
    padding: 1rem 1.25rem;
    border-radius: 20px;
    background: rgba(74, 144, 226, 0.15);
    border: 1px solid rgba(74, 144, 226, 0.3);
    max-width: 85%;
    animation: slideInLeft 0.5s ease-out 0.3s both;
  }

  @keyframes slideInRight {
    from {
      opacity: 0;
      transform: translateX(20px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideInLeft {
    from {
      opacity: 0;
      transform: translateX(-20px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  /* Slide 3: Rankings */
  .ranking-preview {
    width: 100%;
    max-width: 380px;
    margin: 0 auto;
  }

  .ranking-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    animation: slideInUp 0.5s ease-out backwards;
  }

  .ranking-card:nth-child(1) { animation-delay: 0.1s; }
  .ranking-card:nth-child(2) { animation-delay: 0.2s; }
  .ranking-card:nth-child(3) { animation-delay: 0.3s; }

  @keyframes slideInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .rank-badge {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
  }

  .rank-badge.second {
    background: linear-gradient(135deg, rgba(192, 192, 192, 0.8), rgba(169, 169, 169, 0.8));
  }

  .rank-badge.third {
    background: linear-gradient(135deg, rgba(205, 127, 50, 0.8), rgba(184, 115, 51, 0.8));
  }

  .rank-info {
    flex: 1;
  }

  .rank-name {
    font-weight: 700;
    margin-bottom: 0.25rem;
  }

  .rank-score {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
  }

  /* Carousel indicators */
  .carousel-indicators {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
  }

  .indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transition: all 0.3s;
    cursor: pointer;
  }

  .indicator.active {
    background: var(--blue);
    width: 24px;
    border-radius: 4px;
  }

  /* Floating stats */
  .floating-stat {
    position: absolute;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    padding: 0.875rem 1.25rem;
    animation: statFloat 4s ease-in-out infinite;
    font-size: 0.85rem;
  }

  .stat-1 {
    top: 10%;
    right: 5%;
    animation-delay: 0s;
  }

  .stat-2 {
    bottom: 15%;
    left: 5%;
    animation-delay: 2s;
  }

  @keyframes statFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
  }

  .stat-number {
    font-size: 1.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-label {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.6);
    margin-top: 0.25rem;
  }

  /* Right panel - Form */
  .right-panel {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem 2rem;
    background: rgba(10, 11, 30, 0.4);
    backdrop-filter: blur(20px);
    border-left: 1px solid rgba(255, 255, 255, 0.1);
  }

  .form-container {
    width: 100%;
    max-width: 550px;
  }

  .form-header {
    text-align: center;
    margin-bottom: 2.5rem;
  }

  .form-header h1 {
    font-size: 2rem;
    font-weight: 900;
    margin-bottom: 0.5rem;
  }

  .form-header p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.95rem;
  }

  .form-header a {
    color: var(--yellow);
    text-decoration: none;
    font-weight: 600;
  }

  .form-header a:hover {
    color: #FFB84D;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
  }

  .form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    color: #fff;
    font-size: 1rem;
    transition: all 0.3s;
  }

  .form-control:focus {
    outline: none;
    border-color: var(--blue);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.2);
  }

  .form-control::placeholder {
    color: rgba(255, 255, 255, 0.35);
  }

  .text-danger {
    background: rgba(255, 107, 107, 0.15);
    border: 1px solid rgba(255, 107, 107, 0.3);
    border-radius: 12px;
    padding: 0.875rem 1rem;
    color: #ff6b6b;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .terms-box {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
  }

  .checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .checkbox-wrapper input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: var(--blue);
  }

  .checkbox-wrapper label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.7);
    cursor: pointer;
  }

  .checkbox-wrapper label a {
    color: var(--yellow);
    text-decoration: none;
  }

  .checkbox-wrapper label a:hover {
    text-decoration: underline;
  }

  .btn-submit {
    width: 100%;
    padding: 1.125rem;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border: none;
    border-radius: 16px;
    color: #fff;
    font-size: 1.05rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4);
    position: relative;
    overflow: hidden;
  }

  .btn-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2));
    transform: translateX(-100%);
    transition: transform 0.5s;
  }

  .btn-submit:hover::before {
    transform: translateX(100%);
  }

  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 35px rgba(74, 144, 226, 0.6);
  }

  .footer-text {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.5);
  }

  /* Responsive */
  @media (max-width: 1024px) {
    .container {
      flex-direction: column;
    }

    .left-panel {
      display: none;
    }

    .right-panel {
      max-width: 100%;
      border-left: none;
    }
  }
</style>
</head>
<body>
  <!-- Animated Background -->
  <div class="bg-gradient"></div>
  <div class="bg-grid"></div>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  <div class="container">
    <!-- Left Panel - Visual -->
    <div class="left-panel">
      <div class="visual-content">
        <div class="logo">
          <div class="logo-icon">🚀</div>
          <div class="logo-text">SpaceCrafter</div>
        </div>

        <h2 class="visual-title" id="carousel-title">Join the space adventure</h2>
        <p class="visual-subtitle" id="carousel-subtitle">Begin your journey as a space architect and create incredible habitats</p>

        <div class="carousel-container">
          <!-- Slide 1: Station Image -->
          <div class="carousel-slide active" data-slide="0">
            <div class="habitat-preview">
              <div class="station-image">
                <img src="/modules/habitat/assets/img/complete_design.webp" alt="Space Station" style="width: 100%; height: 100%; object-fit: contain; border-radius: 24px;">
              </div>

              <div class="floating-stat stat-1">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Users</div>
              </div>

              <div class="floating-stat stat-2">
                <div class="stat-number">100%</div>
                <div class="stat-label">Free</div>
              </div>
            </div>
          </div>

          <!-- Slide 2: AI Assistant -->
          <div class="carousel-slide" data-slide="1">
            <div class="ai-preview">
              <div class="ai-avatar">🤖</div>
              <div class="ai-messages">
                <div class="ai-message">How do I start my design?</div>
                <div class="ai-response">Easy! I'll guide you step by step in your first space habitat...</div>
              </div>
            </div>
          </div>

          <!-- Slide 3: Rankings -->
          <div class="carousel-slide" data-slide="2">
            <div class="ranking-preview">
              <div class="ranking-card">
                <div class="rank-badge">🥇</div>
                <div class="rank-info">
                  <div class="rank-name">Lunar Station Alpha</div>
                  <div class="rank-score">⭐ 4.8 • 1,234 votes</div>
                </div>
              </div>
              <div class="ranking-card">
                <div class="rank-badge second">🥈</div>
                <div class="rank-info">
                  <div class="rank-name">Martian Habitat X1</div>
                  <div class="rank-score">⭐ 4.7 • 987 votes</div>
                </div>
              </div>
              <div class="ranking-card">
                <div class="rank-badge third">🥉</div>
                <div class="rank-info">
                  <div class="rank-name">ISS Next Gen</div>
                  <div class="rank-score">⭐ 4.6 • 856 votes</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Carousel indicators -->
        <div class="carousel-indicators">
          <div class="indicator active" data-indicator="0"></div>
          <div class="indicator" data-indicator="1"></div>
          <div class="indicator" data-indicator="2"></div>
        </div>
      </div>
    </div>

    <!-- Right Panel - Form -->
    <div class="right-panel">
      <div class="form-container">
        <div class="form-header">
          <h1>Create your account</h1>
          <p>Already have an account? <a href="/login">Sign in here</a></p>
        </div>

        <form action="/signup" method="POST">
          <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf) ?>">
          
          <?php if (!empty($error)): ?>
          <div class="text-danger">
            <span>⚠️</span>
            <span><?= htmlspecialchars($error) ?></span>
          </div>
          <?php endif; ?>

          <div class="form-group">
            <label class="form-label" for="signup-username">Username</label>
            <input 
              type="text" 
              id="signup-username" 
              name="signup-username" 
              class="form-control"
              placeholder="astronaut123"
              required
              autocomplete="username"
            >
          </div>

          <div class="form-group">
            <label class="form-label" for="signup-email">Email</label>
            <input 
              type="email" 
              id="signup-email" 
              name="signup-email" 
              class="form-control"
              placeholder="your@email.com"
              required
              autocomplete="email"
            >
          </div>

          <div class="form-group">
            <label class="form-label" for="signup-password">Password</label>
            <input 
              type="password" 
              id="signup-password" 
              name="signup-password" 
              class="form-control"
              placeholder="••••••••"
              required
              autocomplete="new-password"
            >
          </div>

          <div class="form-group">
            <label class="form-label" for="signup-password-confirm">Confirm password</label>
            <input 
              type="password" 
              id="signup-password-confirm" 
              name="signup-password-confirm" 
              class="form-control"
              placeholder="••••••••"
              required
              autocomplete="new-password"
            >
          </div>

          <div class="terms-box">
            <div class="checkbox-wrapper">
              <input 
                type="checkbox" 
                id="signup-terms" 
                name="signup-terms" 
                required
              >
              <label for="signup-terms">
                I accept the <a href="/terms" target="_blank">Terms and Conditions</a>
              </label>
            </div>
          </div>

          <button type="submit" class="btn-submit">
            🚀 Create Account
          </button>
        </form>

        <div class="footer-text">
          <p><strong>SpaceCrafter</strong> © 2025 • 
            <a href="/legal" style="color: rgba(255,255,255,0.6);">Legal</a> • 
            <a href="/terms" style="color: rgba(255,255,255,0.6);">Terms</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Carousel functionality
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    const title = document.getElementById('carousel-title');
    const subtitle = document.getElementById('carousel-subtitle');
    
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds

    const slideContent = [
      {
        title: 'Join the space adventure',
        subtitle: 'Begin your journey as a space architect and create incredible habitats'
      },
      {
        title: 'Learn while you design',
        subtitle: 'Our AI assistant helps you improve your space design skills'
      },
      {
        title: 'Be part of the community',
        subtitle: 'Thousands of designers share and vote for the best space habitats'
      }
    ];

    function showSlide(index) {
      slides.forEach(slide => slide.classList.remove('active'));
      indicators.forEach(ind => ind.classList.remove('active'));

      slides[index].classList.add('active');
      indicators[index].classList.add('active');

      title.textContent = slideContent[index].title;
      subtitle.textContent = slideContent[index].subtitle;

      currentSlide = index;
    }

    function nextSlide() {
      const next = (currentSlide + 1) % slides.length;
      showSlide(next);
    }

    let carouselInterval = setInterval(nextSlide, slideInterval);

    indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => {
        showSlide(index);
        clearInterval(carouselInterval);
        carouselInterval = setInterval(nextSlide, slideInterval);
      });
    });
  </script>
</body>
</html>