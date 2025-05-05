# 🏥 Simulador de Turnos para un Centro Médico

Este sistema web permite gestionar turnos médicos en un centro de salud. Los pacientes pueden reservar citas con distintos especialistas, y el personal administrativo (recepcionistas o admins) puede visualizar, actualizar y gestionar los turnos agendados, así como administrar la disponibilidad de los médicos.

## 📁 Estructura de carpteas

    .
    ├── config.php             # Configuración general del sistema (DB, rutas, etc.)
    ├── db.sql                 # Script SQL para crear e inicializar la base de datos
    ├── index.php              # Punto de entrada principal de la aplicación
    ├── readme.md              # Documentación del sistema
    ├── controllers/           # Controladores que gestionan la lógica de negocio
    │   ├── medico.controller.php
    │   ├── paciente.controller.php
    │   └── turno.controller.php
    ├── models/                # Modelos que interactúan con la base de datos
    │   ├── medico.model.php
    │   ├── paciente.model.php
    │   └── turno.model.php
    └── views/                 # Vistas del sistema (HTML/PHP)
        └── index.php

## ⚙️ Capas del Sistema

- Modelos (/models): Acceden a la base de datos, ejecutan consultas (SELECT, INSERT, UPDATE, DELETE).

- Controladores (/controllers): Reciben las solicitudes del usuario, procesan los datos y coordinan la lógica de negocio.

- Vistas (/views): Interfaz de usuario donde se muestran los formularios, tablas de turnos, etc.

# 🚀 Requisitos y Ejecución

1. Importar db.sql en tu motor MySQL/MariaDB.

1. Levantar un servidor local y acceder a index.php.

1. Link del entorno: [XAMPP](https://www.apachefriends.org/es/index.html)
