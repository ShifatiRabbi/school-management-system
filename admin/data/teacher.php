<?php  

// Get Teacher by ID
function getTeacherById($teacher_id, $conn) {
    $sql = "SELECT * FROM teachers WHERE teacher_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacher_id]);

    if ($stmt->rowCount() == 1) {
        return $stmt->fetch();
    } else {
        return 0;
    }
}

// All Teachers 
function getAllTeachers($conn) {
    $sql = "SELECT * FROM teachers ORDER BY fname, lname";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll();
    } else {
        return 0;
    }
}

// Check if the username is unique
function unameIsUnique($uname, $conn, $teacher_id=0) {
    $sql = "SELECT username, teacher_id FROM teachers WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);
    
    if ($teacher_id == 0) {
        return $stmt->rowCount() == 0;
    } else {
        if ($stmt->rowCount() >= 1) {
            $teacher = $stmt->fetch();
            return $teacher['teacher_id'] == $teacher_id;
        } else {
            return true;
        }
    }
}

// Check if teacher index is unique
function teacherIndexIsUnique($index, $conn, $teacher_id=0) {
    $sql = "SELECT teacher_index, teacher_id FROM teachers WHERE teacher_index=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$index]);
    
    if ($teacher_id == 0) {
        return $stmt->rowCount() == 0;
    } else {
        if ($stmt->rowCount() >= 1) {
            $teacher = $stmt->fetch();
            return $teacher['teacher_id'] == $teacher_id;
        } else {
            return true;
        }
    }
}

// DELETE
function removeTeacher($id, $conn) {
    $sql = "DELETE FROM teachers WHERE teacher_id=?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}

// Search 
function searchTeachers($key, $conn) {
    $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1', $key);
    $key = "%$key%";

    $sql = "SELECT * FROM teachers 
            WHERE teacher_id LIKE ? 
            OR fname LIKE ?
            OR lname LIKE ?
            OR username LIKE ?
            OR teacher_index LIKE ?
            OR phone_number LIKE ?
            OR email_address LIKE ?
            OR address LIKE ?
            ORDER BY fname, lname";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key]);

    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll();
    } else {
        return 0;
    }
}

function handleTeacherImageUpload($file, $teacher_id, $conn) {
    $uploadDir = '../uploads/teachers/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // Delete old image if exists
    $teacher = getTeacherById($teacher_id, $conn);
    if ($teacher && !empty($teacher['image_path'])) {
        $oldImage = "../".$teacher['image_path'];
        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
    }
    
    $fileName = basename($file['name']);
    $targetPath = $uploadDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return str_replace('../', '', $targetPath);
    }
    return false;
}

// Import teachers from CSV
function importTeachersFromCSV($filePath, $conn) {
    $imported = 0;
    $errors = [];
    
    if (($handle = fopen($filePath, "r")) !== FALSE) {
        // Skip header row
        fgetcsv($handle);
        
        while (($data = fgetcsv($handle))) {
            if (count($data) < 15) continue; // Basic validation
            
            $teacher = [
                'username' => trim($data[0]),
                'password' => password_hash(trim($data[1]), PASSWORD_DEFAULT),
                'fname' => trim($data[2]),
                'lname' => trim($data[3]),
                'teacher_index' => trim($data[4]),
                'designation' => trim($data[5]),
                'salary_code' => trim($data[6]),
                'salary' => trim($data[7]),
                'highest_qualification' => trim($data[8]),
                'qualification_details' => trim($data[9]),
                'subjects' => trim($data[10]),
                'classes_assigned' => trim($data[11]),
                'address' => trim($data[12]),
                'employee_number' => trim($data[13]),
                'date_of_birth' => trim($data[14]),
                'phone_number' => trim($data[15]),
                'gender' => trim($data[16]),
                'email_address' => trim($data[17]),
                'date_of_joined' => trim($data[18]),
                'years_of_experience' => trim($data[19]),
                'marital_status' => trim($data[20]),
                'bank_name' => trim($data[21]),
                'bank_account' => trim($data[22]),
                'emergency_contact' => trim($data[23]),
                'emergency_phone' => trim($data[24]),
                'notes' => trim($data[25])
            ];
            
            // Validate required fields
            if (empty($teacher['username']) || empty($teacher['fname']) || empty($teacher['teacher_index'])) {
                $errors[] = "Missing required fields in row: " . implode(',', $data);
                continue;
            }
            
            // Check if username or teacher index already exists
            if (!unameIsUnique($teacher['username'], $conn) || !teacherIndexIsUnique($teacher['teacher_index'], $conn)) {
                $errors[] = "Username or Teacher Index already exists: " . $teacher['username'] . " / " . $teacher['teacher_index'];
                continue;
            }
            
            // Insert teacher
            $sql = "INSERT INTO teachers (
                username, password, fname, lname, teacher_index, designation, salary_code, salary, 
                highest_qualification, qualification_details, subjects, classes_assigned, address, 
                employee_number, date_of_birth, phone_number, gender, email_address, date_of_joined, 
                years_of_experience, marital_status, bank_name, bank_account, emergency_contact, 
                emergency_phone, notes
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            if ($stmt->execute(array_values($teacher))) {
                $imported++;
            } else {
                $errors[] = "Failed to import: " . $teacher['fname'] . " " . $teacher['lname'];
            }
        }
        fclose($handle);
    }
    
    return ['imported' => $imported, 'errors' => $errors];
}

// Export teachers to CSV
function exportTeachersToCSV($conn) {
    $teachers = getAllTeachers($conn);
    $filename = "teachers_export_" . date('Y-m-d') . ".csv";
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // Header row
    fputcsv($output, [
        'Username', 'Password', 'First Name', 'Last Name', 'Teacher Index', 'Designation', 
        'Salary Code', 'Salary', 'Highest Qualification', 'Qualification Details', 
        'Subjects (comma separated IDs)', 'Classes Assigned (comma separated IDs)', 
        'Address', 'Employee Number', 'Date of Birth (YYYY-MM-DD)', 'Phone Number', 
        'Gender', 'Email Address', 'Date Joined (YYYY-MM-DD)', 'Years of Experience', 
        'Marital Status', 'Bank Name', 'Bank Account', 'Emergency Contact', 
        'Emergency Phone', 'Notes'
    ]);
    
    // Data rows
    foreach ($teachers as $teacher) {
        fputcsv($output, [
            $teacher['username'],
            '', // Password left blank for security
            $teacher['fname'],
            $teacher['lname'],
            $teacher['teacher_index'],
            $teacher['designation'],
            $teacher['salary_code'],
            $teacher['salary'],
            $teacher['highest_qualification'],
            $teacher['qualification_details'],
            $teacher['subjects'],
            $teacher['classes_assigned'],
            $teacher['address'],
            $teacher['employee_number'],
            $teacher['date_of_birth'],
            $teacher['phone_number'],
            $teacher['gender'],
            $teacher['email_address'],
            $teacher['date_of_joined'],
            $teacher['years_of_experience'],
            $teacher['marital_status'],
            $teacher['bank_name'],
            $teacher['bank_account'],
            $teacher['emergency_contact'],
            $teacher['emergency_phone'],
            $teacher['notes']
        ]);
    }
    
    fclose($output);
    exit;
}
?>