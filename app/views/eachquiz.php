<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Each quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>

<div class="container-lg">
    <div class="info">
        <div class="col-md-12 mt-4">
            <div class="card">
            <div style="float: right; margin-top: 10px;">
                <button onclick="back()" class="btn btn-primary" style="margin-left: auto; margin-bottom: 10px;">← Back to list</button>
                <button onclick="confirmLogout()" class="btn btn-danger" style="margin-left: 65em; margin-bottom: 10px;">Log Out→</button>
            </div>

            <!-- Display the table header outside of the loop -->
            <div class="card-header bg-primary text-white text-center">
                <h3 style="text-align: center"><?= $data[0]['quiz_title']; ?></h3>
            </div>

            <div class="card-body bg-secondary">
                <table class="table table-dark table-hover table-bordered text-center">
                    <thead class="bg-info text-white text-center">
                        <tr>
                            <th>No.</th>
                            <th>Quiz Note</th>
                            <th>Quiz Question</th>
                            <th>Quiz Type</th>
                            <th>Quiz Answer Options</th>
                            <th>Correct Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light text-white">
                        <!-- Start of foreach loop to display all quizzes -->
                        <?php foreach ($data as $info) : ?>
                            <tr>
                                <td><?= $info['id']; ?></td>
                                <td><?= $info['quiz_note']; ?></td>
                                <td><?= $info['quiz_question']; ?></td>
                                <td><?= $info['quiz_type']; ?></td>
                                <td><?= $info['quiz_answer']; ?></td>
                                <td><?= $info['correct_answer']; ?></td>
                                <td>
                                    <a class="btn btn-primary me-2" href="<?= isset($info['id']) ? '/eachquiz/edit/' . $info['id'] : '#'; ?>"  data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-bs-placement="top" title="Edit" onclick="populateEditModal(<?= $info['id']; ?>, '<?= $info['quiz_note']; ?>', '<?= $info['quiz_question']; ?>', '<?= $info['quiz_type']; ?>', '<?= $info['quiz_answer']; ?>', '<?= $info['correct_answer']; ?>')">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger ms-2" data-bs-target="#deleteModal" data-bs-toggle="modal" data-bs-placement="top"
                                    title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- End of foreach loop -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this Quiz?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="deleteQuiz(<?= $info['id'] ?>)">Delete</button>
        </div>
      </div>
      
    </div>
</div>

<!-- Modal for Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to edit the quiz details -->
                <form id="editForm" action="eachquiz/submitedit/" . $edit['id']: "submit"?>" method="POST">
                    <div class="mb-3">
                        <label for="editQuizNote" class="form-label">Quiz Note</label>
                        <input type="text" class="form-control" id="editQuizNote"  required>
                    </div>
                    <div class="mb-3">
                        <label for="editQuizQuestion" class="form-label">Quiz Question</label>
                        <input type="text" class="form-control" id="editQuizQuestion"  required>
                    </div>
                    <div class="mb-3">
                        <label for="editQuizType" class="form-label">Quiz Type</label>
                        <select name="editQuizType" class="form-control" id="editQuizType" required onchange="toggleAnswerOptions()">
                            <option>--Select Option--</option>
                            <option value="multiplechoice">multiplechoice</option>
                            <option value="identification">identification</option>  
                            <option value="checkbox">checkbox</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editQuizAnswer" class="form-label">Quiz Answer Options</label>
                        <?php
                            $disabled = ($data[0]['quiz_type'] === 'identification') ? 'disabled' : '';
                        ?>
                        <input type="text" class="form-control" id="editQuizAnswer" required <?= $disabled; ?>>
                    </div>
                    <div class="mb-3">
                        <label for="editCorrectAnswer" class="form-label">Correct Answer</label>
                        <input type="text" class="form-control" id="editquizCorrectAnswer" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateQuiz()">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



<script>
     document.addEventListener('DOMContentLoaded', function () {
        toggleAnswerOptions(); // Initial call to set the initial state

        // Function to toggle the answer options based on the selected quiz type
        function toggleAnswerOptions() {
            var quizType = document.getElementById('editQuizType').value;
            var answerOptionsInput = document.getElementById('editQuizAnswer');

            // Disable the input if the Quiz Type is "Identification," otherwise enable it
            answerOptionsInput.disabled = (quizType === 'identification');
        }

        // Attach the function to the onchange event of the quiz type select
        document.getElementById('editQuizType').addEventListener('change', toggleAnswerOptions);
    });
    $(document).ready(function () {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
    });
    
    function deleteQuiz(id) {
        window.location.href = "<?= site_url('/eachquiz/delete/') ?>" + id;
    }
    function back() {
        console.log("Back button clicked");
        window.location.href = "/create_quiz";
    }

    function confirmLogout() {
    console.log("Confirm Logout button clicked");
    var isConfirmed = confirm("Are you sure you want to logout?");
    if (isConfirmed) {
        logout();
        }
    }
    function logout() {
        console.log("Logout button clicked");
        window.location.href = "/login";
    }

    function back() {
        window.location.href = "/yourquizzes";
    }

    function populateEditModal(id, quizNote, quizQuestion, quizType, quizAnswer, quizCorrectAnswer) {
        $('#editQuizNote').val(quizNote);
        $('#editQuizQuestion').val(quizQuestion);
        $('#editQuizType').val(quizType);
        $('#editQuizAnswer').val(quizAnswer);
        $('#editquizCorrectAnswer').val(quizCorrectAnswer);

        // Assuming you have a hidden input to store the quiz ID
        $('#editForm').append('<input type="hidden" name="editid" value="' + id + '">');
    }

    $(document).ready(function () {
        var editModal = new bootstrap.Modal(document.getElementById('editModal'), {});
        
        // This is just an example. You should trigger this function when the edit button is clicked.
        $('#editButton').on('click', function () {
            // Assuming you have access to the quiz data in your JavaScript
            var id = 1; // Replace with the actual quiz ID
            var quizNote = "Sample Quiz Note"; // Replace with the actual quiz note
            var quizQuestion = "Sample Quiz Question"; // Replace with the actual quiz question
            var quizType = "Sample Quiz Type"; // Replace with the actual quiz type
            var quizAnswer = "Sample Quiz Answer"; // Replace with the actual quiz answer
            var quizCorrectAnswer = "Sample Correct Answer"; // Replace with the actual quiz answer

            populateEditModal(id, quizNote, quizQuestion, quizType, quizAnswer, quizCorrectAnswer);

            editModal.show();
        });
    });

    function updateQuiz() {
    // Implement the logic to update the quiz using AJAX or other methods
    // For simplicity, let's assume a form submission
        $('#editForm').submit();  // Use the correct form ID
}

    function toggleAnswerOptions() {
    var quizType = document.getElementById('editQuizType').value;
    var answerOptionsInput = document.getElementById('editQuizAnswer');

    // Disable the input if the Quiz Type is "Identification," otherwise enable it
    answerOptionsInput.disabled = (quizType === 'identification');
}
    
    
</script>


</body>
</html>