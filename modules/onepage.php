<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SpaceCrafter</title>
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
    --pink: #EC4899;
  }

  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: #fff;
    line-height: 1.6;
    overflow-x: hidden;
    background: #0A0B1E;
  }

  /* Animated Background */
  .bg-gradient {
    position: fixed;
    inset: 0;
    z-index: 0;
    background: radial-gradient(circle at 20% 50%, rgba(74, 144, 226, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 209, 102, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    animation: gradientShift 20s ease infinite;
  }

  @keyframes gradientShift {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
  }

  .bg-grid {
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image: 
      linear-gradient(rgba(74, 144, 226, 0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(74, 144, 226, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
  }

  /* Floating orbs */
  .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    animation: float 8s ease-in-out infinite;
    z-index: 1;
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
    background: linear-gradient(135deg, var(--yellow), var(--pink));
    bottom: 20%;
    right: 10%;
    opacity: 0.15;
    animation-delay: -4s;
  }

  @keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -30px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
  }

  /* Navigation styles */
  nav {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 1rem 2rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  }

  .nav-container {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  .logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    font-weight: 800;
    font-size: 1.25rem;
    color: #fff;
  }

  .logo span {
    background: linear-gradient(135deg, #4A90E2, #8B5CF6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 1.5rem;
  }

  .nav-links a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 12px;
    transition: all 0.3s;
    font-weight: 500;
  }

  .nav-links a:hover {
    color: #fff;
    background: rgba(255, 255, 255, 0.1);
  }

  .btn {
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
  }

  .btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .btn-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
  }

  .btn-primary {
    background: linear-gradient(135deg, #4A90E2, #8B5CF6);
    color: #fff;
    box-shadow: 0 4px 15px rgba(74, 144, 226, 0.4);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(74, 144, 226, 0.6);
  }

  .mobile-menu-btn {
    display: none;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 8px 12px;
    color: #fff;
    cursor: pointer;
    font-size: 1.2rem;
  }

  @media (max-width: 1024px) {
    nav {
      left: 20px;
      right: 20px;
      transform: none;
    }

    .nav-links {
      display: none;
    }

    .mobile-menu-btn {
      display: block;
    }
  }

  /* Hero Section */
  .hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    padding: 0 2rem;
  }

  .hero-container {
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    position: relative;
    z-index: 10;
  }

  .hero-content {
    animation: fadeInUp 1s ease-out;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 100px;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .badge::before {
    content: '✨';
    font-size: 1rem;
  }

  .hero-content h1 {
    font-size: 4rem;
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .gradient-text {
    background: linear-gradient(135deg, var(--yellow), var(--blue), var(--purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    background-size: 200% auto;
    animation: gradientFlow 3s ease infinite;
  }

  @keyframes gradientFlow {
    0%, 100% { background-position: 0% center; }
    50% { background-position: 100% center; }
  }

  .hero-content p {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 2.5rem;
    line-height: 1.8;
  }

  .hero-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
  }

  .btn-hero {
    padding: 16px 36px;
    font-size: 1rem;
  }

  .btn-glow {
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    color: #0A0B1E;
    box-shadow: 0 8px 32px rgba(255, 209, 102, 0.5);
    font-weight: 700;
  }

  .btn-glow:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(255, 209, 102, 0.7);
  }

  /* 3D Habitat Visualization */
  .hero-visual {
    position: relative;
    animation: fadeInRight 1s ease-out 0.3s both;
  }

  @keyframes fadeInRight {
    from {
      opacity: 0;
      transform: translateX(50px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .glass-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 32px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    position: relative;
    overflow: hidden;
  }

  .glass-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  }

  .habitat-3d {
    width: 100%;
    aspect-ratio: 1;
    display: grid;
    grid-template-columns: repeat(8, 1fr);
    grid-template-rows: repeat(8, 1fr);
    gap: 1px;
    position: relative;
    background: rgba(10, 11, 30, 0.3);
    border-radius: 20px;
    padding: 20px;
  }

  /* Grid lines visible */
  .habitat-3d::before {
    content: '';
    position: absolute;
    inset: 20px;
    background-image: 
      repeating-linear-gradient(0deg, rgba(74, 144, 226, 0.15) 0px, transparent 1px, transparent calc(12.5% - 1px), rgba(74, 144, 226, 0.15) 12.5%),
      repeating-linear-gradient(90deg, rgba(74, 144, 226, 0.15) 0px, transparent 1px, transparent calc(12.5% - 1px), rgba(74, 144, 226, 0.15) 12.5%);
    border-radius: 16px;
    pointer-events: none;
    z-index: 0;
  }

  .module-3d {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.15), rgba(139, 92, 246, 0.15));
    border: 2px solid rgba(255, 255, 255, 0.25);
    border-radius: 12px;
    position: relative;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    z-index: 1;
  }

  .module-3d::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
    border-radius: 10px;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .module-3d:hover::before {
    opacity: 1;
  }

  /* Different module types */
  .module-lab {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.35), rgba(74, 144, 226, 0.2));
    border-color: rgba(74, 144, 226, 0.7);
  }

  .module-living {
    background: linear-gradient(135deg, rgba(255, 209, 102, 0.35), rgba(255, 209, 102, 0.2));
    border-color: rgba(255, 209, 102, 0.7);
  }

  .module-garden {
    background: linear-gradient(135deg, rgba(90, 211, 156, 0.35), rgba(90, 211, 156, 0.2));
    border-color: rgba(90, 211, 156, 0.7);
  }

  .module-power {
    background: linear-gradient(135deg, rgba(236, 72, 153, 0.35), rgba(236, 72, 153, 0.2));
    border-color: rgba(236, 72, 153, 0.7);
  }

  /* Size variations - perfect squares */
  .size-1x1 { 
    grid-column: span 1; 
    grid-row: span 1;
    font-size: 1.5rem;
  }
  
  .size-2x2 { 
    grid-column: span 2; 
    grid-row: span 2;
    font-size: 2.5rem;
  }

  .size-4x4 { 
    grid-column: span 4; 
    grid-row: span 4;
    font-size: 4rem;
  }

  /* Breathing animation */
  @keyframes breathe {
    0%, 100% {
      transform: scale(1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    50% {
      transform: scale(1.02);
      box-shadow: 0 6px 28px rgba(74, 144, 226, 0.5);
    }
  }

  /* Placement animation */
  @keyframes placeModule {
    0% {
      transform: scale(0) rotate(-5deg);
      opacity: 0;
    }
    70% {
      transform: scale(1.1) rotate(2deg);
    }
    100% {
      transform: scale(1) rotate(0deg);
      opacity: 1;
    }
  }

  /* Pulse for central module */
  @keyframes pulse {
    0%, 100% {
      transform: scale(1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    50% {
      transform: scale(1.04);
      box-shadow: 0 8px 35px rgba(255, 209, 102, 0.7);
      border-color: rgba(255, 209, 102, 0.9);
    }
  }

  .module-3d {
    animation: placeModule 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards,
               breathe 5s ease-in-out 2s infinite;
  }

  .module-3d:nth-child(1) { animation-delay: 0.1s, 2.1s; }
  .module-3d:nth-child(2) { animation-delay: 0.15s, 2.2s; }
  .module-3d:nth-child(3) { animation-delay: 0.2s, 2.3s; }
  .module-3d:nth-child(4) { animation-delay: 0.25s, 2.4s; }
  .module-3d:nth-child(5) { animation-delay: 0.3s, 2.5s; }
  .module-3d:nth-child(6) { animation-delay: 0.35s, 2.6s; }
  .module-3d:nth-child(7) { animation-delay: 0.4s, 2.7s; }
  .module-3d:nth-child(8) { animation-delay: 0.45s, 2.8s; }
  .module-3d:nth-child(9) { animation-delay: 0.5s, 2.9s; }
  .module-3d:nth-child(10) { animation-delay: 0.55s, 3.0s; }

  /* Central module pulses */
  #central-module {
    animation: placeModule 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s forwards,
               pulse 4s ease-in-out 2.3s infinite;
  }

  /* Stats floating cards */
  .stats-float {
    position: absolute;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 16px 24px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    animation: floatStat 6s ease-in-out infinite;
  }

  .stats-float-1 {
    top: 10%;
    right: -10%;
    animation-delay: 0s;
  }

  .stats-float-2 {
    bottom: 15%;
    left: -5%;
    animation-delay: 2s;
  }

  @keyframes floatStat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
  }

  .stat-value {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--yellow), var(--blue));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
  }

  /* Features Section */
  .features {
    padding: 8rem 2rem;
    position: relative;
    z-index: 10;
  }

  .features-container {
    max-width: 1500px;
    margin: 0 auto;
  }

  .section-header {
    text-align: center;
    margin-bottom: 5rem;
  }

  .section-badge {
    display: inline-block;
    padding: 8px 20px;
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 100px;
    color: var(--purple);
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }

  .section-header h2 {
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 1rem;
    color: #fff;
  }

  .section-header p {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.6);
    max-width: 600px;
    margin: 0 auto;
  }

  .features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
  }

  .feature-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 2.5rem;
    border-radius: 28px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }

  .feature-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.05), rgba(255, 209, 102, 0.05));
    opacity: 0;
    transition: opacity 0.4s;
  }

  .feature-card:hover {
    transform: translateY(-12px);
    border-color: rgba(255, 255, 255, 0.15);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
  }

  .feature-card:hover::before {
    opacity: 1;
  }

  .feature-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 10px 30px rgba(74, 144, 226, 0.4);
    position: relative;
    z-index: 1;
  }

  .feature-card:nth-child(2) .feature-icon,
  .feature-card:nth-child(5) .feature-icon {
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    box-shadow: 0 10px 30px rgba(255, 209, 102, 0.4);
  }

  .feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
  }

  .feature-card p {
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.8;
    position: relative;
    z-index: 1;
  }

  /* Auto-rotating Showcase */
  .showcase-wrapper {
    margin-top: 4rem;
  }

  .showcase-tabs {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 3rem;
    flex-wrap: wrap;
  }

  .tab-btn {
    flex: 1;
    min-width: 200px;
    max-width: 280px;
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 1.5rem 1.25rem;
    cursor: pointer;
    transition: all 0.4s;
    position: relative;
    overflow: hidden;
  }

  .tab-btn:hover {
    border-color: rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-4px);
  }

  .tab-btn.active {
    border-color: var(--blue);
    background: rgba(74, 144, 226, 0.1);
    box-shadow: 0 8px 30px rgba(74, 144, 226, 0.3);
  }

  .tab-icon {
    font-size: 2rem;
    display: block;
    margin-bottom: 0.5rem;
  }

  .tab-label {
    display: block;
    font-weight: 600;
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
  }

  .tab-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    width: 0%;
    background: linear-gradient(90deg, var(--blue), var(--purple));
    transition: width 0.1s linear;
  }

  .tab-btn.active .tab-progress {
    animation: progressBar 5s linear;
  }

  @keyframes progressBar {
    from { width: 0%; }
    to { width: 100%; }
  }

  /* Content panels */
  .showcase-content {
    position: relative;
    min-height: 500px;
  }

  .showcase-panel {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    transform: translateY(20px);
  }

  .showcase-panel.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    position: relative;
  }

  .panel-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 32px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  }

  .panel-text h3 {
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 0.5rem;
    line-height: 1.2;
  }

  .tagline {
    font-size: 1.25rem;
    color: var(--yellow);
    margin-bottom: 1.5rem;
    font-weight: 600;
  }

  .description {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.9;
    margin-bottom: 2rem;
  }

  .feature-bullets {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .feature-bullets li {
    font-size: 1.05rem;
    color: rgba(255, 255, 255, 0.8);
    padding-left: 0;
  }

  /* Feature Badges with Glow */
  .feature-badges {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .feature-badge {
    display: inline-block;
    padding: 1rem 1.5rem;
    background: rgba(74, 144, 226, 0.15);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(74, 144, 226, 0.4);
    border-radius: 50px;
    font-size: 1.05rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 20px rgba(74, 144, 226, 0.3);
    animation: badgeBreathe 3s ease-in-out infinite;
    position: relative;
    overflow: hidden;
  }

  .feature-badge::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.15), transparent);
    transform: translateX(-100%);
    animation: shimmer 3s ease-in-out infinite;
  }

  .feature-badge:nth-child(1) {
    animation-delay: 0s;
  }

  .feature-badge:nth-child(2) {
    animation-delay: 1s;
    border-color: rgba(255, 209, 102, 0.4);
    background: rgba(255, 209, 102, 0.15);
    box-shadow: 0 4px 20px rgba(255, 209, 102, 0.3);
  }

  .feature-badge:nth-child(3) {
    animation-delay: 2s;
    border-color: rgba(139, 92, 246, 0.4);
    background: rgba(139, 92, 246, 0.15);
    box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
  }

  @keyframes badgeBreathe {
    0%, 100% {
      transform: scale(1);
      box-shadow: 0 4px 20px rgba(74, 144, 226, 0.3);
    }
    50% {
      transform: scale(1.02);
      box-shadow: 0 8px 30px rgba(74, 144, 226, 0.5);
    }
  }

  @keyframes shimmer {
    0% {
      transform: translateX(-100%);
    }
    50%, 100% {
      transform: translateX(200%);
    }
  }

  /* Visual mockups */
  .panel-visual {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .visual-mockup {
    width: 100%;
    max-width: 450px;
    position: relative;
  }

  /* Mockup 1: Module Card */
  .mockup-screen {
    background: rgba(10, 11, 30, 0.8);
    border: 2px solid rgba(74, 144, 226, 0.3);
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
  }

  .module-card-preview {
    display: flex;
    gap: 1.5rem;
    align-items: center;
    animation: cardFloat 3s ease-in-out infinite;
  }

  @keyframes cardFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }

  .module-icon-big {
    font-size: 5rem;
    filter: drop-shadow(0 8px 20px rgba(74, 144, 226, 0.5));
  }

  .module-info {
    flex: 1;
  }

  .info-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .info-bar {
    margin-bottom: 0.75rem;
  }

  .info-bar span {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
    display: block;
    margin-bottom: 0.35rem;
  }

  .bar {
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    overflow: hidden;
  }

  .fill {
    height: 100%;
    background: linear-gradient(90deg, var(--blue), var(--purple));
    border-radius: 10px;
    animation: fillBar 2s ease-out;
  }

  @keyframes fillBar {
    from { width: 0%; }
  }

  /* Mockup 2: Floating Modules */
  .mockup-modules {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .floating-module {
    position: absolute;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
  }

  .floating-module span {
    font-size: 3rem;
    display: block;
    margin-bottom: 0.5rem;
  }

  .module-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
  }

  .floating-module.m1 {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: float1 4s ease-in-out infinite;
    z-index: 3;
  }

  .floating-module.m2 {
    top: 10%;
    right: 10%;
    animation: float2 5s ease-in-out infinite;
  }

  .floating-module.m3 {
    bottom: 15%;
    left: 5%;
    animation: float3 6s ease-in-out infinite;
  }

  @keyframes float1 {
    0%, 100% { transform: translate(-50%, -50%) rotate(0deg); }
    50% { transform: translate(-50%, -60%) rotate(5deg); }
  }

  @keyframes float2 {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(-5deg); }
  }

  @keyframes float3 {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
  }

  /* Mockup 3: Grid Editor */
  .grid-preview {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    background: rgba(10, 11, 30, 0.8);
    border: 2px solid rgba(74, 144, 226, 0.3);
    border-radius: 24px;
    padding: 2rem;
    position: relative;
  }

  .grid-cell {
    aspect-ratio: 1;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    transition: all 0.3s;
  }

  .grid-cell.filled {
    background: rgba(74, 144, 226, 0.2);
    border-color: rgba(74, 144, 226, 0.5);
    animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  /* Módulos 2x2 - ocupan 2 columnas y 2 filas */
  .module-2x2 {
    grid-column: span 2;
    grid-row: span 2;
    background: rgba(255, 209, 102, 0.25);
    border-color: rgba(255, 209, 102, 0.6);
    border-width: 2px;
    font-size: 3.5rem;
    animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  .module-2x2-green {
    grid-column: span 2;
    grid-row: span 2;
    background: rgba(90, 211, 156, 0.25);
    border-color: rgba(90, 211, 156, 0.6);
    border-width: 2px;
    font-size: 3.5rem;
    animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  @keyframes popIn {
    0% { transform: scale(0) rotate(-10deg); }
    100% { transform: scale(1) rotate(0deg); }
  }

  .drag-cursor {
    position: absolute;
    font-size: 2.5rem;
    top: 30%;
    left: 40%;
    animation: dragMotion 3s ease-in-out infinite;
    filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.5));
  }

  @keyframes dragMotion {
    0%, 100% { transform: translate(0, 0); }
    25% { transform: translate(-10px, -10px); }
    50% { transform: translate(20px, 10px); }
    75% { transform: translate(10px, -5px); }
  }

  /* Mobile responsiveness */
  @media (max-width: 1024px) {
    .panel-split {
      grid-template-columns: 1fr;
      gap: 2rem;
      padding: 2rem;
    }

    .panel-text h3 {
      font-size: 2rem;
    }

    .panel-visual {
      order: -1;
    }

    .visual-mockup {
      max-width: 100%;
    }

    .showcase-tabs {
      gap: 0.75rem;
    }

    .tab-btn {
      min-width: 150px;
      padding: 1.25rem 1rem;
    }

    .tab-icon {
      font-size: 1.5rem;
    }

    .tab-label {
      font-size: 0.9rem;
    }
  }

  /* Wizard Timeline */
  .wizard-timeline {
    display: flex;
    align-items: flex-start;
    gap: 2rem;
    margin-bottom: 4rem;
    flex-wrap: wrap;
    justify-content: center;
  }

  .wizard-step {
    flex: 1;
    min-width: 220px;
    max-width: 280px;
    position: relative;
  }

  .step-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0 auto 1.5rem;
    box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4);
    position: relative;
    z-index: 2;
  }

  .step-content {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 2rem 1.5rem;
    border-radius: 24px;
    text-align: center;
    transition: all 0.3s;
  }

  .step-content:hover {
    transform: translateY(-8px);
    border-color: rgba(255, 255, 255, 0.15);
    background: rgba(255, 255, 255, 0.04);
  }

  .step-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
  }

  .step-content h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
  }

  .step-content p {
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.7;
    font-size: 0.95rem;
  }

  .wizard-connector {
    font-size: 2rem;
    color: var(--blue);
    align-self: center;
    margin-top: 2rem;
    animation: pulse 2s ease-in-out infinite;
  }

  .wizard-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
  }

  .wizard-feature-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s;
  }

  .wizard-feature-card:hover {
    transform: translateY(-5px);
    border-color: rgba(255, 255, 255, 0.1);
  }

  .wizard-feature-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }

  .wizard-feature-card h4 {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
  }

  .wizard-feature-card p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
  }

  /* Score Mystery Box */
  .score-mystery {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(74, 144, 226, 0.05));
    backdrop-filter: blur(30px);
    border: 1px solid rgba(139, 92, 246, 0.3);
    padding: 3rem;
    border-radius: 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .score-mystery::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.15), transparent 60%);
    animation: mysteryPulse 4s ease-in-out infinite;
  }

  @keyframes mysteryPulse {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.05); }
  }

  .mystery-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    animation: float 3s ease-in-out infinite;
  }

  .score-mystery h3 {
    font-size: 1.75rem;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
  }

  .score-mystery p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.05rem;
    line-height: 1.8;
    max-width: 700px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  @media (max-width: 768px) {
    .wizard-connector {
      display: none;
    }

    .wizard-timeline {
      flex-direction: column;
    }

    .wizard-step {
      max-width: 100%;
    }
  }

  /* Specs Section */
  .specs-section {
    padding: 8rem 2rem;
    background: rgba(10, 11, 30, 0.5);
    position: relative;
    z-index: 10;
  }

  .specs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 4rem;
  }

  .spec-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 20px;
    transition: all 0.3s;
  }

  .spec-card:hover {
    transform: translateY(-5px);
    border-color: rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.04);
  }

  .spec-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }

  .spec-card h4 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
  }

  .spec-weight {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(255, 209, 102, 0.15);
    border: 1px solid rgba(255, 209, 102, 0.3);
    border-radius: 20px;
    font-size: 0.85rem;
    color: var(--yellow);
    margin-bottom: 1rem;
  }

  .spec-card p {
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.6;
    font-size: 0.95rem;
  }

  .score-formula {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 2.5rem;
    border-radius: 24px;
    text-align: center;
  }

  .score-formula h3 {
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
  }

  .formula-box {
    background: rgba(10, 11, 30, 0.6);
    border: 1px solid rgba(74, 144, 226, 0.3);
    padding: 1.5rem;
    border-radius: 16px;
    margin-bottom: 1rem;
  }

  .formula-box code {
    color: var(--blue);
    font-family: 'Courier New', monospace;
    font-size: 1rem;
    line-height: 1.8;
  }

  .formula-note {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.9rem;
    margin-top: 1rem;
  }

  /* AI Section */
  .ai-section {
    padding: 8rem 2rem;
    position: relative;
    z-index: 10;
  }

  .ai-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
  }

  .ai-visual {
    position: relative;
  }

  .ai-avatar {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    position: relative;
    animation: float 4s ease-in-out infinite;
  }

  .ai-glow {
    position: absolute;
    inset: -20px;
    background: radial-gradient(circle, rgba(74, 144, 226, 0.3), transparent);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
  }

  .ai-icon {
    font-size: 5rem;
    position: relative;
    z-index: 1;
  }

  .ai-messages {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .ai-message, .ai-response {
    padding: 1rem 1.25rem;
    border-radius: 20px;
    max-width: 80%;
    animation: slideIn 0.5s ease-out;
  }

  .ai-message {
    background: rgba(255, 209, 102, 0.15);
    border: 1px solid rgba(255, 209, 102, 0.3);
    margin-left: auto;
    text-align: right;
  }

  .ai-response {
    background: rgba(74, 144, 226, 0.15);
    border: 1px solid rgba(74, 144, 226, 0.3);
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .ai-text h2 {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
  }

  .ai-text p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.8;
    margin-bottom: 2rem;
  }

  .ai-features {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .ai-features li {
    padding: 0.75rem 0;
    font-size: 1.05rem;
    color: rgba(255, 255, 255, 0.8);
    border-left: 3px solid var(--blue);
    padding-left: 1rem;
  }

  /* Ranking Section */
  .ranking-section {
    padding: 8rem 2rem;
    background: rgba(10, 11, 30, 0.5);
    position: relative;
    z-index: 10;
  }

  .ranking-showcase {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
  }

  .ranking-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 24px;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
    
  }

  .ranking-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--yellow), var(--blue));
    opacity: 0;
    transition: opacity 0.3s;
  }

  .ranking-card:hover {
    transform: translateY(-8px);
    border-color: rgba(255, 255, 255, 0.15);
  }

  .ranking-card:hover::before {
    opacity: 1;
  }

  .rank-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    font-weight: bold;
    font-size: 1rem;
    color: #fff;
  }

  .rank-badge.gold {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-color: #FFD700;
    color: #000;
  }

  .rank-badge.silver {
    background: linear-gradient(135deg, #C0C0C0, #A9A9A9);
    border-color: #C0C0C0;
    color: #000;
  }

  .rank-badge.bronze {
    background: linear-gradient(135deg, #CD7F32, #B87333);
    border-color: #CD7F32;
    color: #fff;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
  }

  .score-value {
    font-size: 1.2rem;
    font-weight: bold;
    background: linear-gradient(135deg, var(--yellow), var(--blue));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .score-stars {
    font-size: 0.8rem;
    opacity: 0.8;
  }

  /* Responsive: colapsa a layout vertical en móviles */
  @media (max-width: 768px) {
    .table-row {
      grid-template-columns: 60px 1fr 90px !important;
      gap: 0.5rem;
      padding: 0.75rem;
    }
    
    .habitat-column {
      grid-column: 2 / 3;
      grid-row: 2;
      font-size: 0.9rem;
      margin-top: 0.25rem;
    }
    
    .score-column {
      grid-row: 1;
    }
    
    .user-column {
      grid-row: 1;
    }
  }

  .habitat-stats {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
  }

  .habitat-author {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.9rem;
  }

  .ranking-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
  }

  .ranking-feature {
    background: rgba(255, 255, 255, 0.02);
    padding: 2rem;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.05);
  }

  .ranking-feature h4 {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
  }

  .ranking-feature p {
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.7;
  }

  /* Profile Section */
  .profile-section {
    padding: 8rem 2rem;
    position: relative;
    z-index: 10;
  }

  .profile-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
  }

  .profile-text h2 {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
  }

  .profile-text p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.8;
    margin-bottom: 2.5rem;
  }

  .profile-features {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .profile-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
  }

  .profile-item-icon {
    font-size: 2rem;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .profile-item h4 {
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
  }

  .profile-item p {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
  }

  .profile-mockup {
    position: relative;
  }

  .mockup-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 2.5rem;
    border-radius: 28px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
  }

  .mockup-header {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid rgba(255,  255, 255, 0.1);
  }

  .mockup-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.5rem;
    color: var(--navy);
  }

  .mockup-name {
    font-size: 1.25rem;
    font-weight: 700;
  }

  .mockup-level {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
  }

  .mockup-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
  }

  .stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.05);
  }

  .stat-number {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.5);
    margin-top: 0.25rem;
  }

  .mockup-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
  }

  /* Mobile responsiveness for new sections */
  @media (max-width: 1024px) {
    .ai-content,
    .profile-content {
      grid-template-columns: 1fr;
      gap: 3rem;
    }

    .ai-visual {
      order: -1;
    }
  }

  /* CTA Section */
  .cta {
    padding: 8rem 2rem;
    position: relative;
    z-index: 10;
  }

  .cta-container {
    max-width: 900px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 40px;
    padding: 5rem 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
  }

  .cta-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 209, 102, 0.2), transparent);
    filter: blur(60px);
  }

  .cta h2 {
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
    position: relative;
  }

  .cta p {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 3rem;
    position: relative;
  }

  /* Mobile */
  .mobile-menu-btn {
    display: none;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 8px 12px;
    color: #fff;
    cursor: pointer;
    font-size: 1.2rem;
  }

  @media (max-width: 1024px) {
    .hero-container {
      grid-template-columns: 1fr;
      text-align: center;
      gap: 3rem;
    }

    .hero-content h1 {
      font-size: 3rem;
    }

    .hero-buttons {
      justify-content: center;
    }

    .stats-float {
      display: none;
    }

    nav {
      left: 20px;
      right: 20px;
      transform: none;
    }

    .nav-links {
      display: none;
    }

    .mobile-menu-btn {
      display: block;
    }
  }

  @media (max-width: 768px) {
    .hero-content h1 {
      font-size: 2.5rem;
    }

    .features-grid {
      grid-template-columns: 1fr;
    }

    .section-header h2 {
      font-size: 2rem;
    }

    .cta h2 {
      font-size: 2rem;
    }
  }

  /* Estilos para la tabla de puntuaciones - Grid Layout Corregido */
  .scores-table-container {
    width: 100%;
    height: 100%;
    padding: 2rem;
    display: flex;
    flex-direction: column;
  }

  .table-header {
    text-align: center;
    margin-bottom: 2rem;
  }

  .table-header h3 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, var(--yellow), var(--blue));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .table-header p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1rem;
  }

  .scores-table {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    flex: 1;
  }

  /* Grid fijo de 4 columnas - CORREGIDO */
  .table-row {
    display: grid !important;
    grid-template-columns: 80px 1.2fr 1.4fr 110px !important;
    gap: 12px;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    align-items: center;
  }

  .table-header-row {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.2), rgba(139, 92, 246, 0.2));
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
  }

  .table-row:hover:not(.table-header-row) {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(74, 144, 226, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(74, 144, 226, 0.15);
  }

  /* Alineación específica por columna */
  .rank-column {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .user-column {
    display: flex;
    align-items: center;
  }

  .habitat-column {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: rgba(255, 255, 255, 0.8);
    font-style: italic;
  }

  .score-column {
    text-align: right;
    display: grid;
    justify-items: end;
    gap: 0.25rem;
  }

  /* ...existing code... */

  .rank-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    font-weight: bold;
    font-size: 1rem;
    color: #fff;
  }

  .rank-badge.gold {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-color: #FFD700;
    color: #000;
  }

  .rank-badge.silver {
    background: linear-gradient(135deg, #C0C0C0, #A9A9A9);
    border-color: #C0C0C0;
    color: #000;
  }

  .rank-badge.bronze {
    background: linear-gradient(135deg, #CD7F32, #B87333);
    border-color: #CD7F32;
    color: #fff;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
  }

  .score-value {
    font-size: 1.2rem;
    font-weight: bold;
    background: linear-gradient(135deg, var(--yellow), var(--blue));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .score-stars {
    font-size: 0.8rem;
    opacity: 0.8;
  }

  /* Responsive: colapsa a layout vertical en móviles */
  @media (max-width: 768px) {
    .table-row {
      grid-template-columns: 60px 1fr 90px !important;
      gap: 0.5rem;
      padding: 0.75rem;
    }
    
    .habitat-column {
      grid-column: 2 / 3;
      grid-row: 2;
      font-size: 0.9rem;
      margin-top: 0.25rem;
    }
    
    .score-column {
      grid-row: 1;
    }
    
    .user-column {
      grid-row: 1;
    }
  }

  .habitat-stats {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
  }

  .habitat-author {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.9rem;
  }

  .ranking-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
  }

  .ranking-feature {
    background: rgba(255, 255, 255, 0.02);
    padding: 2rem;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.05);
  }

  .ranking-feature h4 {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
  }

  .ranking-feature p {
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.7;
  }

  /* Profile Section */
  .profile-section {
    padding: 8rem 2rem;
    position: relative;
    z-index: 10;
  }

  .profile-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
  }

  .profile-text h2 {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
  }

  .profile-text p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.8;
    margin-bottom: 2.5rem;
  }

  .profile-features {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .profile-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
  }

  .profile-item-icon {
    font-size: 2rem;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .profile-item h4 {
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
  }

  .profile-item p {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
  }

  .profile-mockup {
    position: relative;
  }

  .mockup-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 2.5rem;
    border-radius: 28px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
  }

  .mockup-header {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  .mockup-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--yellow), #FFB84D);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.5rem;
    color: var(--navy);
  }

  .mockup-name {
    font-size: 1.25rem;
    font-weight: 700;
  }

  .mockup-level {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
  }

  .mockup-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
  }

  .stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.05);
  }

  .stat-number {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.5);
    margin-top: 0.25rem;
  }

  .mockup-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
  }

  /* Mobile responsiveness for new sections */
  @media (max-width: 1024px) {
    .ai-content,
    .profile-content {
      grid-template-columns: 1fr;
      gap: 3rem;
    }

    .ai-visual {
      order: -1;
    }
  }

  /* CTA Section */
  .cta {
    padding: 8rem 2rem;
    position: relative;
    z-index: 10;
  }

  .cta-container {
    max-width: 900px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 40px;
    padding: 5rem 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
  }

  .cta-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 209, 102, 0.2), transparent);
    filter: blur(60px);
  }

  .cta h2 {
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
    position: relative;
  }

  .cta p {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 3rem;
    position: relative;
  }

  /* Mobile */
  .mobile-menu-btn {
    display: none;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 8px 12px;
    color: #fff;
    cursor: pointer;
    font-size: 1.2rem;
  }

  @media (max-width: 1024px) {
    .hero-container {
      grid-template-columns: 1fr;
      text-align: center;
      gap: 3rem;
    }

    .hero-content h1 {
      font-size: 3rem;
    }

    .hero-buttons {
      justify-content: center;
    }

    .stats-float {
      display: none;
    }

    nav {
      left: 20px;
      right: 20px;
      transform: none;
    }

    .nav-links {
      display: none;
    }

    .mobile-menu-btn {
      display: block;
    }
  }

  @media (max-width: 768px) {
    .hero-content h1 {
      font-size: 2.5rem;
    }

    .features-grid {
      grid-template-columns: 1fr;
    }

    .section-header h2 {
      font-size: 2rem;
    }

    .cta h2 {
      font-size: 2rem;
    }
  }
</style>
</head>
<body id="top">
  <!-- Animated Background -->
  <div class="bg-gradient"></div>
  <div class="bg-grid"></div>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  <!-- Navigation -->
  <nav>
    <div class="nav-container">
      <a href="#top" class="logo" onclick="scrollToTop()">
        <!-- <div class="logo-icon">🏠</div> -->
        <span>SpaceCrafter</span>
      </a>
      <div class="nav-links">
        <a href="#features">Features</a>
        <a href="https://github.com/Marcos03BR/NASA-Space-Apps-Challenge-2025" target="_blank">GitHub</a>
        <a href="/modules/habitat/demo.php" class="btn btn-secondary">Try Now</a>
        <a href="/login" class="btn btn-primary">Login</a>
      </div>
      <button class="mobile-menu-btn" onclick="alert('Menú móvil - implementar drawer aquí')">☰</button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-container">
      <div class="hero-content">
        <!-- <div class="badge">Diseño espacial educativo</div> -->
        <h1>
          Build your own<br>
          <span class="gradient-text">space habitat</span>
        </h1>
        <p>
          Learn space habitat design interactively.
          Experiment, create, and discover while having fun.
        </p>
        <div class="hero-buttons">
          <a href="/demo" class="btn btn-hero btn-glow">Try Now</a>
          <a href="/login" class="btn btn-hero btn-primary">Login</a>
        </div>
      </div>
      
      <div class="hero-visual">
        <div class="glass-card">
          <div class="habitat-3d">
            <!-- Bloque compacto SIN solapamientos -->
            
            <!-- Fila 1 (arriba) -->
            <div class="module-3d module-power size-1x1" style="grid-column: 1; grid-row: 1;">
              <img src="/modules/habitat/assets/img/home/docking_logistics.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            <div class="module-3d module-power size-1x1" style="grid-column: 3; grid-row: 1;">
              <img src="/modules/habitat/assets/img/home/waste_hygiene.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            <div class="module-3d module-power size-1x1" style="grid-column: 6; grid-row: 1;">
              <img src="/modules/habitat/assets/img/home/science_lab.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            <!-- Fila 2 -->
            <div class="module-3d module-garden size-1x1" style="grid-column: 1; grid-row: 2;">
              <img src="/modules/habitat/assets/img/home/supply_storage.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            
            <!-- Centro masivo 4x4: columnas 2-5, filas 2-5 -->
            <div id="central-module" class="module-3d module-living size-4x4" style="grid-column: 2 / 6; grid-row: 2 / 6;">
              <img src="/modules/habitat/assets/img/home/airlock.webp" style="width: 200px; height: 200px; object-fit: contain;">
            </div>
           
            <!-- Lateral derecho -->
            <div class="module-3d module-lab size-2x2" style="grid-column: 6 / 8; grid-row: 2 / 4;">
              <img src="/modules/habitat/assets/img/home/galley.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            
            <!-- Fila 3 lateral -->
            <div class="module-3d module-living size-2x2" style="grid-column: 6 / 8; grid-row: 4 / 6;">
              <img src="/modules/habitat/assets/img/home/core_hub.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            
            <!-- Fila 5 lateral -->
            <div class="module-3d module-power size-1x1" style="grid-column: 1; grid-row: 5;">
              <img src="/modules/habitat/assets/img/home/robotic_arm.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            
            <!-- Fila 6 (abajo del centro) -->
            <div class="module-3d module-garden size-2x2" style="grid-column: 2 / 4; grid-row: 6 / 8;">
              <img src="/modules/habitat/assets/img/home/comms_mission.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            <div class="module-3d module-lab size-2x2" style="grid-column: 5 / 7; grid-row: 6 / 8;">
              <img src="/modules/habitat/assets/img/home/power.webp" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
          </div>
        </div>
        
        <div class="stats-float stats-float-1">
          <div class="stat-value">250+</div>
          <div class="stat-label">Created layouts</div>
        </div>
        
        <div class="stats-float stats-float-2">
          <div class="stat-value">20</div>
          <div class="stat-label">Available modules</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Auto-rotating Features Showcase -->
  <section class="features" id="features">
    <div class="features-container">
      <div class="section-header">
        <!-- <span class="section-badge">✨ Lo Mejor de la Plataforma</span> -->
        <h2>Designing has never been so easy</h2>
        <p>Three reasons why you'll love it</p>
      </div>
      
      <div class="showcase-wrapper">
        <!-- Tab indicators -->
        <div class="showcase-tabs">
          <button class="tab-btn active" data-tab="0">
            <span class="tab-icon">🎮</span>
            <span class="tab-label">Learn by Playing</span>
            <div class="tab-progress"></div>
          </button>
          <button class="tab-btn" data-tab="1">
            <span class="tab-icon">🚀</span>
            <span class="tab-label">Real Modules</span>
            <div class="tab-progress"></div>
          </button>
          <button class="tab-btn" data-tab="2">
            <span class="tab-icon">🎨</span>
            <span class="tab-label">Visual Editor</span>
            <div class="tab-progress"></div>
          </button>
        </div>

        <!-- Content panels -->
        <div class="showcase-content">
          <!-- Panel 1: Aprende Jugando -->
          <div class="showcase-panel active" data-panel="0">
            <div class="panel-split">
              <div class="panel-text">
                <h3>Learn without realizing it</h3>
                <p class="tagline">Because studying can be addictive</p>
                <p class="description">
                  No boring theory. Here you learn by designing, experimenting, and 
                  seeing instant results. Each module you place comes with real info 
                  on how it works, why it's used, and where it goes. 
                  It's like playing SimCity but learning real space physics.
                </p>
                <div class="feature-badges">
                  <span class="feature-badge">Real technical information from NASA and ESA</span>
                  <span class="feature-badge">Challenges that unlock concepts</span>
                  <span class="feature-badge">Learn by doing, not by reading</span>
                </div>
              </div>
              <div class="panel-visual">
                <div class="visual-mockup mockup-1">
                  <div class="mockup-screen">
                    <div class="module-card-preview">
                      <div class="module-icon-big">
                        <img src="/modules/habitat/assets/img/home/science_lab.webp" style="width: 130px; height: 130px; object-fit: contain;">
                      </div>
                      <div class="module-info">
                        <div class="info-title">Science Laboratory</div>
                        <div class="info-bar">
                          <span>Funcionality</span>
                          <div class="bar"><div class="fill" style="width: 75%"></div></div>
                        </div>
                        <div class="info-bar">
                          <span>Efficiency</span>
                          <div class="bar"><div class="fill" style="width: 60%"></div></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Panel 2: Módulos Reales -->
          <div class="showcase-panel" data-panel="1">
            <div class="panel-split">
              <div class="panel-text">
                <h3>Based on real stations</h3>
                <p class="tagline">We don't invent anything, everything is real.</p>
                <p class="description">
                  Each module is based on ISS designs, NASA proposals, 
                  and real missions. The data is not random: dimensions, weights, costs, 
                  and technical specifications are those used by real engineers. 
                  Your habitat could be built tomorrow.
                </p>
                <div class="feature-badges">
                  <span class="feature-badge">20 real mission modules</span>
                  <span class="feature-badge">Authentic technical specifications</span>
                  <!-- <span class="feature-badge">🌍 Validados por agencias espaciales</span> -->
                </div>
              </div>
              <div class="panel-visual">
                <div class="visual-mockup mockup-2">
                  <div class="mockup-modules">
                    <div class="floating-module m1">
                      <img src="/modules/habitat/assets/img/home/airlock.webp" style="width: 100px; height: 100px; object-fit: contain;">
                    </div>
                    <div class="floating-module m2">
                      <img src="/modules/habitat/assets/img/home/comms_mission.webp" style="width: 100px; height: 100px; object-fit: contain;">
                    </div>
                    <div class="floating-module m3">
                      <img src="/modules/habitat/assets/img/home/medical.webp" style="width: 100px; height: 100px; object-fit: contain;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Panel 3: Editor Visual -->
          <div class="showcase-panel" data-panel="2">
            <div class="panel-split">
              <div class="panel-text">
                <h3>As easy as Tetris</h3>
                <p class="tagline">If you know how to drag, you know how to design.</p>
                <p class="description">
                  Zero learning curve. Drag a module, drop it on the grid, 
                  done. Change the size with a click. Move everything around if you don't like it. 
                  The system tells you instantly if your design works or what's missing. 
                  It's so intuitive that even your grandmother could design a space habitat.
                </p>
                <div class="feature-badges">
                  <span class="feature-badge">🖱️ Super smooth drag & drop</span>
                  <span class="feature-badge">📐 Instant resize  (1x1, 2x2, 4x4)</span>
                  <span class="feature-badge">⚡ Real-time feedback</span>
                </div>
              </div>
              <div class="panel-visual">
                <div class="visual-mockup mockup-3">
                  <div class="grid-preview">
                    <!-- Fila 1 -->
                    <div class="grid-cell"></div>
                    <div class="grid-cell"></div>
                    <div class="grid-cell module-2x2">
                      <img src="/modules/habitat/assets/img/home/medical.webp" style="width: 100px; height: 100px; object-fit: contain;">
                    </div>
                    <div class="grid-cell"></div>
                    
                    <!-- Fila 2 -->
                    <div class="grid-cell filled">
                      <img src="/modules/habitat/assets/img/home/plant_growth.webp" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <div class="grid-cell filled">
                      <img src="/modules/habitat/assets/img/home/exercise.webp" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <div class="grid-cell"></div>
                    
                    <!-- Fila 3 -->
                    <div class="grid-cell filled">
                      <img src="/modules/habitat/assets/img/home/robotic_arm.webp" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <div class="grid-cell"></div>
                    <div class="grid-cell module-2x2-green">
                      <img src="/modules/habitat/assets/img/home/life_support.webp" style="width: 100px; height: 100px; object-fit: contain;">
                    </div>
                    <div class="grid-cell"></div>
                    
                    <!-- Fila 4 -->
                    <div class="grid-cell"></div>
                    <div class="grid-cell"></div>
                    <div class="grid-cell"></div>
                  </div>
                  <div class="drag-cursor">👆</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Technical Specifications Section -->
  <section class="specs-section">
    <div class="features-container">
      <div class="section-header">
        <!-- <span class="section-badge">📊 Sistema de Evaluación</span> -->
        <h2>Technical Specifications</h2>
        <p>Each module is evaluated using real metrics to teach you what makes a space habitat work.</p>
      </div>

      <div class="specs-grid">
        <div class="spec-card">
          <div class="spec-icon">⚙️</div>
          <h4>Functionality</h4>
          <div class="spec-weight">Rating: 25%</div>
          <p>Purpose of the module and integration with other systems. Includes redundancy and critical functions.</p>
        </div>

        <div class="spec-card">
          <div class="spec-icon">⚖️</div>
          <h4>Weight</h4>
          <div class="spec-weight">Rating: 5%</div>
          <p>Total mass and its impact on launch, deployment, and structural considerations.</p>
        </div>

        <div class="spec-card">
          <div class="spec-icon">💰</div>
          <h4>Cost</h4>
          <div class="spec-weight">Rating: 10%</div>
          <p>Estimated cost of manufacturing, deployment, and maintenance with cost-benefit ratio.</p>
        </div>

        <div class="spec-card">
          <div class="spec-icon">⚡</div>
          <h4>Efficiency</h4>
          <div class="spec-weight">Rating: 20%</div>
          <p>Effective use of space, energy, and resources. Optimization of layout and workflow.</p>
        </div>

        <div class="spec-card">
          <div class="spec-icon">👤</div>
          <h4>Ergonomics</h4>
          <div class="spec-weight">Rating: 15%</div>
          <p>Comfort and usability for the crew, accessibility of equipment, and user-friendly design.</p>
        </div>
      </div>

      <!-- <div class="score-mystery">
        <div class="mystery-icon">🔮</div>
        <h3>Algoritmo Propietario</h3>
        <p>Nuestro sistema combina estas métricas de forma inteligente para darte una puntuación final. 
        A medida que diseñes más hábitats, aprenderás qué factores son más importantes para crear 
        estaciones espaciales viables y eficientes.</p>
      </div> -->
    </div>
  </section>

  <!-- AI Assistant Section -->
  <section class="ai-section">
    <div class="features-container">
      <div class="ai-content">
        <div class="ai-visual">
          <div class="ai-avatar">
            <div class="ai-glow"></div>
            <div class="ai-icon">🤖</div>
          </div>
          <div class="ai-messages">
            <div class="ai-message">Where do I place the life support module?</div>
            <div class="ai-response">I recommend near the central core to facilitate oxygen distribution...</div>
          </div>
        </div>
        
        <div class="ai-text">
          <!-- <span class="section-badge">🧠 Inteligencia Artificial</span> -->
          <h2>Your Personal Assistant</h2>
          <p>
            Our AI assistant guides you in real time as you design your space habitat. 
            Learn about optimal module placement, efficient connections, life support systems, 
            and much more.
          </p>
          <ul class="ai-features">
            <li>💬 Instant answers to your questions</li>
            <li>📍 Location suggestions based on best practices</li>
            <li>⚠️ Design issue alerts</li>
            <li>🎓 Educational explanations for each module</li>
            <li>🔧 Automatic optimization of your layout</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

<!-- Profile Section -->
  <section class="profile-section">
    <div class="features-container">
      <div class="profile-content">
        <div class="profile-text">
          <!-- <span class="section-badge">👤 Tu Espacio</span> -->
          <h2>Personal profile</h2>
          <p>
            Manage all your habitats from one place. Save drafts, 
            share your best designs, and track your learning progress.
          </p>
          <div class="profile-features">
            <div class="profile-item">
              <div class="profile-item-icon">💾</div>
              <div>
                <h4>Save your designs</h4>
                <p>Store unlimited habitats and pick up where you left off</p>
              </div>
            </div>
            <div class="profile-item">
              <div class="profile-item-icon">📊</div>
              <div>
                <h4>Statistics</h4>
                <p>See your progress, most used modules, and best scores</p>
              </div>
            </div>
            <div class="profile-item">
              <div class="profile-item-icon">🌟</div>
              <div>
                <h4>Achievements</h4>
                <p>Unlock badges by completing challenges and learning concepts.</p>
              </div>
            </div>
            <div class="profile-item">
              <div class="profile-item-icon">🔗</div>
              <div>
                <h4>Share</h4>
                <p>Export your designs or share them with the community</p>
              </div>
            </div>
          </div>
        </div>

        <div class="profile-mockup">
          <div class="mockup-card">
            <div class="mockup-header">
              <div class="mockup-avatar">JS</div>
              <div>
                <div class="mockup-name">Juan Sánchez</div>
                <div class="mockup-level">Level 8 • Space Architect</div>
              </div>
            </div>
            <div class="mockup-stats">
              <div class="stat-item">
                <div class="stat-number">12</div>
                <div class="stat-label">Habitats</div>
              </div>
              <div class="stat-item">
                <div class="stat-number">4.6</div>
                <div class="stat-label">Rating</div>
              </div>
              <div class="stat-item">
                <div class="stat-number">234</div>
                <div class="stat-label">Votes</div>
              </div>
            </div>
            <div class="mockup-badges">
              <span class="badge-pill">🏆 Top Contributor</span>
              <span class="badge-pill">🎓 Educator</span>
              <span class="badge-pill">⚡ Innovador</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Community Ranking Section -->
  <section class="ranking-section">
    <div class="features-container">
      <div class="section-header">
        <!-- <span class="section-badge">🏆 Comunidad</span> -->
        <h2>Habitat Rankings</h2>
        <p>Share your designs, vote for the best ones, and learn from the community.</p>
      </div>
      <div class="ranking-showcase">
        <div class="ranking-card rank-1">
          <div class="scores-table-container">
            <div class="table-header">
              <h3>🏆 Habitat Score Ranking</h3>
              <p>Top performers in our space habitat community</p>
            </div>
            <div class="scores-table">
              <div class="table-row table-header-row">
                <div class="rank-column">Rank</div>
                <div class="user-column">Commander</div>
                <div class="habitat-column">Habitat Name</div>
                <div class="score-column">Score</div>
              </div>
              
              <div class="table-row rank-gold">
                <div class="rank-column">
                  <div class="rank-badge gold">🥇 1</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">S</div>
                    <span>Stardust</span>
                  </div>
                </div>
                <div class="habitat-column">Cosmic Reef</div>
                <div class="score-column">
                  <div class="score-value">4.8</div>
                  <div class="score-stars">⭐⭐⭐⭐⭐</div>
                </div>
              </div>
              
              <div class="table-row rank-silver">
                <div class="rank-column">
                  <div class="rank-badge silver">🥈 2</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">V</div>
                    <span>Vortex</span>
                  </div>
                </div>
                <div class="habitat-column">Obsidian Shore</div>
                <div class="score-column">
                  <div class="score-value">4.5</div>
                  <div class="score-stars">⭐⭐⭐⭐⭐</div>
                </div>
              </div>
              
              <div class="table-row rank-bronze">
                <div class="rank-column">
                  <div class="rank-badge bronze">🥉 3</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">E</div>
                    <span>Echo</span>
                  </div>
                </div>
                <div class="habitat-column">Crystal Caves</div>
                <div class="score-column">
                  <div class="score-value">4.1</div>
                  <div class="score-stars">⭐⭐⭐⭐</div>
                </div>
              </div>
              
              <div class="table-row">
                <div class="rank-column">
                  <div class="rank-badge">4</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">M</div>
                    <span>Mirage</span>
                  </div>
                </div>
                <div class="habitat-column">Whispering Dune</div>
                <div class="score-column">
                  <div class="score-value">3.7</div>
                  <div class="score-stars">⭐⭐⭐⭐</div>
                </div>
              </div>
              
              <div class="table-row">
                <div class="rank-column">
                  <div class="rank-badge">5</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">B</div>
                    <span>Blaze</span>
                  </div>
                </div>
                <div class="habitat-column">Volcanic Plains</div>
                <div class="score-column">
                  <div class="score-value">3.3</div>
                  <div class="score-stars">⭐⭐⭐</div>
                </div>
              </div>
              
              <div class="table-row">
                <div class="rank-column">
                  <div class="rank-badge">6</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">S</div>
                    <span>Serenity</span>
                  </div>
                </div>
                <div class="habitat-column">Floating Gardens</div>
                <div class="score-column">
                  <div class="score-value">2.9</div>
                  <div class="score-stars">⭐⭐⭐</div>
                </div>
              </div>
              
              <div class="table-row">
                <div class="rank-column">
                  <div class="rank-badge">7</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">R</div>
                    <span>Rift</span>
                  </div>
                </div>
                <div class="habitat-column">Sunken City</div>
                <div class="score-column">
                  <div class="score-value">2.5</div>
                  <div class="score-stars">⭐⭐⭐</div>
                </div>
              </div>
              
              <div class="table-row">
                <div class="rank-column">
                  <div class="rank-badge">8</div>
                </div>
                <div class="user-column">
                  <div class="user-info">
                    <div class="user-avatar">N</div>
                    <span>Nomad</span>
                  </div>
                </div>
                <div class="habitat-column">Ethereal Forest</div>
                <div class="score-column">
                  <div class="score-value">1.8</div>
                  <div class="score-stars">⭐⭐</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta">
    <div class="cta-container">
      <h2>Begin your space adventure</h2>
      <p>Join hundreds of students exploring spatial design</p>
      <div class="hero-buttons" style="justify-content: center;">
        <a href="/demo" class="btn btn-hero btn-glow">Try Demo</a>
        <a href="/login" class="btn btn-hero btn-primary">Create Account</a>
      </div>
    </div>
  </section>

  <script>
    // Función para scroll suave al inicio
    function scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });

    // Mobile menu
    document.querySelector('.mobile-menu-btn')?.addEventListener('click', () => {
      alert('Menú móvil - implementar drawer aquí');
    });

    // Parallax effect on scroll
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const orbs = document.querySelectorAll('.orb');
      orbs.forEach((orb, i) => {
        orb.style.transform = `translateY(${scrolled * (0.1 + i * 0.05)}px)`;
      });
    });

    // Auto-rotating showcase
    const tabBtns = document.querySelectorAll('.tab-btn');
    const panels = document.querySelectorAll('.showcase-panel');
    let currentTab = 0;
    let autoRotateInterval;
    const ROTATION_TIME = 5000; // 5 seconds per tab

    function switchTab(index) {
      // Remove active from all
      tabBtns.forEach(btn => btn.classList.remove('active'));
      panels.forEach(panel => panel.classList.remove('active'));

      // Add active to selected
      tabBtns[index].classList.add('active');
      panels[index].classList.add('active');

      currentTab = index;
    }

    function nextTab() {
      const next = (currentTab + 1) % tabBtns.length;
      switchTab(next);
    }

    function startAutoRotate() {
      // Clear existing interval
      if (autoRotateInterval) {
        clearInterval(autoRotateInterval);
      }
      // Start new interval
      autoRotateInterval = setInterval(nextTab, ROTATION_TIME);
    }

    // Manual tab clicks
    tabBtns.forEach((btn, index) => {
      btn.addEventListener('click', () => {
        switchTab(index);
        startAutoRotate(); // Restart timer on manual click
      });
    });

    // Start auto-rotation on page load
    startAutoRotate();

    // Pause on hover (optional)
    const showcaseWrapper = document.querySelector('.showcase-wrapper');
    showcaseWrapper?.addEventListener('mouseenter', () => {
      if (autoRotateInterval) {
        clearInterval(autoRotateInterval);
      }
    });
    showcaseWrapper?.addEventListener('mouseleave', () => {
      startAutoRotate();
    });
  </script>
</body>
</html>
