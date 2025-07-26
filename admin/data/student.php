<?php 

// All Students 
function getAllStudents($conn){
   $sql = "SELECT s.*, c.class_name, sec.section_name 
           FROM students s
           JOIN class c ON s.class_id = c.class_id
           JOIN section sec ON s.section_id = sec.section_id";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
    return 0;
   }
}

// DELETE
function removeStudent($id, $conn){
   $sql  = "DELETE FROM students
           WHERE student_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}

// Get Student By Id 
function getStudentById($id, $conn){
   $sql = "SELECT s.*, c.class_name, sec.section_name
           FROM students s
           JOIN class c ON s.class_id = c.class_id
           JOIN section sec ON s.section_id = sec.section_id
           WHERE student_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() == 1) {
     $student = $stmt->fetch();
     return $student;
   }else {
    return 0;
   }
}

// Get Student Previous Results
function getStudentPreviousResults($student_id, $conn){
   $sql = "SELECT * FROM previous_results
           WHERE student_id=?
           ORDER BY year DESC";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$student_id]);

   if ($stmt->rowCount() >= 1) {
     $results = $stmt->fetchAll();
     return $results;
   }else {
    return 0;
   }
}

// Check if the username Unique
function unameIsUnique($uname, $conn, $student_id=0){
   $sql = "SELECT username, student_id FROM students
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($student_id == 0) {
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      return 1;
     }
   }else {
    if ($stmt->rowCount() >= 1) {
       $student = $stmt->fetch();
       if ($student['student_id'] == $student_id) {
         return 1;
       }else {
        return 0;
      }
     }else {
      return 1;
     }
   }
}

// Search 
function searchStudents($key, $conn){
   $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);
   $sql = "SELECT s.*, c.class_name, sec.section_name
           FROM students s
           JOIN class c ON s.class_id = c.class_id
           JOIN section sec ON s.section_id = sec.section_id
           WHERE s.student_id LIKE ? 
           OR s.fname LIKE ?
           OR s.address LIKE ?
           OR s.email_address LIKE ?
           OR s.father_name LIKE ?
           OR s.mother_name LIKE ?
           OR s.parent_phone_number LIKE ?
           OR s.lname LIKE ?
           OR s.username LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key, $key]);

   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
    return 0;
   }
}