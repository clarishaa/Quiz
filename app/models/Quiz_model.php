<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Quiz_model extends Model {

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function create_quiz($quiz_title, $quiz_note, $quiz_question, $quiz_type, $quiz_answer, $correct_answer)
    {
        $quizData = array(
            'quiz_title' => $quiz_title,
            'quiz_note' => $quiz_note,
            'quiz_question' => $quiz_question,
            'quiz_type' => $quiz_type,
            'quiz_answer' => $quiz_answer,
            'correct_answer' => $correct_answer,
        );

        $inserted = $this->db->table('quiz_table')->insert($quizData);

        if (!$inserted) {
            // Log or display the error
            echo $this->db->error(); // Example for displaying the error, replace with logging
        }

        return $inserted;
    }

    public function getRowById($id) {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->row_array();
    }

    // public function getAllRows() {
    //     return $this->db->table('quiz_table')->get_all();
    // }
    public function read($quizTitle = null){
    if ($quizTitle !== null) {
        return $this->db->table('quiz_table')->where('quiz_title', $quizTitle)->get_all();
    } else {
        return $this->db->table('quiz_table')->get_all();
    }
}
    public function getDiffRows(){
        return $this->db->table('quiz_table')->get_all();
    }

    public function delete($id){
        $result = $this->db->table('quiz_table')->where(array('id' => $id))->delete();
        if($result)
            return true;
    }

    public function title(){
        $this->db->table('quiz_table')->select('quiz_title')->get_all();
    }

    public function qname(){
        return $this->db->table('name_table')->get_all();
    }

    public function edit($id, $quiz_title, $quiz_note, $quiz_question, $quiz_type, $quiz_answer, $correct_answer)
{
    $data = array(
        'quiz_title' => $quiz_title,
        'quiz_note' => $quiz_note,
        'quiz_question' => $quiz_question,
        'quiz_type' => $quiz_type,
        'quiz_answer' => $quiz_answer,
        'correct_answer' => $correct_answer,
    );
    $result = $this->db->table('quiz_table')->where('id', $id)->update($data);
    return $result; // Return the result of the update operation
}

    public function quiz_data($id)
    {
        return $this->db->table('quiz_table')->where(array('id' => $id))->get();
    }

    public function searchInfo($id){
        return $this->db->table('quiz_table')->where('id', $id)->get();
    }

    public function get_quiz_questions()
    {
        return $this->db->table('quiz_table')->get_all();
    }
    
    public function insert_quiz_result($question_id, $user_answer, $quiz_answer, $is_correct)
    {
        $data = array(
            'question_id' => $question_id,
            'user_answer' => $user_answer,
            'quiz_answer' => $quiz_answer,
            'is_correct' => $is_correct
        );
    
        return $this->db->insert('quiz_result', $data);
    }

    public function get_correct_answer_by_question_id($question_id)
    {
        // Query the database to retrieve the correct answer for the given question ID
        $query = $this->db->table('quiz_table')->where('id', $question_id)->get();
    
        // Check if the query returned any rows
        if (!empty($query)) {
            // Check if the array key 0 exists
            if (array_key_exists(0, $query)) {
                // Return the value of the 'quiz_answer' column from the first row
                return $query[0]['quiz_answer'];
            } else {
                return false; // Array key 0 does not exist
            }
        } else {
            return false; // No rows returned by the query
        }
    }

    public function get_question_text_by_id($question_id)
    {
        // Query the database to retrieve the question text for the given question ID
        $query = $this->db->where('id', $question_id)->get('quiz_table');
    
        // Check if a single row is returned
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->question_text; // Assuming 'question_text' is the column name for the question text
        } else {
            return false; // Question ID not found or multiple questions with the same ID
        }
    }
    

}
?>
