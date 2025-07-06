# 🎬 Tarea 6: Gestión de Personajes

## 🗂️ Descripción

Este proyecto es una aplicación web desarrollada en **PHP** con **MySQL**, creada para gestionar personajes de una serie, película, anime, libro o noticia. En mi caso, elegí el tema inspirado en personajes de anime.  

Permite registrar, editar, eliminar, visualizar y descargar en PDF el perfil de cada personaje, con una interfaz inspirada en la serie seleccionada.

## 🚀 Funcionalidades principales

- **CRUD completo**: crear, leer, actualizar y eliminar personajes.
- **Carga de foto** para cada personaje.
- **Descargar perfil en PDF** personalizado (decorado acorde a la serie).
- **Asistente de configuración de base de datos**, estilo WordPress.
- **Página "Acerca de"** mostrando información del autor y un video explicativo.
- Interfaz adaptada con Bootstrap.

## 🛢️ Estructura de la base de datos

Nombre de la base: `serie_db` (o el que configures en el asistente).

### Tabla: `personajes`

| Campo  | Tipo              | Descripción                                      |
|----------|-------------------|--------------------------------------------------|
| id       | INT, AUTO_INCREMENT, PK | Identificador único.                  |
| nombre   | VARCHAR(100)     | Nombre del personaje.                           |
| color    | VARCHAR(50)      | Color representativo del personaje.            |
| tipo     | VARCHAR(50)      | Tipo, rol o categoría.                         |
| nivel    | INT              | Nivel o jerarquía.                             |
| foto     | VARCHAR(255)     | URL/archivo de la foto.                        |

---

## ⚙️ Configuración e instalación

### ✅ Requisitos

- PHP 7.x o superior
- Servidor Apache o compatible
- MySQL
- Composer (opcional, si deseas gestionar librerías)

### ✅ Pasos

1️⃣ **Clonar o descargar el proyecto**

```bash
git clone https://github.com/abelmartinez04/Programacion-Web.git
