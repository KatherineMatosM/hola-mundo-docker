# Hola Mundo — Docker Compose App

Aplicación **PHP + MySQL** corriendo en contenedores Docker.

---

## Estructura

hola-mundo/
├── docker-compose.yml 
├── mysql/
│ └── init.sql 
└── src/
├── index.php
├── css/style.css
└── js/app.js 


---

## Servicios

| Servicio | Qué es                 | Puerto                     |
|----------|------------------------|----------------------------|
| app      | PHP 8.2 + Apache       | http://localhost:8080      |
| db       | MySQL 8.0              | 3307 (evita conflicto local) |

Los dos contenedores se comunican entre sí por una red interna de Docker.  
Desde PHP, la base de datos se llama simplemente `db`.

---

## Cómo correrlo

```bash
# Levantar
docker compose up -d

# Ver que ambos estén corriendo
docker compose ps

# Detener
docker compose down

Abrir en el navegador:

http://localhost:8080
🛠 Si algo falla
# Ver errores del servidor PHP
docker compose logs app

# Ver errores de MySQL
docker compose logs db

# Eliminar contenedores huérfanos y reiniciar limpio
docker rm -f <nombre_contenedor>
docker compose up -d
