<?php
// modules/auth/login.php — login single-tenant (sin organizaciones)

require_once __DIR__ . '/../../app/csrf.php';
require_once __DIR__ . '/../../app/auth.php';

// --- Tiny file-based rate limiter (10 attempts / 10 min por IP)
function rl_hit(string $key, int $max, int $win): bool {
  // Desactivado para demo
  return true;
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// MODO DEMO: El login se maneja por JS en el cliente para la versión estática.
// Pero mantenemos el PHP por si acaso se accede directamente.
if ($method === 'POST') {
  // ... lógica original simplificada o eliminada si solo queremos JS ...
  // Para WinHTTrack, esto no se ejecutará porque es estático.
}

$csrf  = csrf_token();
$error = $_GET['e'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SpaceCrafter - Login</title>
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

  .forgot-link {
    text-align: right;
    margin-bottom: 1.5rem;
  }

  .forgot-link a {
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s;
  }

  .forgot-link a:hover {
    color: var(--blue);
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

        <h2 class="visual-title" id="carousel-title">Build your space station</h2>
        <p class="visual-subtitle" id="carousel-subtitle">The leading platform for designing habitats of the future</p>

        <div class="carousel-container">
          <!-- Slide 1: Imagen de estación -->
          <div class="carousel-slide active" data-slide="0">
            <div class="habitat-preview">
              <div class="station-image">
                <img src="/modules/habitat/assets/img/complete_design.webp" alt="Space Station" style="width: 100%; height: 100%; object-fit: contain; border-radius: 24px;">
              </div>

              <div class="floating-stat stat-1">
                <div class="stat-number">4.8</div>
                <div class="stat-label">Rating</div>
              </div>

              <div class="floating-stat stat-2">
                <div class="stat-number">20</div>
                <div class="stat-label">Módulos</div>
              </div>
            </div>
          </div>

          <!-- Slide 2: AI Assistant -->
          <div class="carousel-slide" data-slide="1">
            <div class="ai-preview">
              <div class="ai-avatar">🤖</div>
              <div class="ai-messages">
                <div class="ai-message">Where do I put the lab?</div>
                <div class="ai-response">I recommend placing it near the central module for easier access...</div>
              </div>
            </div>
          </div>

          <!-- Slide 3: Rankings -->
          <div class="carousel-slide" data-slide="2">
            <div class="ranking-preview">
              <div class="ranking-card">
                <div class="rank-badge">🥇</div>
                <div class="rank-info">
                  <div class="rank-name">Lunar Alpha Station</div>
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
          <h1>Welcome back</h1>
          <div class="alert alert-info" style="background: rgba(74, 144, 226, 0.15); border: 1px solid rgba(74, 144, 226, 0.3); padding: 1rem; border-radius: 12px; margin-top: 1rem;">
            <p style="margin-bottom: 0.5rem; font-weight: bold; color: #fff;">DEMO MODE</p>
            <p style="margin-bottom: 0; font-size: 0.9rem;">User: <strong>demo</strong><br>Password: <strong>demo</strong></p>
          </div>
        </div>

        <form id="loginForm" onsubmit="return handleLogin(event)">
          <input type="hidden" name="csrf" value="static-token">
          
          <div id="error-msg" class="text-danger" style="display: none;">
            <span>⚠️</span>
            <span id="error-text"></span>
          </div>

          <div class="form-group">
            <label class="form-label" for="login-email">Username</label>
            <input 
              type="text" 
              id="login-email" 
              name="login-email" 
              class="form-control"
              placeholder="demo"
              required
              autocomplete="username"
            >
          </div>

          <div class="form-group">
            <label class="form-label" for="login-password">Password</label>
            <input 
              type="password" 
              id="login-password" 
              name="login-password" 
              class="form-control"
              placeholder="demo"
              required
              autocomplete="current-password"
            >
          </div>

          <button type="submit" class="btn-submit">
            Sign In
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
    function handleLogin(e) {
      e.preventDefault();
      const user = document.getElementById('login-email').value;
      const pass = document.getElementById('login-password').value;
      const errorDiv = document.getElementById('error-msg');
      const errorText = document.getElementById('error-text');

      if (user === 'demo' && pass === 'demo') {
        // Redirigir al dashboard
        // Si usas WinHTTrack, probablemente convierta /dashboard a dashboard.html
        // Intentamos redirigir a la ruta relativa que funcionaría en estático
        window.location.href = '/dashboard'; 
      } else {
        errorDiv.style.display = 'flex';
        errorText.textContent = 'Invalid credentials. Use demo/demo';
      }
      return false;
    }

    // Carousel functionality
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    const title = document.getElementById('carousel-title');
    const subtitle = document.getElementById('carousel-subtitle');
    
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds

    const slideContent = [
      {
        title: 'Build your space station',
        subtitle: 'The leading platform for designing habitats of the future'
      },
      {
        title: 'Personalized AI assistant',
        subtitle: 'Get intelligent suggestions and learn while designing your space station'
      },
      {
        title: 'Compete with the community',
        subtitle: 'Share your designs, vote for the best ones and climb the global ranking'
      }
    ];

    function showSlide(index) {
      // Remove active from all
      slides.forEach(slide => slide.classList.remove('active'));
      indicators.forEach(ind => ind.classList.remove('active'));

      // Add active to current
      slides[index].classList.add('active');
      indicators[index].classList.add('active');

      // Update text content
      title.textContent = slideContent[index].title;
      subtitle.textContent = slideContent[index].subtitle;

      currentSlide = index;
    }

    function nextSlide() {
      const next = (currentSlide + 1) % slides.length;
      showSlide(next);
    }

    // Auto-rotate carousel
    let carouselInterval = setInterval(nextSlide, slideInterval);

    // Manual control via indicators
    indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => {
        showSlide(index);
        // Reset interval on manual click
        clearInterval(carouselInterval);
        carouselInterval = setInterval(nextSlide, slideInterval);
      });
    });
  </script>
</body>
</html>
