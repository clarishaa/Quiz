<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .quiz-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .question {
            margin-bottom: 10px;
        }

        .options label {
            display: block;
            margin-bottom: 5px;
        }
    </style>
    <style>
    .correct-answer {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .incorrect-answer {
        background-color: #f8d7da; 
        border-color: #f5c6cb;
    }
</style>

</head>
<body>

<div class="container-fluid">



    <div class="quiz-container">
        <h1 style="text-align: center;">MY Quiz</h1>

        <form id="quizForm" action="/user_result" method="post" onsubmit="return submitQuiz()">
            <?php foreach ($questions as $question): ?>
                <div class="card border-info mb-4">
                    <div class="d-flex justify-content-between align-items-center card-header bg-info text-white">
                        <span><?= $question['quiz_question'] ?></span>
                        <button type="button" data-toggle="collapse" data-target="#q<?= $question['id'] ?>" aria-expanded="false" aria-controls="q<?= $question['id'] ?>" class="btn btn-outline-light">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                    </div>
                    <div id="q<?= $question['id'] ?>" class="collapse show">
                        <div class="card-body">
                            <label for="answer<?= $question['id'] ?>">Your Answer:</label>
                            <input type="text" id="answer<?= $question['id'] ?>" name="answers[<?= $question['id'] ?>]" placeholder="Type your answer here">
                            <input type="hidden" id="correct_answer<?= $question['id'] ?>" value="<?= $question['correct_answer'] ?>">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- The rest of your design -->

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function submitQuiz() {
        var cards = document.querySelectorAll('.card');
        var totalQuestions = cards.length;
        var score = 0;

        cards.forEach(function (card) {
            var userAnswer = card.querySelector('input[type="text"]').value.trim();
            var correctAnswer = card.querySelector('input[type="hidden"]').value.trim();

            if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
                score++;
                card.classList.add('correct-answer');
            } else {
                card.classList.add('incorrect-answer');
            }
        });

        alert('Your score: ' + score + '/' + totalQuestions);

        return true;
    }
</script>

</body>
</html>
