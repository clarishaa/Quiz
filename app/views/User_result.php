<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Quiz Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center">Here are the quiz results!</h2>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>User's Answer</th>
                <th>Correct Answer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quizResults as $result): ?>
            <tr>
                <td><?= $result['question'] ?></td>
                <td><?= $result['user_answer'] ?></td>
                <td><?= $result['correct_answer'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
