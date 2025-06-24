<style>
  .chamadoexterno__header {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
  }

  .chamadoexterno__header::before,
  .chamadoexterno__header::after {
    content: '';
    flex: 1;
    height: 2px;
    background-color: #00000023;
  }

  .chamadoexterno__header h1 {
    margin: 0 10px;
  }

  .chamadoexterno__body {
    padding: 0 8px;
    width: 100%;
  }

  .chamadoexterno__container {
    width: 100%;
    display: flex;
    flex-direction: column;
  }

  .chamadoexterno__input-container {
    width: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .chamadoexterno__label {
    width: fit-content;
    display: flex;
    gap: 6px;
    align-items: center;
  }
</style>
<div class="chamadoexterno__plugin">
  <div class="chamadoexterno__header">
    <h1>Informações Adicionais</h1>
  </div>
  <div class="chamadoexterno__body">
    <div class="chamadoexterno__container form-field row mb-2">
      <label class="chamadoexterno__label col-form-label text-xxl-end" for="externo-resp">
        Responsável Externo
      </label>
      <div class="chamadoexterno__input-container">
        <input 
          type="text" 
          name="externo-resp" 
          id="externo-resp" 
          class="chamadoexterno__resp-input" 
          value="<?= htmlspecialchars($ticket['responsavel_externo'] ?? '') ?>"
          placeholder="Responsável Externo" 
          aria-label="Responsável Externo" 
        />
      </div>
    </div>
    <div class="chamadoexterno__container form-field row mb-2">
      <label class="chamadoexterno__label col-form-label text-xxl-end" for="prazo_ext_date">
        Prazo de Atendimento Externo
      </label>
      <div class="chamadoexterno__input-container">
        <?php Html::showDateTimeField('prazo_ext_date', [ 'value' => $ticket['prazo_externo'] ?? '' ]); ?>
      </div>
    </div>
    <div class="chamadoexterno__container form-field row mb-2">
      <label class="chamadoexterno__label col-form-label text-xxl-end" for="prazo_ext_date">
        Status Externo
      </label>
      <div class="chamadoexterno__input-container">
        <?php 
          Dropdown::showFromArray(
            'status_ext_dd', 
            [ 'pendente' => "Pendente", 'em_progresso' => "Em Progresso", 'concluido' => "Concluído" ], 
            [ 'display_emptychoice' => true, 'value' => $ticket['status_externo'] ?? '' ]
          ); 
        ?>
      </div>
    </div>
  </div>
</div>