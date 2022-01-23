<form name="MiForm" id="MiForm" method="post" action="upload.image.php" enctype="multipart/form-data">
  <h4>Comparta sus Imagenes</h4>
  <p>Suba sus imagenes aqui</p>
  <!--
     <div>
    <label>Archivos</label>
    <div>
      <input type="file" id="image" name="image" multiple>
    </div>
    <button name="submit">Cargar Imagen</button>
  </div>
    -->

  <div>
    <label>Descripcion</label>
    <textarea id="text" class="materialize-textarea" name="descripcion" id="descripcion" maxlength="300"></textarea>
  </div>

  <div class="file-field input-field">

    <div class="btn">
      <span>Elegir Archivo</span>
      <input type="file" id="file" name="file">
    </div>

    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" multiple>
    </div>
  </div>

  <button class="btn waves-effect waves-light" type="submit" name="submit">Enviar
    <i class="material-icons right">send</i>
  </button>

  
</form>