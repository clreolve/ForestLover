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
- id de usuario (clave foranea)
- Cada imagen tiene cero o mas usuarios que le han dado like
- Cada imagen tiene cero o mas especies que aparecen en la
- Cada imagen tiene cero o mas comentarios
## Especie 🌼
- id
- nombre
- enlace a una web que de informacion de la especie (opcional)
- Cada especie tiene cero o mas etiquetas
## Bosque 🏕
- id
- nombre
- descripcion opcional (probablemente escrita por algun moderador)
- Cada bosque tiene cero o mas imagenes
- Cada bosque tiene cero o mas especies
- Cada bosque tiene cero o mas  comentarios
- Cada bosque tiene cero o mas me gusta
## Comentario 📃
- id
- usuario
- texto
## Etiqueta Plantas 🎫
- id
- nombre
- descripcion opcional


# SQL
uid => usuario logeado
## home_page
1) () -> lista[id_imagen descendeteporfecha]; ya esta uwuw

2) (uid, id_imagen) => [
  fecha de publicacion, 
  descripcion, 
  link,
  numero me gustas (count), 
  me gusta(bool),
  id usuario al que pertenece,
  nombre usuario al que pertenece
]

3) (id_imagen) => [  (no logeado)
  fecha de publicacion, 
  descripcion, 
  link,
  numero me gustas (count),
  id usuario al que pertenece,
  nombre usuario al que pertenece
]

4)(id_imagen) -> lista comentarios para el id_imagen[
  id_comentario,
  texto_comentario,
  id_user_comentario,
  nombre_comentario,
  id_bosque,
  id_nombre
]

5)(id_imagen) -> lista etiquetas con ese id_imagen[  listo uwu
  id_etiqueta,
  nombre_etiqueta
]

6)id_especie) -> lista especies con ese id_imagen[ listo uwu
  id_especie,
  nombre_especie
]

## pagina bosque
1)(uid,id_bosque) -> bosque [           ya uwu
  nombre,
  descripcion,
  numero de personas al que les gusta ese bosque,
  me gusta(boolean),
]

2)(id_bosque) -> bosque [
  nombre,
  descripcion,                                   ya uwu
  numero de personas al que les gusta ese bosque,
]

3)(id_bosque) -> lista especies [           
  id_especie,
  nombre especie
]

4)(id_bosque) -> lista etiquetas bosque [
  id_etiqueta,
  nombre etiqueta 
]

5)(id_bosque) -> lista imagenes descendente fecha [   ya uwu
  id_imagen
]

## adicionales

(1) (id_etiqueta) -> lista imagenes descendente fecha [
  id_imagen
]

(id_especies) -> lista imagenes descendente fecha [
  id_imagen
]

## check
add_imagen(nombre,fecha_publicacion,link)
borrar_imagen(id)

add_etiqueta(nombre)
borrar_etiqueta(id_etiqueta)

add_etiqueta_bosque(id_etiqueta, id_bosque)
add_etiqueta_imagen(id_etiqueta, id_imagen)
add_etiqueta_especie(id_etiqueta, id_especie)
borrar_etiqueta_bosque(id_etiqueta, id_bosque)
borrar_etiqueta_imagen(id_etiqueta, id_imagen)
borrar_etiqueta_especie(id_etiqueta, id_especie)

add_comentario_imagen(id_user,id_imagen,texto)
add_comentario_bosque(id_user,id_bosque,texto)

borrar_comentario(id_comentario)

add_like_imagen(id_imagen,ide_usuario)
add_like_bosque(id_bosque,ide_usuario)
borrar_like_imagen(id_imagen,uid)
borrar_like_bosque(id_bosque,uid)