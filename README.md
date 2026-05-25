# MyAgenda 📔

Un sistema de gestión de contactos elegante, rápido y minimalista construido sobre las últimas tecnologías web. Diseñado para ofrecer una experiencia de usuario fluida con una interfaz moderna y completamente responsiva.

---

## ✨ Características Principales

- 🌓 **Tema Adaptable Dinámico:** Soporte completo e integrado para modo Claro, Oscuro y configuración nativa del Sistema.
- 👥 **Gestión de Contactos:** Directorio completo que soporta fotos de perfil personalizadas, información de contacto detallada, teléfonos y correos.
- 🏷️ **Categorías Visuales:** Organiza tu directorio utilizando etiquetas personalizables con colores, íconos de sistema o imágenes propias.
- 🔒 **Seguridad y Roles:** Autenticación robusta que incluye recuperación de contraseñas mediante preguntas secretas (usando encriptación reversible), y sistema de privilegios (Administrador / Usuario Estándar).
- 📥 **Exportación Profesional:** Descarga tu directorio completo o filtrado en documentos **PDF** limpios o en hojas de cálculo **Excel (.xlsx)** estilizadas.
- 🔍 **Búsqueda Avanzada:** Motor de búsqueda integrado para localizar rápidamente contactos por nombre, correo, teléfono o mediante filtros de categoría.
- 📱 **Diseño Responsivo:** Interfaz diseñada desde cero (Mobile First) para funcionar perfectamente en computadoras, tablets y teléfonos móviles.

---

## 🛠️ Stack Tecnológico

**Backend:**
* PHP 8+
* Laravel 13.x

**Frontend:**
* HTML5 & CSS3
* Tailwind CSS 3.4
* Alpine.js (Interactividad y Modales)

**Paquetes Clave:**
* `barryvdh/laravel-dompdf` (Generación de reportes PDF)
* `maatwebsite/excel` (Exportación a Excel)

---

## 🚀 Instalación y Despliegue

Sigue estos pasos para levantar el entorno de desarrollo local:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/HennrryCanahui/Miagenda.git
   cd Miagenda
   ```

2. **Instalar dependencias de PHP y Node:**
   ```bash
   composer install
   npm install
   ```

3. **Compilar los estilos (Tailwind):**
   ```bash
   npm run build
   ```

4. **Configurar el entorno:**
   Copia el archivo `.env.example` y renómbralo a `.env`. Luego, ajusta tus credenciales de base de datos.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Migrar base de datos y Storage:**
   Ejecuta las migraciones y los seeders para cargar los roles por defecto, y enlaza el almacenamiento para las fotos de perfil:
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

6. **Iniciar el servidor local:**
   ```bash
   php artisan serve
   ```
   > Accede a la aplicación desde `http://localhost:8000`

---

## 👨‍💻 Desarrollador

Construido y mantenido por **Hennrry Geovanni Canahui Gomez**.

*Desarrollado como demostración técnica de maquetación, diseño de interfaces de usuario (UI/UX) y estructuración backend.*
