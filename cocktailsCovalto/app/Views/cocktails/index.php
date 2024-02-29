<!-- muestra la tabla con los registros de cocktails -->

<?php echo $this->extend('template'); ?>

<?= $this->section('contenido'); ?>


<h3 class="my-3" id="titulo">Cocktails</h3>

<a href="<?= base_url('cocktails/new') ?>" class="btn btn-success">Agregar</a>

<!-- Para obtener los datos de la api -->
<form action="<?= base_url('cocktails/importFromApi'); ?>" method="post">
    <button type="submit" class="btn btn-primary">Importar de API</button>
</form>


<table class="table table-hover table-bordered my-3" aria-describedby="titulo">
    <thead class="table-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">idDrink</th>
            <th scope="col">strDrink</th>
            <th scope="col">strCategory</th>
            <th scope="col">strAlcoholic</th>
            <th scope="col">strGlass</th>
            <th scope="col">strInstructions</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($cocktails as $cocktails): ?>
            <tr>
                <td>
                    <?= $cocktails['id']; ?>
                </td>
                <td>
                    <?= $cocktails['idDrink']; ?>
                </td>
                <td>
                    <?= $cocktails['strDrink']; ?>
                </td>
                <td>
                    <?= $cocktails['strCategory']; ?>
                </td>
                <td>
                    <?= $cocktails['strAlcoholic']; ?>
                </td>
                <td>
                    <?= $cocktails['strGlass']; ?>
                </td>
                <td>
                    <?= $cocktails['strInstructions']; ?>
                </td>
                <td>
                    <!-- botones para editar o eliminar -->
                    <a href="<?= base_url('cocktails/' . $cocktails['id'] . '/edit'); ?>"
                        class="btn btn-warning btn-sm me-2">Editar</a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#eliminaModal"
                        data-bs-url="<?= base_url('cocktails/' . $cocktails['id']); ?>">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $pager->links(); ?>
<!-- modal para eliminar registro -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eliminaModalLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Esta seguro de eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <form id="form-elimina" action="" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>


    <?= $this->endSection(); ?>

    <?= $this->section('script'); ?>

    <script>

        const eliminaModal = document.getElementById('eliminaModal')
        if (eliminaModal) {
            eliminaModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')

                const form = eliminaModal.querySelector('#form-elimina')
                form.setAttribute('action', url)
            })
        }
    </script>


    <?= $this->endSection(); ?>