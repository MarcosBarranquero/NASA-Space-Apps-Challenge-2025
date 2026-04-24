# SpaceCrafter

[English version](./README.en.md)

**NASA Space Apps Challenge 2025 - Team Los Desorbitados (Area 42, Malaga, Spain)**

https://github.com/user-attachments/assets/ee8324f5-55c5-4410-a514-b2372a9cd68f

## Sobre el proyecto

SpaceCrafter es una plataforma web educativa para diseñar y evaluar hábitats espaciales modulares de forma visual e interactiva. El objetivo del proyecto es acercar los retos de la habitabilidad en el espacio a estudiantes y público general mediante una experiencia accesible, atractiva y apoyada en referencias reales de NASA y ESA.

La aplicación permite:

- Definir la forma y el tamaño del hábitat.
- Colocar módulos como soporte vital, energía, galley, descanso, ejercicio, esclusas, docking y laboratorios.
- Diseñar con un editor visual drag and drop con retroalimentación inmediata.
- Consultar módulos inspirados en arquitecturas espaciales reales.
- Explorar una capa de aprendizaje gamificada con métricas, retos y guía contextual.

## Reto de la hackathon

Proyecto desarrollado para la NASA Space Apps Challenge 2025 dentro del reto **Your Home in Space: The Habitat Layout Creator**, centrado en cómo diseñar entornos habitables que permitan sostener la vida humana en misiones espaciales.

Los hábitats espaciales deben resolver cuestiones como:

- Gestión de residuos.
- Control térmico.
- Soporte vital.
- Generación y distribución de energía.
- Alimentación y almacenamiento.
- Atención médica.
- Descanso y ejercicio.
- Comunicaciones y operaciones.

## Funcionalidades principales

- Editor visual de módulos con drag and drop.
- Sistema de puntuación en tiempo real para evaluar eficiencia, ergonomía y equilibrio general del diseño.
- Asistente integrado con respuestas locales en esta versión publicada.
- Módulos y referencias inspirados en misiones y documentación aeroespacial.
- Vistas de comunidad, rankings, perfiles y propuestas.
- Enfoque educativo con navegación visual y contenidos de aprendizaje.

## Estado del repositorio

Esta versión se ha preparado para dejar el proyecto publicable y reutilizable como portfolio:

- No se incluyen claves de API, contraseñas ni datos de servidor.
- Las variables sensibles deben definirse mediante `.env`.
- Se incluye un esquema SQL de referencia en `database/schema.sql` para recrear la estructura de datos.
- La aplicación ya no depende de la carpeta `public_html`; el proyecto queda organizado desde la raíz del repositorio.

## Tecnologías

- Frontend: HTML, CSS y JavaScript.
- Backend: PHP.
- Base de datos original: MySQL.
- Datos de referencia: documentación pública de NASA y ESA.

## Estructura del proyecto

- `app/`: utilidades de entorno, sesión y autenticación.
- `assets/`: estilos, scripts, fuentes, vídeos e imágenes.
- `includes/`: cabeceras, barras laterales y piezas de layout.
- `modules/habitat/`: editor principal de hábitats y asistente.
- `modules/dashboard/`: vistas de dashboard, comunidad, perfil, aprendizaje y presets.
- `database/schema.sql`: estructura SQL de referencia.
- `.env.example`: ejemplo de variables de entorno para desarrollo local.

## Cómo ejecutarlo en local

Requisitos:

- PHP 8 o superior.

Pasos:

1. Copia `.env.example` a `.env` si quieres definir variables locales.
2. Inicia un servidor web apuntando a la raíz del proyecto.
3. Abre la aplicación en el navegador.

Ejemplo con el servidor embebido de PHP:

```powershell
php -S localhost:8000
```

Después abre `http://localhost:8000`.

Si prefieres Apache o Nginx, configura el virtual host para servir directamente esta carpeta como raíz pública.

## Base de datos

Se ha añadido `database/schema.sql` para conservar la estructura lógica del proyecto y facilitar su recuperación, consulta o adaptación en el futuro.

## Material visual

### Capturas

<p align="center">
  <img src="https://github.com/user-attachments/assets/0c9c16d3-e6ee-4868-80d6-1623241f0bed" width="250" />
  <img src="https://github.com/user-attachments/assets/0bc42d90-3ad2-402b-baf4-1720c4e240ab" width="250" />
  <img src="https://github.com/user-attachments/assets/485eece7-ad92-40d0-8e8a-44aca09b78e7" width="250" />
  <img src="https://github.com/user-attachments/assets/8f2a7962-ce84-4db1-937a-22ad8fb4710b" width="250" />
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/739d654c-834e-4d4f-8ac0-8c70d36976e5" width="250" />
  <img src="https://github.com/user-attachments/assets/ceeac972-5b4b-4b3e-bf48-81dedeacd216" width="250" />
  <img src="https://github.com/user-attachments/assets/f9232d0b-6752-421e-926e-853527998b7c" width="250" />
  <img src="https://github.com/user-attachments/assets/b26c8b30-366b-4598-bd29-edb28f88e3b2" width="250" />
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/e0329fcb-abd1-4a06-b889-f2db339f3fdb" width="250" />
  <img src="https://github.com/user-attachments/assets/02875097-0541-4866-8b48-6cf578710da6" width="250" />
  <img src="https://github.com/user-attachments/assets/407f42ad-9af1-459c-a28b-49e1f6e8ce96" width="250" />
  <img src="https://github.com/user-attachments/assets/c783535e-a618-456c-8ba9-0c42883abc26" width="250" />
</p>

## Uso de IA y referencias

- Durante el desarrollo del proyecto se utilizaron herramientas de inteligencia artificial como apoyo para tareas de código, generación de partes concretas, asistencia técnica, materiales visuales y exploración de ideas.
- La implementación, adaptación y ensamblado final del proyecto se realizó dentro del trabajo del equipo, usando la IA como herramienta de apoyo y no como sustitución completa del desarrollo.
- La versión pública del repositorio no incluye claves privadas ni dependencias sensibles de servicios externos.
- Referencia principal de NASA para espacios funcionales: [NASA NTRS PDF](https://ntrs.nasa.gov/api/citations/20200002973/downloads/20200002973.pdf).

## Equipo

Proyecto desarrollado por Los Desorbitados para la NASA Space Apps Challenge 2025.

| Nombre | GitHub |
|---|---|
| Marcos Barranquero Ramírez | https://github.com/MarcosBarranquero |
| Raúl Casado Moreno | https://github.com/RaulCasado |
| Alba Marqués Reca | https://github.com/AMarqs |
| Antonio Jesús Arévalo Urbano | https://github.com/Ajesusau |
| Javier Navarrete González | https://github.com/javiernglz |
| Alejandro Ortiz Gonzalez | https://github.com/inhenowe |
