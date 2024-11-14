<fieldset>
    <legend>Informacion General</legend>
                
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="vehiculo[titulo]" placeholder="Titulo vehiculo" value="<?php echo s($vehiculo -> titulo); ?>">
                
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="vehiculo[precio]" placeholder="Precio vehiculo" value="<?php echo s($vehiculo -> precio); ?>">
                
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="vehiculo[imagen]">
        <?php if($vehiculo -> imagen): ?>
            <img src="/imagenes/<?php $vehiculo -> imagen ?>" class="imagen-small">
        <?php endif; ?>
                
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="vehiculo[descripcion]"><?php echo s($vehiculo -> descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion vehiculo</legend>
                
    <label for="modelo">Modelo:</label>
    <input type="number" id="modelo" name="vehiculo[modelo]" placeholder="Ej:   2000" min="2000" max="2024" value="<?php echo s($vehiculo -> modelo); ?>">
                
    <label for="puertas">Puertas:</label>
    <input type="number" id="puertas" name="vehiculo[puertas]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($vehiculo -> puertas); ?>">
                
    <label for="motor">Motor:</label>
    <input type="number" id="motor" name="vehiculo[motor]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($vehiculo -> motor); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor">Vendedor</label>
    <select name="vehiculo[vendedorId]" id="vendedor">
    <option selected value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor): ?>
            <option 
                <?php echo $vehiculo -> vendedorId === $vendedor -> id ? 'selected' : ''; ?> 
                value="<?php echo s($vendedor -> id) ?>"><?php echo s($vendedor -> nombre) . " " . s($vendedor -> apellido); ?>
            </option>
        <?php endforeach; ?>
    </select>

</fieldset>
            