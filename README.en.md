# SpaceCrafter

[Versión en español](./README.md)

**NASA Space Apps Challenge 2025 - Team Los Desorbitados (Area 42, Malaga, Spain)**

https://github.com/user-attachments/assets/ee8324f5-55c5-4410-a514-b2372a9cd68f

## About the project

SpaceCrafter is an educational web platform to design and evaluate modular space habitats through a visual and interactive interface. The project was built to make space habitability concepts more accessible to students and general audiences using a format inspired by real NASA and ESA references.

Users can:

- Define habitat shape and size.
- Place modules such as life support, power, galley, sleeping quarters, exercise, airlocks, docking, and laboratories.
- Work with a drag and drop visual editor.
- Review simplified module references inspired by real mission architecture.
- Explore a learning-focused experience with scoring, challenges, and guided context.

## Hackathon context

This project was created for the NASA Space Apps Challenge 2025, under the challenge **Your Home in Space: The Habitat Layout Creator**, focused on designing environments capable of sustaining human life in space missions.

Space habitats need to address topics such as:

- Waste management.
- Thermal control.
- Life support.
- Power generation and distribution.
- Food preparation and storage.
- Medical support.
- Sleep and exercise.
- Communications and operations.

## Main features

- Visual drag and drop habitat editor.
- Real-time scoring for efficiency, ergonomics, and overall design balance.
- Built-in assistant with local responses in this published version.
- Modules and concepts inspired by aerospace documentation.
- Community, ranking, profile, and preset views.
- Educational approach with visual navigation and learning content.

## Repository status

This repository has been prepared as a portfolio-ready and reusable version:

- No API keys, passwords, or server credentials are included.
- Sensitive values should be stored in `.env`.
- A reference SQL schema is included in `database/schema.sql`.
- The app no longer depends on a `public_html` folder and is organized from the repository root.

## Technologies

- Frontend: HTML, CSS, and JavaScript.
- Backend: PHP.
- Original database layer: MySQL.
- Reference data: public NASA and ESA documentation.

## Project structure

- `app/`: environment, session, and authentication helpers.
- `assets/`: styles, scripts, fonts, videos, and images.
- `includes/`: headers, sidebars, and shared layout parts.
- `modules/habitat/`: main habitat designer and assistant.
- `modules/dashboard/`: dashboard, community, profile, learning, and preset views.
- `database/schema.sql`: reference SQL structure.
- `.env.example`: sample environment variables for local setup.

## How to run locally

Requirements:

- PHP 8 or newer.

Steps:

1. Copy `.env.example` to `.env` if you want to define local environment variables.
2. Start a web server from the project root.
3. Open the application in your browser.

Example using PHP's built-in server:

```powershell
php -S localhost:8000
```

Then open `http://localhost:8000`.

If you prefer Apache or Nginx, point the virtual host directly to this folder as the public root.

## Database

A reference schema is included in `database/schema.sql` to preserve the original logical structure and make future recreation, review, or adaptation easier.

## Media

### Screenshots

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

## AI usage and references

- During development, artificial intelligence tools were used as support for coding tasks, generation of specific parts, technical assistance, visual materials, and idea exploration.
- The final implementation, adaptation, and integration of the project were carried out by the team, using AI as a supporting tool rather than as a full replacement for development work.
- The public repository version does not include private keys or sensitive external-service dependencies.
- Main NASA reference for functional spaces: [NASA NTRS PDF](https://ntrs.nasa.gov/api/citations/20200002973/downloads/20200002973.pdf).

## Team

Project developed by Los Desorbitados for the NASA Space Apps Challenge 2025.

| Name | GitHub |
|---|---|
| Marcos Barranquero Ramírez | https://github.com/MarcosBarranquero |
| Raúl Casado Moreno | https://github.com/RaulCasado |
| Alba Marqués Reca | https://github.com/AMarqs |
| Antonio Jesús Arévalo Urbano | https://github.com/Ajesusau |
| Javier Navarrete González | https://github.com/javiernglz |
| Alejandro Ortiz Gonzalez | https://github.com/inhenowe |
