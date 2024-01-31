<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Quiz</title>
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Quiz Title</h5>
            </div>
            <div class="card-body">
                <form id="quizForm">
                    <!-- Quiz questions and options go here -->
                    <div class="form-group">
                        <label for="question1">Question 1: What is the capital of France?</label>
                        <select class="form-control" id="question1" name="question1">
                            <option value="paris">Paris</option>
                            <option value="berlin">Berlin</option>
                            <option value="london">London</option>
                        </select>
                    </div>

                    <!-- Add more questions and options as needed -->

                    <button type="submit" class="btn btn-primary">Submit Quiz</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>