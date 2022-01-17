## HomePage

(1)
    "SELECT id_imagen FROM imagen ORDER BY id_imagen DESC"

(2)
    SELECT user.email, user.id, imagen.link, imagen.fecha_publicacion FROM imagen INNER JOIN user on imagen.id_usuario = user.id WHERE imagen.id_imagen = {$id_imagen}'

	'SELECT COUNT(id_imagen_like) FROM imagen_like WHERE id_imagen = {$id_imagen}';

	'SELECT id_imagen_like FROM imagen_like WHERE id_imagen = {$id_imagen} AND id_usuario = {$uid}';

(3)

     SELECT user.email, user.id, imagen.link, imagen.fecha_publicacion FROM imagen INNER JOIN user on imagen.id_usuario = user.id WHERE imagen.id_imagen = {$id_imagen}'

	'SELECT COUNT(id_imagen_like) FROM imagen_like WHERE id_imagen = {$id_imagen}';

(4)
    SELECT comentario.id_comentario, comentario.texto, comentario.id_usuario, user.email FROM comentario INNER JOIN user ON comentario.id_usuario = user.id WHERE comentario.id_imagen = 3;

(5)
    SELECT etiqueta_imagen.id_etiqueta, etiqueta.nombre FROM etiqueta_imagen INNER JOIN etiqueta ON etiqueta_imagen.id_etiqueta = etiqueta.id_etiqueta WHERE etiqueta_imagen.id_imagen = {$id_imagen};

(6)
    SELECT especie.id_especie , especie.nombre FROM especie INNER JOIN imagen_especie ON especie.id_especie = imagen_especie.id_especie WHERE imagen_especie.id_imagen = ${$id_imagen};

## Bosque

(1)
    SELECT nombre, descripción FROM bosque WHERE id_bosque = {$id_bosque};

    SELECT COUNT(id_bosque_like) FROM bosque_like WHERE id_bosque = {$id_bosque};

    SELECT id_bosque_like FROM bosque_like WHERE id_bosque = {$} AND id_usuario = {$uid};

(2) 
    SELECT nombre, descripción FROM bosque WHERE id_bosque = {$id_bosque};

    SELECT COUNT(id_bosque_like) FROM bosque_like WHERE id_bosque = {$id_bosque};

(3)
    
    SELECT bosque_especie.id_especie, especie.nombre FROM bosque_especie INNER JOIN especie ON bosque_especie.id_especie = especie.id_especie WHERE bosque_especie.id_bosque= {$id_bosque};

(4)
    SELECT bosque_etiqueta.id_bosque_etiqueta, etiqueta.nombre FROM bosque_etiqueta INNER JOIN etiqueta ON bosque_etiqueta.id_etiqueta = etiqueta.id_etiqueta WHERE bosque_etiqueta.id_bosque = {$id_bosque};

 (5)
    SELECT id_imagen FROM bosque_imagen WHERE id_bosque = {$id_bosque} ORDER BY id_imagen DESC;   


## adicionales
(1)
    SELECT id_imagen FROM etiqueta_imagen WHERE id_etiqueta = {$id_etiqueta} GROUP BY id_imagen DESC;

(2) 
    SELECT id_imagen FROM imagen_especie WHERE id_especie = {$id_especie} ORDER BY id_imagen DESC;

## check

(1)
    DELETE FROM imagen WHERE id_imagen = {$id_imagen};

(2)
    INSERT INTO etiqueta(nombre) VALUES
({$nombre});

(3)
    DELETE FROM etiqueta WHERE id_etiqueta = {$id_etiqueta};

(4)
    INSERT INTO bosque_etiqueta(id_bosque, id_etiqueta) VALUES
({$id_bosque},{$id_etiqueta});