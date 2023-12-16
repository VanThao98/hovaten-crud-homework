<?php
/**
 * Connect to database
 */

function db() {
    $host     = 'localhost';
    $database = 'web_a';
    $user     = 'root';
    $password = 'mysql';

    try {
        $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

/**
 * Create new student record
 */
function createStudent($value) {
    try {

        if (empty($value['name']) || empty($value['age']) || empty($value['email']) || empty($value['profile'])) {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }


        $db = db();
        if ($db) {
            $stmt = $db->prepare("INSERT INTO student (name, age, email, profile) VALUES (:name, :age, :email, :profile)");
            $stmt->bindParam(':name', $value['name']);
            $stmt->bindParam(':age', $value['age']);
            $stmt->bindParam(':email', $value['email']);
            $stmt->bindParam(':profile', $value['profile']);
            $stmt->execute();
            
            error_log("New student created: " . $value['name']);

        } else {
            error_log ("Database connection is not available.");
            echo "An error occurred. Please try again later.";
        }
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";

    }catch (Exception $e) {

        error_log("Error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}

/**
 * Get all data from table student
 */
function selectAllStudents() {
    try {
        $db = db();
        if ($db) {
            $stmt = $db->query("SELECT * FROM student");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Database connection is not available.");
        }
    } catch (PDOException $e) {
        throw new Exception ("Error quering database: " . $e->getMessage());
    }
}

/**
 * Get only one on record by id 
 */
function selectOnestudent($id) {
    $db = db();
    $stmt = $db->prepare("SELECT * FROM student Where id = $id");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/**
 * Delete student by id
 */
function deleteStudent($id) {
    try {
        $db = db();
        if ($db) {
            $stmt = $db->prepare("DELETE FROM student WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } else {
            throw new Exception("Database connection is not available.");
        }
    } catch (PDOException $e) {
        throw new Exception("Error deleting record: " . $e->getMessage());
    }
}


/**
 * Update students
 * 
 */
function updateStudent($id, $name, $age, $email, $profile) {
    try {
        $db = db(); // Đảm bảo rằng hàm db() đã được định nghĩa trong tệp database.php
        $stmt = $db->prepare("UPDATE student SET name = :name, age = :age, email = :email, profile = :profile WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profile', $profile);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // echo "update success";
    } catch(PDOException $e) {
        echo "Error updating student: " . $e->getMessage();
    }
}

