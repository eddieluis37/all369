<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Evaluación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="form-edit" enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ method_field('PUT') }} {{ csrf_field() }}

                    <input type="hidden" class="form-control" name="review_id">


                    <div class="form-row">
                        <fieldset class="form-group col-12">
                            <label for="forprogram">Evaluación</label>
                            @if(request()->routeIs('reviews.index'))
                            <select name="answer" id="answer" class="form-control">
                                    <option value=""></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    <option value="REGULAR">REGULAR</option>
                                
                            </select>
                            @else
                            <select name="score" id="score" class="form-control">
                                    <option value=""></option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                            </select>
                            @endif
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <label for="date_end" class="col-form-label">Observaciones:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="observation" rows="5"></textarea>
                    </div>

                    <p><em><small></small></em></p>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
