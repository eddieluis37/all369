<div class="card">
    <div class="card-header">
        Fondo a rendir
    </div>
    <div class="card-body">
      <div class="form-row align-items-center">
          <fieldset class="form-group col-2">
              <label for="for_date">Fecha</label>
              <input type="date" class="form-control form-control-sm" id="for_date" name="date"
                  value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
          </fieldset>

          <fieldset class="form-group col-2">
              <label for="for_document_id">Código interno Memo</label>
              <input type="number" class="form-control form-control-sm" id="for_document_id" name="document_id"
                  value="{{ old('document_id') }}" required>
          </fieldset>

          <fieldset class="form-group col-2">
              <label for="for_amount">Monto total</label>
              <input type="number" step="0.01" min="1" class="form-control form-control-sm amount" id="for_amount" name="amount"
                  value="{{ old('amount') }}" required>
          </fieldset>
      </div>
      <button type="submit" class="btn btn-primary float-right" id="save_btn">
          <i class="fas fa-save"></i> Guardar
      </button>
      </form>
    </div>
</div>