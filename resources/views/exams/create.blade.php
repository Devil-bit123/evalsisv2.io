@extends('voyager::master')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<div class="card">
    <div class="card-body">
        Creación de banco de preguntas para {{ $course->name }}
    </div>
</div>

<div class="input-group mb-3">
    <span class="input-group-text" id="inputBankName">Nombre del banco de preguntas</span>
    <input id="bankName" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
</div>

<div class="input-group">
    <span class="input-group-text">Descripcion</span>
    <textarea id="bankDescription" class="form-control" aria-label="With textarea"></textarea>
</div>



<!-- Modelo de pregunta -->

<h2>Ingreso de Preguntas</h2>

<div id="questionsContainer">
    <!-- Aquí se agregarán dinámicamente las preguntas -->
</div>

<button type="button" class="btn btn-primary" onclick="addQuestion()">Agregar Nueva Pregunta</button>
<button type="button" class="btn btn-success" onclick="saveQuestions()">Guardar Preguntas</button>

<script>
    let questions = [];

    let courseId = {{ $course->id }};


    function addQuestion() {
        const questionsContainer = document.getElementById('questionsContainer');

        const questionForm = document.createElement('form');
        questionForm.innerHTML = `

        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar" style="width: 100%"></div>
</div>

        <label for="questionTitle">Título de la Pregunta:</label>
        <input type="text" name="questionTitle" required>

        <label for="responses">Respuestas:</label>
        <div class="responses">
          <div>
            <input type="text" name="response" required>
            <label>
              Correcta
              <input type="radio" name="correctResponse" value="0">
            </label>
            <button type="button" class="btn btn-warning" onclick="removeResponse(this)">Eliminar Respuesta</button>
          </div>
        </div>

        <button type="button" class="btn btn-info" onclick="addResponse(this)">Agregar Respuesta</button>
        <button type="button" class="btn btn-danger" onclick="removeQuestion(this)">Eliminar Pregunta</button>
      `;

        questionsContainer.appendChild(questionForm);
    }

    function addResponse(button) {
        const responsesDiv = button.parentElement.querySelector('.responses');
        const responseCount = responsesDiv.children.length;

        const responseDiv = document.createElement('div');
        responseDiv.innerHTML = `
        <input type="text" name="response" required>
        <label>
          Correcta
          <input type="radio" name="correctResponse" value="${responseCount}">
        </label>
        <button type="button" class="btn btn-warning" onclick="removeResponse(this)">Eliminar Respuesta</button>
      `;

        responsesDiv.appendChild(responseDiv);
    }

    function removeResponse(button) {
        const responseDiv = button.parentNode;
        const responsesDiv = responseDiv.parentNode;
        responsesDiv.removeChild(responseDiv);

        // Reindexar los valores de los radio buttons después de eliminar una respuesta
        const radioButtons = responsesDiv.querySelectorAll('input[type="radio"]');
        radioButtons.forEach((radio, index) => {
            radio.value = index.toString();
        });
    }

    function removeQuestion(button) {
        const questionForm = button.parentNode;
        const questionsContainer = document.getElementById('questionsContainer');
        questionsContainer.removeChild(questionForm);
    }

    function saveQuestions() {
    const questionForms = document.querySelectorAll('#questionsContainer form');

    const bankName = document.getElementById('bankName').value;
    const bankDescription = document.getElementById('bankDescription').value;


    questions = Array.from(questionForms).map((form) => {
        const title = form.querySelector('input[name="questionTitle"]').value;
        const responseInputs = form.querySelectorAll('.responses input[name="response"]');
        const correctResponseInput = form.querySelector('input[name="correctResponse"]:checked');

        const responses = Array.from(responseInputs).map((responseInput) => {
            return responseInput.value;
        });

        // Verificar si se ha seleccionado una respuesta correcta
        if (correctResponseInput === null) {
            alert('Debes seleccionar una respuesta correcta para cada pregunta.');
            return null;
        }

        const correctResponseIndex = correctResponseInput.value;
        const correctResponseText = responses[correctResponseIndex];

        return { title, responses, correct_asnwer_index: correctResponseIndex, correct_asnwer_text: correctResponseText };
    });

    // Si alguna pregunta no tiene respuesta correcta, detener el proceso
    if (questions.some(question => question === null)) {
        return;
    }

    // Aquí puedes hacer la solicitud AJAX
    $.ajax({
        url: '/admin/course/' + courseId + '/exams',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ questions,bankName, bankDescription  }),
        success: function(response) {
            alert('Examen guardado exitosamente.');
            window.location.href = '/admin/exams';
        },
        error: function(error) {
            console.error('Error al guardar el examen:', error);
        }
    });
}



</script>

@endsection
