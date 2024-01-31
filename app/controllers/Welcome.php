<?php


defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'app/vendor/autoload.php';

class Welcome extends Controller {


	public function __construct(){
		parent::__construct();
		$this->call->helper('url');
		$this->call->library('session');
		$this->call->library('form_validation');
		$this->call->model('User_model');
		$this->call->model('Quiz_model');
		$this->call->database();

	}


	public function index() {
		$this->call->view('welcome_page');
	}
	public function register(){
		$this->call->view('register');
	}
	public function login(){
		$this->call->view('login');
	}
	public function dashboard(){
		$this->call->view('email_form');
	}
	public function account(){
		$this->call->view('account_verify');
	}

	public function register_val(){
		$this->form_validation
			->name('name')
				->required()
				->min_length(3)
				->max_length(20)
			->name('password')
				->required()
				->min_length(8)
			->name('confpassword')
				->matches('password')
				->required()
				->min_length(8)
			->name('email')
				->valid_email();
				if ($this->form_validation->run() == FALSE)
				{
					$this->call->view('register');
				
				}
				else
				{

					$verificationCode = substr(md5(rand()), 0, 8);
					$is_verify = FALSE;

					$this->User_model->insert(
						$this->io->post('name'),
						$this->io->post('password'),
						$this->io->post('email'),
						$verificationCode,
						$is_verify 
					);
		
					$data['email'] = $this->io->post('email');
					$this->call->view('account_verify',$data);

					$verify = $this->getRegisteredEmail();
					$this->session->set_userdata('registered_email', $this->io->post('email'));
				
					$this->sendVerificationEmail($verify, $verificationCode);
				
				}
    }

	public function getRegisteredEmail() {
		return $this->session->userdata('registered_email');
	}

	public function login_val(){

		$this->form_validation
		->name('password')
			->required()
			->min_length(8)
		->name('email')
			->valid_email();

			if ($this->form_validation->run() == FALSE)
			{
				$this->call->view('login');
				
			}
			else
			{
				$email = $this->io->post('email'); 
				$password = $this->io->post('password');
	
				$user = $this->User_model->get_user_by_email($email);

				if ($user) {
					if ($password === $user['password']) {
						if ($user['is_verified']) {
							// User is verified, proceed to the dashboard
							$this->call->view('create_quiz');	//HERE IT IS

						} else {
							$data['email'] = $this->io->post('email');
							$data['error_message'] = 'Verify Your Email'; 
							$this->call->view('account_verify', $data);
						}
					} else {
						$data['error_message'] = 'Invalid password!'; 
						$this->call->view('login', $data);
					}
				} else {
					$data['error_message'] = 'Email Not Found!'; 
					$this->call->view('login', $data);
				}		
			}
	}

	public function email(){
		$mail = new PHPMailer(true);

			$to = $_POST["to"];
			$from = $_POST["from"];
				   
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'junebalaibo03@gmail.com';  
        $mail->Password = 'xgut ifyq tddj npol'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587;  

        $mail->setFrom($_POST['from'], $from); 
        $mail->addAddress($_POST['to'], $to);  

      
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['message'];  

        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
            $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
        }

        try {
            $mail->send();
		
			$data['success_message'] = 'Email has been sent successfully'; 
			$this->call->view('email_form', $data);
        } catch (Exception $e) {
	
			$data['error_message'] = 'Email Not Found!'; 
			$this->call->view('email_form', $data);
        }
	}


	//1
	public function sendVerificationEmail($to, $verificationCode) {
		$mail = new PHPMailer(true);
	
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com'; 
		$mail->SMTPAuth = true;
		$mail->Username = 'junebalaibo03@gmail.com';  
		$mail->Password = 'xgut ifyq tddj npol';  
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
		$mail->Port = 587;  
	

	//	$from = 'junebalaibo03@gmail.com'; 
	//	$mail->setFrom($from, 'June '); 
		$mail->addAddress( $to);  
		// var_dump($email);
		$mail->isHTML(true);
		$mail->Subject = 'Account Verification Code';
		$mail->Body = 'Your verification code is: ' . $verificationCode;


		try {
			$mail->send();
			
			$this->User_model->updateVerificationCode($to, $verificationCode);
			$this->call->view('account_verify');
		} catch (Exception $e) {
			
			echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
		}
	}

//1
public function check() {
	$email = $this->io->post('email');
	$verificationCode = $this->io->post('verify');

	$isVerified = $this->User_model->verifyUser($email, $verificationCode);

	if ($isVerified) {
		$data['email'] = $this->io->post('email');
		$data['success_message'] = 'Email successfully verified!';
		$this->call->view('login', $data);
	} else {
		$data['email'] = $this->io->post('email');
		$data['error_message'] = 'Invalid verification code.';
		$this->call->view('account_verify', $data);
	}
}

// --------------------
// --------------------
// ---- ADMIN SIDE ----
// --------------------
// --------------------
public function create_quiz_get(){
	$this->call->view('create_quiz');
}

public function create_quiz_post() 
    {
        $this->call->view('create_quiz');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quiz_title = isset($_POST['quiz_title']) ? $_POST['quiz_title'] : '';
            $note = isset($_POST['note']) ? $_POST['note'] : '';
            $question = isset($_POST['question']) ? $_POST['question'] : '';
            $selecttype = isset($_POST['selecttype']) ? $_POST['selecttype'] : '';
            $quiz_answer = isset($_POST['quiz_answer']) ? $_POST['quiz_answer'] : '';
            $correct_answer = isset($_POST['correct_answer']) ? $_POST['correct_answer'] : '';
        
            $this->call->model('Quiz_model');  
            $this->Quiz_model->create_quiz($quiz_title, $note, $question, $selecttype, $quiz_answer, $correct_answer);
          
            return redirect('create_quiz');
        }
        // }
    }
	
	public function yourquizzes(){
		$this->call->view('yourquizzes');
	}


	public function displayRow($id) {
        // Load the Quiz_model
        $this->call->model('Quiz_model');

        // Get the row based on the provided ID
        $row = $this->Quiz_model->getRowById($id);

        // Pass the data to the view
        $data['row'] = $row;

        // Load the view
        $this->loacalld->view('yourquizzes', $data);
    }

	public function displayDifTitle() {
        $data = $this->Quiz_model->getDiffRows();
        $this->call->view('yourquizzes', $data);
    }
	public function readAll($quiz_title = null){
		$data = $this->Quiz_model->read($quiz_title);
		$this->call->view('eachquiz', $data);
	}
	
        public function deleteyour($id){
			if($this->Quiz_model->delete($id))
			redirect('/yourquizzes');
		}
	
		public function deleteeach($id){
			if($this->Quiz_model->delete($id))
			redirect('/eachquiz');
		}

		public function edit($id)
		{
			$this->call->model('Quiz_model');
			$data['edit'] = $this->Quiz_model->searchInfo($id);
			$this->call->view('/eachquiz', $data);
		}
		public function submitedit($id)
{
    if(isset($id)){
        $quiz_note =  $this->io->post('editQuizNote'); // Update with the correct field name
        $quiz_question = $this->io->post('editQuizQuestion');
        $quiz_type = $this->io->post('editQuizType');
        $quiz_answer = $this->io->post('editQuizAnswer');
        $correct_answer = $this->io->post('editquizCorrectAnswer'); // Correct the field name
        $data = [
            'quiz_note' => $quiz_note,
            'quiz_question' => $quiz_question,
            'quiz_type' => $quiz_type,
            'quiz_answer' => $quiz_answer,
            'correct_answer' => $correct_answer,
        ];
        $result = $this->Quiz_model->edit($id, $quiz_note, $quiz_question, $quiz_type, $quiz_answer, $correct_answer);
        if ($result) {
            // Handle success
            redirect('/eachquiz'); // Redirect to the quiz listing page
        } else {
            // Handle failure
            // You might want to display an error message to the user
        }
    }
}

// --------------------
// --------------------
// ---- USER SIDE ----
// --------------------
// --------------------

public function user_side() {
    $this->call->model('Quiz_model');
    
    $data['questions'] = $this->Quiz_model->get_quiz_questions();
    
    $this->call->view('User_side', $data);
}

	public function user_result()
	{
		$this->call->model('Quiz_model');
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$quizResults = [];

			foreach ($_POST['answers'] as $question_id => $user_answer) {
				$question_id = (int)$question_id;
				$correct_answer = $this->Quiz_model->get_correct_answer_by_question_id($question_id);

				$is_correct = ($user_answer === $correct_answer) ? 'yes' : 'no';

				$quizResults = [
					'question' => $this->Quiz_model->get_question_text_by_id($question_id),
					'user_answer' => $user_answer,
					'correct_answer' => $correct_answer,
					'is_correct' => $is_correct
				];

				$this->Quiz_model->create_quiz_result($question_id, $user_answer, $correct_answer, $is_correct);
			}

			$this->call->view('User_result', ['quizResults' => $quizResults]);
		} else {
			header('Location: error.php');
			exit();
		}
	}
}
?>