<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 14px; color: #6c757d;">Se esta eliminando la cita</p>
                <div class="text-center">
                    <p style="font-size: 16px; alignment: center;">¿Deseas continuar?</p>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <form action="{{ route('cita.destroy') }}" method="post" id="form-delete">
                    @csrf
                    <input type="hidden" id="idCita" name="idCita" value="0">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </form>
            </div>
        </div>
    </div>
</div>
