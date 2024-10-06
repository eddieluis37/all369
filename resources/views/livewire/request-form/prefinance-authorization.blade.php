<div>
    <div class="table-responsive">
      @if($requestForm->type_form == 'bienes y/o servicios')
      <h6><i class="fas fa-info-circle"></i> Lista de Bienes y/o Servicios</h6>
      <table class="table table-condensed table-hover table-bordered table-sm small">
          <thead>
              <tr>
                  <th>Item</th>
                  <th>ID</th>
                  <th width="250 px">Item Pres.</th>
                  <th>Artículo</th>
                  <th>UM</th>
                  <th>Especificaciones Técnicas</th>
                  <th>Archivo</th>
                  <th>Cantidad</th>
                  <th>Valor U.</th>
                  <th>Impuestos</th>
                  <th>Total Item</th>
              </tr>
          </thead>
          <tbody>
            @foreach($requestForm->itemRequestForms as $key => $item)
              <tr>
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$item->id}}</td>
                  <td>
                    <div wire:ignore id="for-bootstrap-select-{{$item->id}}" wire:key="{{ $item->id }}">
                      <select  wire:model="arrayItemRequest.{{ $item->id }}.budgetId" wire:click="resetError" data-container="#for-bootstrap-select-{{$item->id}}"
                        class="form-control form-control-sm selectpicker" data-size="5" data-live-search="true" title="Seleccione..." required>
                          @foreach($lstBudgetItem as $val)
                            <option value="{{$val->id}}">{{$val->code.' - '.$val->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    @error('arrayItemRequest.'.$item->id.'.budgetId') <span class="error text-danger">{{ $message }}</span> @enderror
                  </td>
                  <td>
                    @if($item->product_id)
                      {{ optional($item->product)->code}} {{ optional($item->product)->name }}
                    @else
                        {{ $item->article }}
                    @endif
                  </td>
                  <td>{{$item->unit_of_measurement}}</td>
                  <td>{!! $item->specification !!}</td>
                  <td align="center">
                    @if($item->article_file)
                      <a href="{{ route('request_forms.show_item_file', $item) }}" target="_blank">
                        <i class="fas fa-file"></i>
                    @endif
                  </td>
                  <td align="right">{{$item->quantity}}</td>
                  <td align="right">{{ str_replace(',00', '', number_format($item->unit_value, 2,",",".")) }}</td>
                  <td>{{$item->tax}}</td>
                  <td align="right">{{ number_format($item->expense,$requestForm->precision_currency,",",".") }}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="5" rowspan="2"></td>
                  <td colspan="3">Valor Total</td>
                  <td colspan="3" align="right">{{$requestForm->symbol_currency}}{{ number_format($requestForm->estimated_expense,$requestForm->precision_currency,",",".") }}</td>
              </tr>
          </tfoot>
      </table>
      
      @else
      <!-- Pasajeros -->
        <h6><i class="fas fa-info-circle"></i> Lista de Pasajeros</h6>
        <table class="table table-condensed table-hover table-bordered table-sm small">
        <thead class="text-center small">
            <tr>
            <th>#</th>
            <th width="70">RUT</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Fecha Nac.</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>Item Pres.</th>
            <th>Tipo viaje</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha ida</th>
            <th>Fecha vuelta</th>
            <th>Equipaje</th>
            <th>Total pasaje</th>
            </tr>
        </thead>
        <tbody class="small">
            @foreach($requestForm->passengers as $key => $passenger)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ number_format($passenger->run, 0, ",", ".") }}-{{ $passenger->dv }}</td>
                        <td>{{ $passenger->name }}</td>
                        <td>{{ $passenger->fathers_family }} {{ $passenger->mothers_family }}</td>
                        <td>{{ $passenger->birthday ? $passenger->birthday->format('d-m-Y') : '' }}</td>
                        <td>{{ $passenger->phone_number }}</td>
                        <td>{{ $passenger->email }}</td>
                        <td>
                          <div wire:ignore id="for-bootstrap-select-{{$passenger->id}}" wire:key="{{ $passenger->id }}">
                            <select  wire:model="arrayItemRequest.{{ $passenger->id }}.budgetId"  wire:click="resetError" data-container="#for-bootstrap-select-{{$passenger->id}}"
                              class="form-control form-control-sm selectpicker" data-size="5" data-live-search="true" title="Seleccione..." required>
                                @foreach($lstBudgetItem as $val)
                                  <option value="{{$val->id}}">{{$val->code.' - '.$val->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          @error('arrayItemRequest.'.$passenger->id.'.budgetId') <span class="error text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>{{ isset($round_trips[$passenger->round_trip]) ? $round_trips[$passenger->round_trip] : '' }}</td>
                        <td>{{ $passenger->origin }}</td>
                        <td>{{ $passenger->destination }}</td>
                        <td>{{ $passenger->departure_date ? $passenger->departure_date->format('d-m-Y H:i') : '' }}</td>
                        <td>{{ $passenger->return_date ? $passenger->return_date->format('d-m-Y H:i') : '' }}</td>
                        <td>{{ isset($baggages[$passenger->baggage]) ? $baggages[$passenger->baggage] : '' }}</td>
                        <td align="right">{{ number_format($passenger->unit_value, $requestForm->precision_currency, ",", ".") }}</td>
                    </tr>
            @endforeach
        </tbody>
        <tfoot class="text-right small">
            <tr>
            <td colspan="14">Valor Total</td>
            <td>{{$requestForm->symbol_currency}}{{ number_format($requestForm->estimated_expense, $requestForm->precision_currency,",",".") }}</td>
            </tr>
        </tfoot>
        </table>
    @endif

        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-signature"></i></a> Autorización Refrendación Presupuestaria
            </div>
            <div class="card-body">
                <div class="form-row">
                    <fieldset class="form-group col-sm-5">
                        <label for="forRut">Responsable:</label>
                        <input wire:model.live="userAuthority" name="userAuthority" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>

                    <fieldset class="form-group col-sm-2">
                        <label>Cargo:</label><br>
                        <input wire:model.live="position" name="position" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>

                    <fieldset class="form-group col-sm-5">
                        <label for="forRut">Unidad Organizacional:</label>
                        <input wire:model.live="organizationalUnit" name="organizationalUnit" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>
                </div>
                <div class="form-row">
                    {{--<fieldset class="form-group col-sm-4">
                        <label for="forRut">Folio Requerimiento SIGFE:</label>
                        <input wire:model="sigfe" name="sigfe" wire:click="resetError" class="form-control form-control-sm" type="text">
                        @error('sigfe') <span class="error text-danger">{{ $message }}</span> @enderror
                    </fieldset>

                    <fieldset class="form-group col-sm-4">
                      <label>Programa Asociado:</label><br>
                      <input wire:model="program" name="program" wire:click="resetError" class="form-control form-control-sm" type="text">
                      @error('program') <span class="error text-danger">{{ $message }}</span> @enderror
                    </fieldset>--}}

                    <fieldset class="form-group col-sm-5">
                      <label>Programa Asociado: @if($program) <span class="badge badge-secondary">{{$program}}</span> @endif</label><br>
                      <select wire:model.live="program_id" name="program_id" class="form-control form-control-sm " required>
                          <option value="">Seleccione...</option>
                          @foreach($lstProgram as $val)
                              <option value="{{$val->id}}">{{$val->alias_finance}} {{$val->period}} - Subtítulo {{$val->Subtitle->name}}</option>
                          @endforeach
                      </select>
                      @error('program_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </fieldset>

                    <fieldset class="form-group col-sm-2">
                        <label for="forRut">Folio SIGFE:</label>
                        <input wire:model.live="sigfe" name="sigfe" wire:click="resetError" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>

                    <fieldset class="form-group col-sm-2">
                        <label for="forRut">Financiamiento</label>
                        <input wire:model.live="financial_type" name="financial_type" wire:click="resetError" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>
                </div>



                <div class="form-row">
                    <fieldset class="form-group col-sm-12">
                        <label for="for_comment">Observación:</label>
                        <textarea wire:model="comment" wire:click="resetError" name="comment" class="form-control form-control-sm" rows="3"></textarea>
                        @error('comment') <span class="error text-danger">{{ $message }}</span> @enderror
                        </fieldset>
                </div>

                <div class="row justify-content-md-end mt-0">
                    <div class="col-2">
                        <button type="button" wire:click="acceptRequestForm" class="btn btn-primary btn-sm float-right">Autorizar</button>
                    </div>
                    <div class="col-1">
                        <button type="button" wire:click="rejectRequestForm" class="btn btn-secondary btn-sm float-right">Rechazar</button>
                    </div>
                </div>
            </div>
        </div>

</div>
