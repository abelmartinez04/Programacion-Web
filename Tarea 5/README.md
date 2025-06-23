# 🌐 Portal Web en PHP con APIs Externas

**Autor:** Abel Martínez  
**Matrícula:** 2024-0227

Este proyecto es un portal web desarrollado en PHP que consume 10 APIs externas para mostrar información dinámica de manera visual y funcional. El diseño está basado en Bootstrap 5 y se estructura con un archivo `plantilla.php` reutilizable.

---

## 📦 Contenido del portal

El portal cuenta con las siguientes secciones:

- Página principal con foto, nombre y bienvenida.
- Menú de navegación con acceso a:
  - Acerca de
  - APIs (10 páginas individuales)
    - Predicción de Género
    - Predicción de Edad
    - Universidades por país
    - Clima en RD
    - Información de Pokémon
    - Noticias WordPress
    - Conversión de Monedas
    - Generador de Imágenes
    - Información de Países
    - Generador de Chistes

---

## 🛠 Tecnologías utilizadas

- PHP 8.4
- Bootstrap 5
- HTML5 + CSS3
- JS (opcional)
- APIs externas (agify.io, genderize.io, PokeAPI, etc.)

---

## 🚀 ¿Cómo ejecutar el portal?

### Opción 1: Desde línea de comandos (servidor embebido de PHP)

1. Asegúrate de tener PHP instalado y habilitado con `cURL`.
2. Abre la terminal y ve a la carpeta del proyecto.
3. Ejecuta el siguiente comando:
   ```bash
   php -c C:\tools\php-8.4\php.ini -S localhost:2424
