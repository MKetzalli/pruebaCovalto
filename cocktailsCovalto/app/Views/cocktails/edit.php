<?php echo $this->extend('template'); ?>

<?= $this->section('contenido'); ?>

<h3 class="my-3">Editar cocktail</h3>

<?php if (session()->getFlashdata('error') !== null){ ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
</div>
<?php } ?>


<!-- formulario para eeditar registros -->
<form action="<?= base_url('cocktails/'.$cocktails['id']); ?>" class="row g-3" method="post" autocomplete="off">

<input type="hidden" name="_method" value="put"> <!-- para que reconozca el put -->
<input type="hidden" name="id" value="<?= $cocktails['id']; ?>">
    <div class="col-md-2">
        <label for="idDrink" class="form-label">id cocktail api</label>
        <input type="text" class="form-control" id="idDrink" name="idDrink" value="<?= $cocktails['idDrink']; ?>" autofocus disabled>
    </div>
    <div class="col-md-10">
        <label for="strDrink" class="form-label">nombre bebida</label>
        <input type="text" class="form-control" id="strDrink" name="strDrink" value="<?= $cocktails['strDrink']; ?>"  required>
    </div>

    <div class="col-md-4">
        <label for="strCategory" class="form-label">categoria</label>
        <select id="strCategory" class="form-control" name="strCategory" required>
            <option selected value="0">Escoger categoria</option>
            <option value="1">Cocktail</option>
            <option value="2">Shot</option>
            <option value="3">Ordinary Drink</option>
            <option value="4">Coffee / Tea</option>
            <option value="5">Other / Unknown</option>
        </select>
    </div>

    <div class="col-md-4">
        <label for="strAlcoholic" class="form-label">contiene alcohol</label>
        <select id="strAlcoholic" class="form-control" name="strAlcoholic" required>
            <option selected value="0">Escoger opcion</option>
            <option value="1">Alcoholic</option>
            <option value="2">Non alcoholic</option>
        </select>
    </div>
    
    <div class="col-md-4">
        <label for="strGlass" class="form-label">tipo de vaso</label>
        <select id="strGlass" class="form-control" name="strGlass" required>
            <option selected value="0">Escoger opcion</option>
            <option value="1">Shot glass</option>
            <option value="2">Martini Glass</option>
            <option value="3">Cocktail glass</option>
            <option value="3">Highball Glass</option>
            <option value="3">Collins Glass</option>
            <option value="3">Old-fashioned glass</option>
        </select>
    </div>

    
    <div class="col-md-12">
        <label for="strInstructions" class="form-label">Instrucciones</label>
        <input type="text" class="form-control" id="strInstructions" name="strInstructions"  value="<?= $cocktails['strInstructions']; ?>"  required>
    </div>



    <div class="col-12">
        <a href="<?= base_url('cocktails'); ?>" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>

<?= $this->endSection(); ?>