// Simple front-only chat widget (demo)

(function(){
  const $ = (sel, root=document) => root.querySelector(sel);

  const fab     = $('#ai-fab');
  const panel   = $('#ai-panel');
  const close   = $('#ai-close-btn');
  const form    = $('#ai-form');
  const input   = $('#ai-input');
  const messages= $('#ai-messages');

  if(!fab || !panel) return;

  const openPanel  = () => { panel.classList.add('open');  panel.setAttribute('aria-hidden','false'); input?.focus(); };
  const closePanel = () => { panel.classList.remove('open');panel.setAttribute('aria-hidden','true'); };

  fab.addEventListener('click', openPanel);
  close?.addEventListener('click', closePanel);

  // Toggle con ESC
  document.addEventListener('keydown', (e)=>{
    if(e.key === 'Escape' && panel.classList.contains('open')) closePanel();
  });

  // Auto scroll
  const scrollBottom = () => { messages.scrollTop = messages.scrollHeight; };

  // Función para formatear texto markdown básico
  function formatMarkdown(text) {
    return text
      // Encabezados
      .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')  // **texto** -> <strong>texto</strong>
      .replace(/\*(.*?)\*/g, '<em>$1</em>')              // *texto* -> <em>texto</em>
      // Listas
      .replace(/^\* (.*$)/gim, '<li>$1</li>')            // * item -> <li>item</li>
      // Envolver listas en <ul>
      .replace(/(<li>.*<\/li>)/s, '<ul>$1</ul>')
      // Saltos de línea
      .replace(/\n/g, '<br>');
  }

  // Pintar mensaje
  function paintMessage(text, role='user', isHtml=false){
    const wrap = document.createElement('div');
    wrap.className = 'ai-msg ' + (role === 'user' ? 'ai-msg-user' : 'ai-msg-bot');

    const bubble = document.createElement('div');
    bubble.className = 'ai-bubble';
    
    if (isHtml) {
      bubble.innerHTML = text;
    } else {
      bubble.textContent = text;
    }

    wrap.appendChild(bubble);
    messages.appendChild(wrap);
    scrollBottom();
    // Devolvemos el elemento para poder modificarlo (ej: para el indicador de "escribiendo")
    return wrap;
  }

  // Enviar
  form?.addEventListener('submit', async (e)=>{
    e.preventDefault();
    const val = (input?.value || '').trim();
    if(!val) return;
    
    paintMessage(val, 'user');
    input.value = '';

    // Mostrar un indicador de "escribiendo..."
    const typingIndicator = paintMessage('...', 'bot');

    // Conectar con el backend real
    try {
        const response = await fetch('/modules/habitat/asistente-ia.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ pregunta: val }),
      });

      if (!response.ok) {
        throw new Error('The server response was unsuccessful.');
      }

      const data = await response.json();
      const aiMessage = data.respuesta;

      // Formatear el mensaje con Markdown y actualizar el indicador "escribiendo..."
      const formattedMessage = formatMarkdown(aiMessage);
      typingIndicator.querySelector('.ai-bubble').innerHTML = formattedMessage;

    } catch (error) {
      console.error('Error contacting the API:', error);
      // Informar al usuario del error en la misma burbuja
      typingIndicator.querySelector('.ai-bubble').textContent = 'I\'m sorry, I couldn\'t connect to the assistant. Please try again later.';
    }
  });
})();

