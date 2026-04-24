<!-- Footer -->
<footer id="page-footer" style="
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(20px);
  border-top: 1px solid rgba(255, 255, 255, 0.05);
  position: relative;
  overflow: hidden;
">
  <!-- Subtle gradient line on top -->
  <div style="
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(74, 144, 226, 0.4), transparent);
  "></div>
  
  <div class="content py-3">
    <div class="row fs-sm">
      <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
        <span style="color: rgba(255, 255, 255, 0.6);">
          Crafted with 
          <i class="fa fa-heart" style="
            color: #EC4899;
            animation: heartbeat 1.5s ease-in-out infinite;
          "></i> 
          for space exploration
        </span>
      </div>
      <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
        <a class="fw-semibold" href="#" style="
          background: linear-gradient(135deg, #FFD166, #FF6B6B);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
          text-decoration: none;
          transition: all 0.3s;
        " onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
          SpaceCrafter
        </a>
        <span style="color: rgba(255, 255, 255, 0.4);"> v1.0 </span>
        <span style="color: rgba(255, 255, 255, 0.3);">&copy;</span>
        <span style="color: rgba(255, 255, 255, 0.4);" data-toggle="year-copy">2025</span>
      </div>
    </div>
  </div>
</footer>

<style>
  @keyframes heartbeat {
    0%, 100% {
      transform: scale(1);
      opacity: 1;
    }
    25% {
      transform: scale(1.2);
      opacity: 0.8;
    }
    50% {
      transform: scale(1);
      opacity: 1;
    }
  }
</style>
<!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- SpaceCrafter Core JS -->
<script src="/assets/js/oneui.app.min.js"></script>
<!-- Page JS Plugins -->
<script src="/assets/js/plugins/chart.js/chart.umd.js"></script>
<!-- Page JS Code -->
<script src="/assets/js/pages/be_pages_dashboard.min.js"></script>

<script>
  // Update year automatically
  const yearElement = document.querySelector('[data-toggle="year-copy"]');
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }
</script>
</body>
</html>