<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Quiz Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../public/images/black.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color:white;
        }

        .btnadd {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .glow {
            animation: glowing 3s infinite;
        }

        @keyframes glowing {
            0% {
                background-color: #ffcc00; /* Initial color */
                box-shadow: 0 0 10px #ffcc00, 0 0 20px #ffcc00, 0 0 30px #ffcc00;
            }
            50% {
                background-color: #ff9900; /* Mid color */
                box-shadow: 0 0 20px #ff9900, 0 0 30px #ff9900, 0 0 40px #ff9900;
            }
            100% {
                background-color: #ffcc00; /* Final color */
                box-shadow: 0 0 10px #ffcc00, 0 0 20px #ffcc00, 0 0 30px #ffcc00;
            }
        }

        .header {
            background-color: #0D6EFD;
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .container {
            padding: 20px;
        }

        .subcomment {
            font-size: 15px;
        }

        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            resize: vertical;
        }

        .answer-container {
            display: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

x   
    </style>
</head>

<body>

<div class="header">
    <div style="float: right; margin-top: 10px;">
        <button onclick="confirmLogout()" class="btn btn-danger" style="margin-left: auto">Logout</button>
    </div>
    <h1>Create Your Own Quiz!</h1>
    <button onclick="addForm()" class="btnadd">Add Question</button>
    <a href="/yourquizzes"><button class="btnadd">View Your Quizzes</button></a>
</div>

    <div class="container">
    <?php
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Include the JavaScript code for showing the success alert
        echo '<script>showSuccessAlert();</script>';
    }
    ?>
    
        <form method="post" action="<?= site_url('create_quizzes');?>" id="formContainer">
        <h2>Quiz Title:</h2>    
        <textarea id="quiz_title" name="quiz_title" placeholder="Write Quiz Title" required></textarea>
        <h2>Note:<p class="subcomment">(Optional)</p></h2>
        <textarea id="note" name="note" placeholder="Write your note.."></textarea>
            <label for="question">Question</label>
            <input type="text" name="question" class="question" placeholder="Enter question..." required>
            <label for="selecttype">Answer Type</label>
            <select name="selecttype" class="formType" onchange="showAnswerFields(this)" required>
                <option>--Select Option--</option>
                <option value="multiplechoice">Multiple Choice</option>
                <option value="identification">Identification</option>
                <option value="checkbox">Check Box</option>
            </select>
            <label for="correct_answer">Correct Answer</label>
            <input type="text" name="correct_answer" placeholder="Enter the correct answer" required>  

            <div class="answer-container" id="answerContainer">
            </div><hr>/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/<hr>

            <button type="submit" class="btn btn-primary">Save Quiz</button>
        </form>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
 
 function confirmLogout() {
        var isConfirmed = confirm("Are you sure you want to logout?");
        if (isConfirmed) {
            logout();
        }
    }

function logout() {
        // Implement your logout logic here
        // For example, redirect the user to the logout page
        window.location.href = "/login";
    }

    let formCounter = 1;

    function addForm() {
        var original = document.querySelector('form');
        var cloned = original.cloneNode(true);

        // Update the name attributes to avoid conflicts
        cloned.querySelectorAll('[name]').forEach(element => {
            element.name = element.name + formCounter;
        });

        formCounter++;

        // Remove the previous "Save Quiz" button
        const prevSaveQuizButton = document.querySelector('.btn');
        if (prevSaveQuizButton) {
            prevSaveQuizButton.parentNode.removeChild(prevSaveQuizButton);
        }

        document.getElementById('formContainer').appendChild(cloned);
        showSuccessAlert();
    }

    function showAnswerFields(selectElement) {
        var answerContainer = selectElement.parentNode.querySelector('.answer-container');
        var selectedType = selectElement.value;

        // Reset the answer container
        answerContainer.innerHTML = '';

        // Show the answer container for the selected type
        if (selectedType !== '--Select Option--') {
            answerContainer.style.display = 'block';

            // Add specific answer fields based on the selected type
            if (selectedType === 'multiplechoice') {
                answerContainer.innerHTML = '<label for="quiz_answer">Options (comma-separated)</label>' +
                    '<input type="text" name="quiz_answer" placeholder="Option 1, Option 2, ...">';
             } // else if (selectedType === 'identification') {
            //     answerContainer.innerHTML = '<label for="quiz_answer">Correct Answer</label>' +
            //         '<input type="text" name="quiz_answer" placeholder="Correct Answer">';}
             else if (selectedType === 'checkbox') {
                answerContainer.innerHTML = '<label for="quiz_answer">Options (comma-separated)</label>' +
                    '<input type="text" name="quiz_answer" placeholder="Option 1, Option 2, ...">';
            }
        } else {
            answerContainer.style.display = 'none';
        }
        // showSuccessAlert();   after clicking the desired type of answer
    }

    // setInterval(function () {
    //     var glowButton = document.getElementById('glowButton');
    //     glowButton.classList.add('glow');

    //     // Remove the 'glow' class after the animation duration
    //     setTimeout(function () {
    //         glowButton.classList.remove('glow');
    //     }, 3000);
    // }, 6000);

    function showSuccessAlert() {
    var alertContainer = document.createElement('div');
    alertContainer.classList.add('alert', 'alert-success', 'mt-3');
    alertContainer.innerHTML = '<strong>Success!</strong> Form has been successfully added.';
    
    // Insert the alert before the form container
    document.getElementById('formContainer').parentNode.insertBefore(alertContainer, document.getElementById('formContainer'));

    // Automatically dismiss the alert after 3 seconds
    setTimeout(function() {
        alertContainer.remove();
    }, 3000);
}
</script>
</body>

</html>