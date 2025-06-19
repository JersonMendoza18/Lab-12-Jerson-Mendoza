# 🛒 Sistema de Registro y Reporte de Compras en PHP

Este proyecto es un sistema web desarrollado en **PHP y MySQL** que permite registrar compras realizadas por personas y generar **reportes en PDF**, tanto individuales (por cliente) como globales (todas las compras realizadas). Utiliza **Bootstrap** para el diseño visual y **FPDF** para la generación de documentos PDF.

---

## 🚀 Funcionalidades

- Registro de personas y sus compras.
- Selección de múltiples productos por cliente.
- Visualización de compras filtradas por DNI.
- Listado global de todas las compras realizadas.
- Generación de PDF para cada cliente o del total general.

---

## 🧾 Requisitos

- Servidor web con PHP (v7.4 o superior recomendado, compatible con PHP 8.2).
- Servidor MySQL o MariaDB.
- Apache (opcional pero recomendado).
- Extensión `mysqli` habilitada.
- Biblioteca FPDF (incluida en la carpeta del proyecto).

---

## ⚙️ Configuración inicial

1. **Importa la base de datos**
   
   - Dentro del proyecto se incluye un archivo `.sql` (no olvides crearlo si no existe).
   - Puedes importar este archivo a tu base de datos MySQL mediante phpMyAdmin, MySQL Workbench o consola.

2. **Configura la conexión a la base de datos**

   El archivo que gestiona la conexión está en:

   ```
   /Actividad1/model/Conexion.php
   ```

   Dentro del archivo encontrarás una clase con la siguiente estructura:

   ```php
   private $host = 'localhost';
   private $usuario = 'root';
   private $contrasena = '';
   private $base_datos = 'nombre_de_tu_base_de_datos';
   ```

   **🔧 IMPORTANTE:** Modifica estos valores para que coincidan con tu entorno local:

   - `localhost`: dirección del servidor de base de datos.
   - `root`: usuario de MySQL (puede ser otro en tu caso).
   - `''`: contraseña del usuario MySQL.
   - `'nombre_de_tu_base_de_datos'`: nombre exacto de la base que hayas importado.

3. **Ubica el proyecto en tu servidor**

   Si estás usando Apache (por ejemplo, con XAMPP o Apache24), coloca la carpeta del proyecto en:

   ```
   C:/xampp/htdocs/Lab-12-Jerson-Mendoza
   ```

   o en:

   ```
   C:/Apache24/htdocs/Lab-12-Jerson-Mendoza
   ```

   Según tu configuración.

4. **Accede al sistema**

   Abre tu navegador y escribe:

   ```
   http://localhost/Lab-12-Jerson-Mendoza/view/CompraView.php
   ```
