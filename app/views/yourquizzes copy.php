<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Quizzes info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>

<div class="container">
    <div class="info">
        <div class="col-md-12 mt-4">
            <div class="card">
            <div style="float: right; margin-top: 10px;">
                <button onclick="back()" class="btn btn-primary" style="margin-left: auto; margin-bottom: 10px;">← Back to quiz</button>
                <button onclick="confirmLogout()" class="btn btn-danger" style="margin-left: 77%; margin-bottom: 10px;">Log Out→</button>
            </div>

                <div class="card-header bg-primary text-warning">
                    <h3 style="text-align: center">Quiz Information</h3>
                </div>
                <div class="card-body bg-secondary">
                    <table class="table table-dark table-hover table-bordered text-center">
                        <thead class="bg-info text-white text-center">
                            <tr>
                                <th>ID</th>
                                <th>Quiz Title</th>
                                <th>Quiz Note</th>
                                <th>Quiz Question</th>
                                <th>Quiz Type</th>
                                <th>Quiz Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-light text-white">
                        <?php foreach ($data as $info) : ?>
                            <tr>
                                <td><?= $info['id']; ?></td>
                                <td><?= $info['quiz_title']; ?></td>
                                <td><?= $info['quiz_note']; ?></td>
                                <td><?= $info['quiz_question']; ?></td>
                                <td><?= $info['quiz_type']; ?></td>
                                <td><?= $info['quiz_answer']; ?></td>
                                <td>
            <a class="btn btn-primary me-2" href="" data-bs-toggle="modal" data-bs-target="#editModal"
              data-bs-placement="top" title="Edit">
              <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger ms-2" data-bs-target="#deleteModal" data-bs-toggle="modal" data-bs-placement="top"
              title="Delete">
              <i class="fas fa-trash-alt"></i>
            </a>
          </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
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


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



<script>
    $(document).ready(function () {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
    });
    
    function deleteQuiz(quizId) {
        // You can use AJAX or redirect to perform the deletion logic
        // For simplicity, let's assume a redirect
        window.location.href = "<?= site_url('/yourquizzes/delete/') ?>" + quizId;
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
        window.location.href = "/create_quiz";
    }

    
    
</script>
<?php endforeach; ?>

</body>
</html>