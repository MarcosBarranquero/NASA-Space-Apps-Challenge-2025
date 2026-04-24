<?php
// modules/auth/forgot-password.php — Recuperar contraseña (diseño solamente)

// Este archivo es solo diseño, no tiene funcionalidad real
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SpaceCrafter - Forgot Password</title>
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

  /* Slide 1: Security Shield */
  .security-preview {
    width: 100%;
    max-width: 380px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .shield-icon {
    width: 180px;
    height: 180px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 5rem;
    margin-bottom: 2rem;
    animation: pulse 3s ease-in-out infinite;
    box-shadow: 0 20px 60px rgba(74, 144, 226, 0.6);
    position: relative;
  }

  .shield-icon::before {
    content: '';
    position: absolute;
    inset: -10px;
    border-radius: 50%;
    border: 2px solid rgba(74, 144, 226, 0.3);
    animation: ripple 2s ease-out infinite;
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
  }

  @keyframes ripple {
    0% {
      transform: scale(1);
      opacity: 1;
    }
    100% {
      transform: scale(1.5);
      opacity: 0;
    }
  }

  .security-text {
    text-align: center;
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.8);
  }

  /* Slide 2: Email illustration */
  .email-preview {
    width: 100%;
    max-width: 380px;
    margin: 0 auto;
  }

  .email-envelope {
    width: 200px;
    height: 150px;
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.2), rgba(255, 209, 102, 0.1));
    border: 2px solid rgba(255, 209, 102, 0.4);
    border-radius: 20px;
    margin: 0 auto 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    animation: float 4s ease-in-out infinite;
    position: relative;
  }

  .email-notification {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #ff6b6b, #ff4757);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    animation: bounce 1s ease-in-out infinite;
  }

  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }

  .email-steps {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .step-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.875rem 1.25rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    animation: slideInLeft 0.5s ease-out backwards;
  }

  .step-item:nth-child(1) { animation-delay: 0.1s; }
  .step-item:nth-child(2) { animation-delay: 0.2s; }
  .step-item:nth-child(3) { animation-delay: 0.3s; }

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

  .step-number {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
  }

  .step-text {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
  }

  /* Slide 3: Support */
  .support-preview {
    width: 100%;
    max-width: 380px;
    margin: 0 auto;
    text-align: center;
  }

  .support-icon {
    width: 140px;
    height: 140px;
    background: linear-gradient(135deg, #5ad398, #4fc3f7);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    margin: 0 auto 2rem;
    animation: float 4s ease-in-out infinite;
    box-shadow: 0 20px 50px rgba(90, 211, 152, 0.4);
  }

  .support-text {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 1.5rem;
  }

  .support-links {
    display: flex;
    justify-content: center;
    gap: 1rem;
  }

  .support-link {
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s;
  }

  .support-link:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: var(--blue);
    color: #fff;
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

  .form-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 1.5rem;
    box-shadow: 0 15px 40px rgba(255, 209, 102, 0.4);
  }

  .form-header h1 {
    font-size: 2rem;
    font-weight: 900;
    margin-bottom: 0.5rem;
  }

  .form-header p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.95rem;
    line-height: 1.6;
  }

  .info-box {
    background: rgba(74, 144, 226, 0.1);
    border: 1px solid rgba(74, 144, 226, 0.3);
    border-radius: 16px;
    padding: 1.25rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: start;
    gap: 1rem;
  }

  .info-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }

  .info-text {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.5;
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

  .back-link {
    text-align: center;
    margin-top: 1.5rem;
  }

  .back-link a {
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    font-size: 0.95rem;
    transition: color 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .back-link a:hover {
    color: var(--yellow);
  }

  .footer-text {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.5);
  }

  /* Success message (hidden by default) */
  .success-message {
    display: none;
    background: rgba(90, 211, 152, 0.15);
    border: 1px solid rgba(90, 211, 152, 0.3);
    border-radius: 16px;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
    color: #5ad398;
    font-size: 0.95rem;
    animation: slideInDown 0.5s ease-out;
  }

  @keyframes slideInDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
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

        <h2 class="visual-title" id="carousel-title">Secure recovery</h2>
        <p class="visual-subtitle" id="carousel-subtitle">Your account is protected with advanced space security systems</p>

        <div class="carousel-container">
          <!-- Slide 1: Security -->
          <div class="carousel-slide active" data-slide="0">
            <div class="security-preview">
              <div class="shield-icon">🛡️</div>
              <p class="security-text">Your data is encrypted and secure</p>
              
              <div class="floating-stat stat-1">
                <div class="stat-number">256-bit</div>
                <div class="stat-label">Encriptación</div>
              </div>

              <div class="floating-stat stat-2">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Protección</div>
              </div>
            </div>
          </div>

          <!-- Slide 2: Process -->
          <div class="carousel-slide" data-slide="1">
            <div class="email-preview">
              <div class="email-envelope">
                📧
                <div class="email-notification">1</div>
              </div>
              <div class="email-steps">
                <div class="step-item">
                  <div class="step-number">1</div>
                  <div class="step-text">Enter your registered email</div>
                </div>
                <div class="step-item">
                  <div class="step-number">2</div>
                  <div class="step-text">Receive recovery link</div>
                </div>
                <div class="step-item">
                  <div class="step-number">3</div>
                  <div class="step-text">Create a new password</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Slide 3: Support -->
          <div class="carousel-slide" data-slide="2">
            <div class="support-preview">
              <div class="support-icon">💬</div>
              <p class="support-text">Having trouble recovering your account?</p>
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
          <div class="form-icon">🔑</div>
          <h1>Forgot your password?</h1>
          <p>Don't worry, we'll send you instructions to recover your account</p>
        </div>

        <div class="info-box">
          <span class="info-icon">ℹ️</span>
          <p class="info-text">
            You will receive an email with a secure link to reset your password. 
            The link expires in 1 hour for security.
          </p>
        </div>

        <div class="success-message" id="success-message">
          ✅ Mail sent! Please check your inbox for the recovery link.
        </div>

        <form id="forgot-form">
          <div class="form-group">
            <label class="form-label" for="reset-email">Email registered</label>
            <input 
              type="email" 
              id="reset-email" 
              name="reset-email" 
              class="form-control"
              placeholder="your@email.com"
              required
              autocomplete="email"
            >
          </div>

          <button type="submit" class="btn-submit">
            📨 Send recovery link
          </button>
        </form>

        <div class="back-link">
          <a href="/login">
            ← Back to login
          </a>
        </div>

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
    const slideInterval = 5000;

    const slideContent = [
      {
        title: 'Secure Recovery',
        subtitle: 'Your account is protected with advanced space security systems'
      },
      {
        title: 'Simple Process',
        subtitle: 'Just 3 steps to regain access to your astronaut account'
      },
      {
        title: '24/7 Support',
        subtitle: 'Our team is here to help you anytime'
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

    // Form submit (solo demo visual)
    document.getElementById('forgot-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Mostrar mensaje de éxito
      const successMsg = document.getElementById('success-message');
      successMsg.style.display = 'block';
      
      // Limpiar el formulario
      this.reset();
      
      // Ocultar mensaje después de 5 segundos
      setTimeout(() => {
        successMsg.style.display = 'none';
      }, 5000);
    });
  </script>
</body>
</html>