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
    SELECT especie.id_especie , especie.nombre FROM especie INNER JOIN imagen_especie ON especie.id_especie = imagen_especie.id_especie WHERE imagen_especie.id_imagen = 3;


