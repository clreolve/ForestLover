# Logica del Negocio
## Usuario 🐵
  - id unico
  - correo unico
  - contraseña encriptada en hash
  - biografia opcional
  - fecha de nacimiento opcional
## Imagen 🖼
- id
- fecha de publicacion
- link donde se almacena la imagen (probablemente en el mismo server 😎)
- Cada imagen pertenece a un usuario
- Cada imagen tiene cero o mas usuarios que le han dado like
- Cada imagen tiene cero o mas especies que aparecen en la
- Cada imagen tiene cero o mas comentarios
## Especie 🌼
- id
- nombre
- enlace a una web que de informacion de la especie opcional
## Bosque 🏕
- id
- nombre
- descripcion opcional (probablemente escrita por algun moderador)
- Cada bosque tiene cero o mas imagenes
- Cada bosque tiene cero o mas especies
- Cada bosque tiene cero o mas  comentarios
## Comentario 📃
- id
- usuario
- texto