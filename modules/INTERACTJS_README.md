# 🎮 Habitat Creator - Guía de Interactividad

## ✨ Nuevas Funcionalidades con Interact.js

### 📦 **1. Colocar Módulos**
- Arrastra módulos desde el panel izquierdo
- Suéltalos en el grid
- Se ajustan automáticamente a la cuadrícula

### 🚚 **2. Mover Módulos** *(NUEVO)*
- **Hover**: Aparece un icono ✥ en la esquina superior izquierda
- **Click + Arrastre**: Mantén presionado y mueve el módulo
- **Snap to Grid**: Se ajusta automáticamente a las celdas
- **Validación**: No se puede mover si colisiona con otros módulos

### 📐 **3. Redimensionar Módulos** *(NUEVO)*
- **Hover**: Aparece un indicador triangular azul en la esquina inferior derecha
- **Arrastra la esquina**: Agranda o reduce el módulo
- **Límites**: Mínimo 1×1, máximo hasta el borde del grid
- **Validación**: No se puede agrandar si colisiona

### 🎨 **Indicadores Visuales**
| Estado | Efecto |
|--------|--------|
| Normal | Borde transparente |
| Hover | Borde azul + sombra + indicadores |
| Seleccionado | Borde verde + resplandor |
| Arrastrando | Opacidad 80% + sombra grande |
| Redimensionando | Borde amarillo |

### 🔧 **Controles**
- **Click en módulo**: Seleccionar
- **Limpiar**: Borra todo el layout
- **Exportar**: Guarda en consola (F12)
- **✕ en panel**: Elimina módulo individual

### 🛠️ **Tecnología**
- **Librería**: [Interact.js](https://interactjs.io/)
- **CDN**: `https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js`
- **Peso**: ~35KB (liviana)
- **Dependencias**: Ninguna (standalone)

### 📋 **Funciones Principales**

#### `makeInteractive(element, moduleId)`
Convierte un módulo en movible y redimensionable
```javascript
// Automáticamente llamada al colocar un módulo
placeModule(index, type, width, height);
```

#### `moveModule(moduleId, newStartIndex)`
Mueve un módulo a una nueva posición validada
```javascript
// Validar antes de mover
if (canMoveModule(moduleId, newIndex)) {
  moveModule(moduleId, newIndex);
}
```

#### `resizeModule(moduleId, newWidth, newHeight)`
Redimensiona un módulo validando colisiones
```javascript
// Validar antes de redimensionar
if (canResizeModule(moduleId, 3, 2)) {
  resizeModule(moduleId, 3, 2);
}
```

### 🎯 **Ventajas de Interact.js**
✅ Liviana (35KB)  
✅ Sin dependencias  
✅ Touch-friendly (funciona en móviles)  
✅ Snap to grid integrado  
✅ Soporte para restricciones y límites  
✅ Altamente personalizable  

### 🔮 **Posibles Mejoras Futuras**
- [ ] Rotación de módulos
- [ ] Undo/Redo
- [ ] Copiar/pegar módulos
- [ ] Plantillas predefinidas
- [ ] Exportar a imagen PNG
- [ ] Guardar layouts en BD

---

**Desarrollado con ❤️ usando Interact.js**
