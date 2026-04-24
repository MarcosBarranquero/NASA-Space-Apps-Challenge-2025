<?php /* /modules/habitat/demo.php */ ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Habitat Designer — Demo</title>
  <meta name="color-scheme" content="dark light" />

  <!-- Bootstrap (para los modals) + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <!-- MISMO CSS que habitat.php -->
  <link rel="stylesheet" href="/modules/habitat/assets/css/style.css">
  
  <!-- Estilos del menú de navegación -->
  <style>
    /* Navigation styles */
    nav {
      position: absolute;
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
      margin-bottom: 2rem;
      width: fit-content;
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
        width: calc(100% - 40px);
      }

      .nav-links {
        display: none;
      }

      .mobile-menu-btn {
        display: block;
      }
    }

    /* Fondo animado estilo onepage */
    .demo-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #0A0B1E;
      z-index: -1;
    }

    /* Fondo animado adicional */
    .bg-gradient {
      position: fixed;
      inset: 0;
      z-index: -1;
      background: radial-gradient(circle at 20% 50%, rgba(74, 144, 226, 0.15) 0%, transparent 50%),
                  radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                  radial-gradient(circle at 40% 80%, rgba(255, 209, 102, 0.1) 0%, transparent 50%),
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
      z-index: -1;
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
      z-index: -10;
      pointer-events: none;
    }

    .orb-1 {
      width: 400px;
      height: 400px;
      background: linear-gradient(135deg, #4A90E2, #8B5CF6);
      top: 10%;
      left: 10%;
      opacity: 0.2;
      z-index: -10;
      pointer-events: none;
    }

    .orb-2 {
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, #FFD166, #EC4899);
      bottom: 20%;
      right: 10%;
      opacity: 0.15;
      animation-delay: -4s;
      z-index: -10;
      pointer-events: none;
    }

    @keyframes float {
      0%, 100% { transform: translate(0, 0) scale(1); }
      33% { transform: translate(30px, -30px) scale(1.1); }
      66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    /* Estilos mejorados para paneles del designer */
    .designer {
      background: rgba(255, 255, 255, 0.02) !important;
      backdrop-filter: blur(20px) !important;
      border: 1px solid rgba(255, 255, 255, 0.05) !important;
      border-radius: 28px !important;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
      overflow: hidden !important;
    }

    .modules-panel, .info-panel {
      background: rgba(255, 255, 255, 0.02) !important;
      backdrop-filter: blur(15px) !important;
      border: 1px solid rgba(255, 255, 255, 0.08) !important;
      border-radius: 20px !important;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
    }

    .grid-area {
      background: rgba(255, 255, 255, 0.03) !important;
      backdrop-filter: blur(20px) !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      border-radius: 24px !important;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25) !important;
      position: relative !important;
    }

    .grid-area::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    }

    /* Mejoras para botones */
    .grid-controls button {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      border: none !important;
      border-radius: 12px !important;
      color: #fff !important;
      font-weight: 600 !important;
      padding: 0.75rem 1.5rem !important;
      box-shadow: 0 4px 15px rgba(74, 144, 226, 0.4) !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .grid-controls button:hover {
      transform: translateY(-2px) !important;
      box-shadow: 0 8px 25px rgba(74, 144, 226, 0.6) !important;
    }

    /* Estilos para títulos y textos */
    h2 {
      color: #fff !important;
      font-weight: 700 !important;
      margin-bottom: 1.5rem !important;
      background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
    }

    .stat-label {
      color: rgba(255, 255, 255, 0.6) !important;
      font-size: 0.9rem !important;
      font-weight: 500 !important;
    }

    .stat-value {
      color: #fff !important;
      font-weight: 700 !important;
      font-size: 1.1rem !important;
    }

    .list-title {
      color: rgba(255, 255, 255, 0.9) !important;
      font-weight: 600 !important;
    }

    /* Estilo para la grid del habitat */
    .habitat-grid {
      background: rgba(10, 11, 30, 0.3) !important;
      border: 1px solid rgba(74, 144, 226, 0.2) !important;
      border-radius: 16px !important;
      box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3) !important;
    }

    /* Estilos para modales */
    .modal-content {
      background: rgba(255, 255, 255, 0.03) !important;
      backdrop-filter: blur(30px) !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      border-radius: 24px !important;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4) !important;
    }

    .block-header {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      border-radius: 24px 24px 0 0 !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .block-content {
      background: rgba(255, 255, 255, 0.02) !important;
      color: rgba(255, 255, 255, 0.9) !important;
    }

    .mm-head {
      color: rgba(255, 255, 255, 0.9) !important;
      font-weight: 600 !important;
    }

    .mm-desc {
      color: rgba(255, 255, 255, 0.7) !important;
    }

    .btn-alt-primary {
      background: rgba(74, 144, 226, 0.15) !important;
      border: 1px solid rgba(74, 144, 226, 0.3) !important;
      color: rgba(255, 255, 255, 0.9) !important;
    }

    .btn-alt-primary:hover {
      background: rgba(74, 144, 226, 0.25) !important;
      border-color: rgba(74, 144, 226, 0.5) !important;
      color: #fff !important;
    }

    .btn-alt-danger {
      background: rgba(236, 72, 153, 0.15) !important;
      border: 1px solid rgba(236, 72, 153, 0.3) !important;
      color: rgba(255, 255, 255, 0.9) !important;
    }

    .btn-alt-danger:hover {
      background: rgba(236, 72, 153, 0.25) !important;
      border-color: rgba(236, 72, 153, 0.5) !important;
      color: #fff !important;
    }

    /* Estilos específicos para bloques de modales */
    .block {
      background: rgba(255, 255, 255, 0.03) !important;
      backdrop-filter: blur(30px) !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      border-radius: 24px !important;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4) !important;
      overflow: hidden !important;
    }

    .block-rounded {
      border-radius: 24px !important;
    }

    .block-header {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      border-radius: 24px 24px 0 0 !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
      padding: 1.5rem 2rem !important;
      position: relative !important;
    }

    .block-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .block-header.bg-primary {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
    }

    .block-title {
      color: #fff !important;
      font-weight: 700 !important;
      font-size: 1.25rem !important;
      margin: 0 !important;
    }

    .block-title.text-white {
      color: #fff !important;
    }

    .block-title.text-uppercase {
      text-transform: uppercase !important;
      letter-spacing: 0.5px !important;
    }

    .block-options .btn {
      background: rgba(255, 255, 255, 0.15) !important;
      border: 1px solid rgba(255, 255, 255, 0.25) !important;
      color: #fff !important;
      border-radius: 12px !important;
      padding: 0.5rem 1rem !important;
      font-size: 0.875rem !important;
      font-weight: 600 !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .block-options .btn:hover {
      background: rgba(255, 255, 255, 0.25) !important;
      border-color: rgba(255, 255, 255, 0.4) !important;
      transform: translateY(-1px) !important;
      color: #fff !important;
    }

    .block-options .btn-light {
      background: rgba(255, 255, 255, 0.15) !important;
      border-color: rgba(255, 255, 255, 0.25) !important;
      color: #fff !important;
    }

    .block-options .btn-light:hover {
      background: rgba(255, 255, 255, 0.25) !important;
      border-color: rgba(255, 255, 255, 0.4) !important;
      color: #fff !important;
    }

    /* Específico para el contenido del bloque */
    .block-content {
      background: rgba(255, 255, 255, 0.02) !important;
      color: rgba(255, 255, 255, 0.9) !important;
      padding: 2rem !important;
    }

    .block-content-full {
      background: rgba(255, 255, 255, 0.01) !important;
      border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
    }

    .bg-body {
      background: rgba(255, 255, 255, 0.01) !important;
    }

    /* Estilos para imágenes en modales */
    .mm-media-box {
      background: rgba(10, 11, 30, 0.4) !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      border-radius: 16px !important;
      padding: 1rem !important;
      overflow: hidden !important;
    }

    .mm-media-box img {
      border-radius: 12px !important;
      background: rgba(10, 11, 30, 0.6) !important;
      padding: 0.5rem !important;
      border: 1px solid rgba(74, 144, 226, 0.2) !important;
      filter: brightness(0.9) contrast(1.1) !important;
      transition: all 0.3s ease !important;
    }

    .mm-media-box img:hover {
      filter: brightness(1) contrast(1.2) !important;
      border-color: rgba(74, 144, 226, 0.4) !important;
    }

    /* Iconos en la caja de media */
    .mm-media-box span {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      color: #fff !important;
      border-radius: 12px !important;
      padding: 1rem !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 2rem !important;
      box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3) !important;
    }

    /* NO TOCAR LOS BOTONES DE CATEGORÍA - FUNCIONAN ORIGINALMENTE */

    /* Estilos sutiles para botones de categoría - SOLO MEJORAS VISUALES */
    #categoryList .category-btn {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.8);
      border-radius: 12px;
      font-weight: 500;
      transition: all 0.3s ease;
      margin: 0.25rem 0.125rem;
      backdrop-filter: blur(10px);
    }

    #categoryList .category-btn:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    #categoryList .category-btn.active {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6);
      border-color: rgba(74, 144, 226, 0.5);
      color: #fff;
      box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
    }

    #categoryList .category-btn.active:hover {
      box-shadow: 0 6px 20px rgba(74, 144, 226, 0.4);
    }

    /* Estilos para los módulos */
    #modulesList .module-item {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    #modulesList .module-item:hover {
      background: rgba(74, 144, 226, 0.15);
      border-color: rgba(74, 144, 226, 0.3);
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(74, 144, 226, 0.2);
    }

    /* Estilos para el FAB del chatbot - SOLO VISUAL */
    .ai-fab {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      border: 2px solid rgba(255, 255, 255, 0.15) !important;
      box-shadow: 0 8px 32px rgba(74, 144, 226, 0.4) !important;
      backdrop-filter: blur(20px) !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .ai-fab:hover {
      transform: translateY(-4px) scale(1.05) !important;
      box-shadow: 0 12px 40px rgba(74, 144, 226, 0.6) !important;
      border-color: rgba(255, 255, 255, 0.25) !important;
    }

    .ai-fab-icon {
      font-size: 1.5rem !important;
      animation: fabPulse 2s ease-in-out infinite !important;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3)) !important;
    }

    @keyframes fabPulse {
      0%, 100% { 
        transform: scale(1);
        opacity: 1;
      }
      50% { 
        transform: scale(1.1);
        opacity: 0.9;
      }
    }

    /* Corrección para block-transparent - SIN transparencia */
    .block-transparent {
      background: rgba(10, 11, 30, 0.95) !important;
      backdrop-filter: blur(30px) !important;
      border: 1px solid rgba(255, 255, 255, 0.3) !important;
    }

    .block-transparent .block-header {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      backdrop-filter: none !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
    }

    .block-transparent .block-content {
      background: rgba(15, 16, 35, 0.98) !important;
      backdrop-filter: none !important;
    }

    .block-transparent .block-title {
      color: #fff !important;
      text-shadow: none !important;
    }

    /* Estilos simplificados para elementos del panel de información */
    .info-panel h2 {
      color: rgba(255, 255, 255, 0.9) !important;
      font-size: 1.2rem !important;
      font-weight: 600 !important;
      margin-bottom: 15px !important;
      text-align: center !important;
    }

    .stat-item {
      background: rgba(255, 255, 255, 0.05) !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      border-radius: 8px !important;
      padding: 12px !important;
      margin-bottom: 10px !important;
      transition: all 0.2s ease !important;
    }

    .stat-item:hover {
      background: rgba(255, 255, 255, 0.08) !important;
      border-color: rgba(255, 255, 255, 0.15) !important;
    }

    .stat-label {
      font-size: 0.85rem !important;
      color: rgba(255, 255, 255, 0.6) !important;
      margin-bottom: 5px !important;
      font-weight: 500 !important;
    }

    .stat-value {
      font-size: 1.1rem !important;
      font-weight: 600 !important;
      color: rgba(255, 255, 255, 0.9) !important;
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
      text-shadow: 0 0 10px rgba(74, 144, 226, 0.3) !important;
      font-family: 'Courier New', monospace !important;
    }

    /* Estilos intensos para la cabecera del chat - GLASSMORPHISM COMPLETO */
    .ai-panel-card {
      background: rgba(255, 255, 255, 0.02) !important;
      backdrop-filter: blur(20px) !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      border-radius: 20px !important;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3) !important;
      overflow: hidden !important;
    }

    .ai-panel-header {
      background: linear-gradient(135deg, rgba(74, 144, 226, 0.4), rgba(139, 92, 246, 0.4)) !important;
      border-bottom: 2px solid rgba(255, 255, 255, 0.15) !important;
      backdrop-filter: blur(25px) !important;
      position: relative !important;
      padding: 20px !important;
      box-shadow: 0 8px 32px rgba(74, 144, 226, 0.2) !important;
    }

    .ai-panel-header::before {
      content: '' !important;
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      height: 4px !important;
      background: linear-gradient(90deg, #4A90E2, #FFD166, #8B5CF6, #4A90E2) !important;
      opacity: 1 !important;
      animation: headerShine 3s ease-in-out infinite !important;
    }

    .ai-panel-header::after {
      content: '' !important;
      position: absolute !important;
      top: 50% !important;
      left: -50% !important;
      width: 200% !important;
      height: 200% !important;
      background: radial-gradient(circle, rgba(74, 144, 226, 0.1) 0%, transparent 70%) !important;
      animation: orbitalGlow 4s ease-in-out infinite !important;
      pointer-events: none !important;
    }

    .ai-badge {
      background: linear-gradient(135deg, #4A90E2, #8B5CF6) !important;
      color: white !important;
      box-shadow: 0 6px 20px rgba(74, 144, 226, 0.6) !important;
      border: 2px solid rgba(255, 255, 255, 0.3) !important;
      animation: badgeIntense 2s ease-in-out infinite !important;
      border-radius: 12px !important;
      padding: 8px 12px !important;
      font-weight: bold !important;
      text-transform: uppercase !important;
      letter-spacing: 1px !important;
    }

    .ai-panel-header strong {
      color: #ffffff !important;
      text-shadow: 0 3px 8px rgba(0, 0, 0, 0.8), 0 1px 4px rgba(74, 144, 226, 0.5) !important;
      font-weight: 700 !important;
      font-size: 1.15rem !important;
      background: linear-gradient(135deg, #ffffff, #e0e7ff) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
    }

    .ai-panel-header .btn {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)) !important;
      border: 2px solid rgba(255, 255, 255, 0.3) !important;
      color: #ffffff !important;
      backdrop-filter: blur(15px) !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
      text-shadow: 0 2px 6px rgba(0, 0, 0, 0.7) !important;
      border-radius: 12px !important;
      font-weight: 600 !important;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
    }

    .ai-panel-header .btn:hover {
      background: linear-gradient(135deg, rgba(74, 144, 226, 0.3), rgba(139, 92, 246, 0.3)) !important;
      border-color: rgba(255, 255, 255, 0.5) !important;
      color: #ffffff !important;
      transform: translateY(-3px) scale(1.05) !important;
      box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4) !important;
      text-shadow: 0 3px 8px rgba(0, 0, 0, 0.8) !important;
    }

    @keyframes badgeIntense {
      0%, 100% { 
        box-shadow: 0 6px 20px rgba(74, 144, 226, 0.6) !important;
        transform: scale(1) !important;
      }
      50% { 
        box-shadow: 0 8px 30px rgba(74, 144, 226, 0.9) !important;
        transform: scale(1.05) !important;
      }
    }

    @keyframes headerShine {
      0%, 100% { 
        background: linear-gradient(90deg, #4A90E2, #FFD166, #8B5CF6, #4A90E2) !important;
      }
      33% { 
        background: linear-gradient(90deg, #8B5CF6, #4A90E2, #FFD166, #8B5CF6) !important;
      }
      66% { 
        background: linear-gradient(90deg, #FFD166, #8B5CF6, #4A90E2, #FFD166) !important;
      }
    }

    @keyframes orbitalGlow {
      0% { 
        transform: translateY(-50%) rotate(0deg) !important;
        opacity: 0.3 !important;
      }
      50% { 
        opacity: 0.6 !important;
      }
      100% { 
        transform: translateY(-50%) rotate(360deg) !important;
        opacity: 0.3 !important;
      }
    }
  </style>
</head>
<body>
  <!-- Fondo animado estilo onepage -->
  <div class="demo-background"></div>
  <div class="bg-gradient"></div>
  <div class="bg-grid"></div>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  
  <!-- Navigation -->
  <nav>
    <div class="nav-container">
      <a href="/" class="logo">
        <span>SpaceCrafter</span>
      </a>
      <div class="nav-links">
        <a href="/#features">Features</a>
        <a href="#" class="btn btn-secondary" onclick="event.preventDefault(); return false;">Try Now</a>
        <a href="/login" class="btn btn-primary">Login</a>
      </div>
      <button class="mobile-menu-btn" onclick="alert('Menú móvil - implementar drawer aquí')">☰</button>
    </div>
  </nav>

  <div class="container my-4" style="margin-top: 120px !important;">
    <div class="designer">
      <!-- Panel izquierdo: categorías + módulos -->
      <aside class="modules-panel">
        <h2>Categories</h2>
        <div id="categoryList"></div>
        <hr class="divider">
        <h2>Modules</h2>
        <div id="modulesList"></div>
      </aside>

      <!-- Centro: grid -->
      <main class="grid-area">
        <div class="grid-controls">
          <h2>Habitat Layout</h2>
          <div>
            <button id="btnClear">Clean</button>
            <button id="btnExport">Export</button>
          </div>
        </div>
        <div class="habitat-grid" id="grid"></div>
      </main>

      <!-- Derecha: stats -->
      <aside class="info-panel">
        <h2>Information</h2>
        <div class="stat-item">
          <div class="stat-label">Occupied cells</div>
          <div class="stat-value" id="occupiedCells">0 / 100</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Modules installed</div>
          <div class="stat-value" id="moduleCount">0</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Occupied area</div>
          <div class="stat-value" id="efficiency">0%</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Crew (default)</div>
          <div class="stat-value" id="crewSize">6</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Total score (1–5)</div>
          <div class="stat-value" id="habScore">0.00</div>
        </div>

        <div class="module-list">
          <strong class="list-title">Active modules:</strong>
          <div id="activeModules"></div>
        </div>
      </aside>
    </div>
  </div>

  <!-- Modal grande: Configurar módulo (misma estructura/IDs que usa main.js) -->
  <div class="modal fade" id="moduleModal" tabindex="-1" aria-labelledby="moduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="block block-rounded mb-0">
          <div class="block-header bg-primary text-white">
            <h3 class="block-title text-white text-uppercase mb-0" id="moduleModalLabel">
              <span id="mmTitle">Module</span>
            </h3>
            <div class="block-options">
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times me-1"></i> Close
              </button>
            </div>
          </div>

          <div class="block-content">
            <div class="row g-4 align-items-start">
              <!-- Media -->
              <div class="col-md-5">
                <div class="mm-media-box">
                  <img id="mmImage" alt="preview">
                </div>
              </div>

              <!-- Texto + stats -->
              <div class="col-md-7">
                <h6 class="mm-head">Description</h6>
                <p id="mmDesc" class="mm-desc">—</p>

                <h6 class="mm-head mt-3">Characteristics (1–5)</h6>
                <div id="mmStats"></div>
              </div>
            </div>
          </div>

          <!-- Solo tamaños, centrados -->
          <div class="block-content block-content-full bg-body">
            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
              <button type="button" class="btn btn-sm mm-size-btn btn-alt-primary" data-size="small">
                Small </Small> <span class="dim ms-2">1×1</span>
              </button>
              <button type="button" class="btn btn-sm mm-size-btn btn-alt-primary" data-size="medium">
                Medium <span class="dim ms-2">2×2</span>
              </button>
              <button type="button" class="btn btn-sm mm-size-btn btn-alt-primary" data-size="large">
                Large <span class="dim ms-2">3x3</span>
              </button>
            </div>
          </div>

        </div><!--/block-->
      </div>
    </div>
  </div>

  <!-- Quick Modal: acciones sobre un módulo ya colocado -->
  <div class="modal fade" id="moduleQuick" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header">
            <h3 class="block-title" id="mqTitle">Configure module</h3>
            <div class="block-options">
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>

          <div class="block-content">
            <div class="text-center mb-3 mm-quick-caption">Size (always square)</div>
            <div class="d-flex justify-content-center gap-2 flex-wrap">
              <button id="mqSizeS" type="button" class="btn btn-sm btn-outline-primary mm-size-btn">
                Small <span class="dim ms-2">1×1</span>
              </button>
              <button id="mqSizeM" type="button" class="btn btn-sm btn-outline-primary mm-size-btn">
                Medium <span class="dim ms-2">2×2</span>
              </button>
              <button id="mqSizeL" type="button" class="btn btn-sm btn-outline-primary mm-size-btn">
                Large <span class="dim ms-2">3×3</span>
              </button>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-center">
              <button id="mqDelete" type="button" class="btn btn-sm btn-alt-danger">
                <i class="fa fa-trash me-1"></i> Remove module
              </button>
            </div>
          </div>

        </div><!--/block-->
      </div>
    </div>
  </div>

  <!-- ========== IA Chat (FAB + Panel) ========== -->
  <div id="ai-fab" class="ai-fab" aria-label="Open chatbot" title="AI Assistant">
    <span class="ai-fab-icon">🤖</span>
  </div>

  <div id="ai-panel" class="ai-panel" aria-hidden="true">
    <div class="ai-panel-card">
      <div class="ai-panel-header">
        <div class="d-flex align-items-center gap-2">
          <span class="ai-badge">IA</span>
          <strong>Habitat Designer Assistant</strong>
        </div>
        <button type="button" class="btn btn-sm btn-light" id="ai-close-btn">
          <i class="fa fa-times me-1"></i> Close
        </button>
      </div>
      <div id="ai-messages" class="ai-panel-messages">
        <div class="ai-msg ai-msg-bot">
          <div class="ai-bubble">
            Hi! I'm your habitat desginer assistant. Ask me about modules, sizes, or shortcuts ✨
          </div>
        </div>
      </div>

      <form id="ai-form" class="ai-panel-input">
        <input id="ai-input" type="text" class="form-control" placeholder="Type your message..." autocomplete="off" />
        <button class="btn btn-primary" type="submit">
          <i class="fa fa-paper-plane"></i>
        </button>
      </form>
    </div>
  </div>
  <!-- ========== /IA Chat ========== -->

  <!-- JS (mismos que habitat.php): InteractJS + Bootstrap + tu app -->
  <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Shim: injerta MODULE_SCORES como stats dentro de MODULE_CATALOG (para el modal grande) -->
  <script type="module">
    import { MODULE_CATALOG, MODULE_SCORES } from '/modules/habitat/assets/js/specs.js';
    for (const k in MODULE_SCORES) {
      if (!MODULE_CATALOG[k]) MODULE_CATALOG[k] = {};
      MODULE_CATALOG[k].stats = MODULE_SCORES[k];
    }
  </script>

  <!-- MISMO main.js que habitat.php -->
  <script type="module" src="/modules/habitat/assets/js/main.js"></script>
  <script defer src="/modules/habitat/assets/js/ai-chat.js"></script>
</body>
</html>
