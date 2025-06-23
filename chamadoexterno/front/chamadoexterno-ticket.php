<style>
  /* .chamadoexterno__plugin,
  .chamadoexterno__plugin * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  } */

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
  }

  .chamadoexterno__resp-container,
  .chamadoexterno__resp-input-container {
    width: fit-content;
    display: flex;
    flex-direction: column;
  }

  .chamadoexterno__resp-label {
    width: fit-content;
  }
</style>
<div class="chamadoexterno__plugin">
  <div class="chamadoexterno__header">
    <h1>Informações Adicionais</h1>
  </div>
  <div class="chamadoexterno__body">
    <div class="chamadoexterno__resp-container form-field row mb-2">
      <label class="chamadoexterno__resp-label col-form-label text-xxl-end" for="externo-resp">
        Responsável Externo
      </label>
      <div class="chamadoexterno__resp-input-container">
        <input 
          type="text" 
          name="externo-resp" 
          id="externo-resp" 
          class="chamadoexterno__resp-input" 
          value=""
          placeholder="Responsável Externo" 
          aria-label="Responsável Externo" 
        />
      </div>
   </div>
  </div>
</div>