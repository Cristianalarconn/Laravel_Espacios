#  Sistema de Reservas Laravel + Roles & Permisos

##  Descripción del Proyecto
Este es un sistema de reservas desarrollado con **Laravel**, que incluye:

- Autenticación con Laravel Breeze  
- Roles y permisos utilizando **Spatie Laravel Permission**  
- CRUD de reservas  
- Asignación automática del rol **user** al registrarse  
- Un administrador con control total del sistema

---

##  Requerimiento
---

## Instalación del Proyecto

### Clonar el repositorio
```bash
git clone https://github.com/tuusuario/tu-repositorio.git
cd tu-repositorio
```
### instalar
```bash
npm install
npm run build
```

### correr migaciones y crear el admin para poder editar los espacios (por si acaso estos son las datos del Sedder
correo:admin@example.com
nombre:Admin
contraseña:admin123)
```bash
php artisan migrate --seed
```

## Roles del Sistema
 -admin
 -user

### Permisos
# admin
-Crear reservas
-Editar reservas
-Eliminar reservas
-Ver todas las reservas
-crear espacios
-editar y eliminar espacios
-ver espacios

 # user

-Permisos:
-Crear reservas
-ver solo sus reservas

#A tener en cuenta puedes crear un usuario con tinker y asignarle el rol de admin
```bash
php artisan tinker
$user = App\Models\User::create([
    'name' => 'Admin 2',
    'email' => 'otroadmin@example.com',
    'password' => bcrypt('admin123'),
]);
$user->assignRole('admin');

```




