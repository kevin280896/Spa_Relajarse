<div class="modal fade" id="mostrar" tabindex="-1" role="dialog" aria-labelledby="show" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('img/logo.png') }}" style="width: 25%">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('loading')
                <div id="info">
                    <img src="" alt="" id="imagen"><h3 id="producto" style="color: #1d643b; font-weight: bold"></h3>
                    <p id="descripcion"></p>
                    <p id="precio"></p>
                    <p id="cantidad"></p>
                    <p id="tipo"></p>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
