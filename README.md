# Prompt Vault 


## Descripción
**Prompt Vault** es un proyecto académico desarrollado en **PHP** que permite crear, almacenar y reutilizar *prompts* para distintas inteligencias artificiales.
El sistema facilita la organización de prompts por categorías, la búsqueda avanzada y la gestión de favoritos por usuario, además de ofrecer accesos directos a diferentes IA para usar los prompts de forma inmediata.

---

## Objetivo del proyecto
El objetivo principal es proporcionar una plataforma centralizada para:
- Gestionar prompts reutilizables
- Mejorar la productividad al interactuar con distintas IA
- Aplicar conceptos de desarrollo web, bases de datos y control de acceso

---

## Funcionalidades principales
- ✅ Registro e inicio de sesión de usuarios
- ✅ Creación y almacenamiento de prompts
- ✅ Clasificación de prompts por categorías
- ✅ Búsqueda general y por categorías
- ✅ Gestión de prompts favoritos por usuario
- ✅ Acceso directo a distintas IA para utilizar los prompts
- ✅ Interfaz sencilla y orientada al usuario

---

## Tecnologías utilizadas
- **Backend:** PHP
- **Base de datos:** MySQL (administrada con phpMyAdmin)
- **Frontend:** HTML, CSS
- **Servidor local:** XAMPP / Apache

---

## Estructura del proyecto
SISTEMAINFORMACION1
│── assets/
│ └── style.css
│
│── auth/
│ ├── login.php
│ ├── logout.php
│ └── register.php
│
│── config/
│ └── db.php
│
│── partials/
│ ├── header.php
│ └── footer.php
│
│── public/
│ ├── index.php
│ ├── categorias.php
│ ├── create.php
│ ├── edit.php
│ ├── delete_prompt.php
│ ├── save_prompt.php
│ ├── update_prompt.php
│ ├── search.php
│ ├── prompts_categoria.php
│ ├── favorites.php
│ ├── favorito_add.php
│ └── toggle_favorite.php

---

## Descripción de carpetas
- **assets/**: estilos CSS del sistema
- **auth/**: manejo de autenticación (login, registro, logout)
- **config/**: configuración de conexión a la base de datos
- **partials/**: componentes reutilizables (header y footer)
- **public/**: páginas principales y lógica CRUD de prompts

---

## Base de datos
La base de datos se gestiona con **phpMyAdmin** y contiene tablas para:
- Usuarios
- Prompts
- Categorías
- Prompts favoritos
- Relaciones entre usuarios y prompts

> Es necesario importar el archivo SQL del proyecto antes de ejecutar la aplicación.

---

## Instalación y ejecución
1. Clonar o descargar el proyecto
2. Copiar la carpeta `SISTEMAINFORMACION1` dentro de `htdocs`
3. Crear la base de datos en phpMyAdmin
4. Importar el archivo `.sql`
5. Configurar la conexión en `config/db.php`
6. Iniciar Apache y MySQL desde XAMPP
7. Acceder desde el navegador: http://localhost/SISTEMAINFORMACION1/public

---

## Alcance académico
Proyecto desarrollado con fines **académicos**, aplicando:
- Programación web con PHP
- CRUD
- Manejo de sesiones y autenticación
- Bases de datos relacionales
- Organización MVC básica

---

## Autor
**Yery Eguez**  
Proyecto académico – 2026 🎓

---

## Licencia
Uso educativo y académico.
