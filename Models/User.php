<?php

use LDAP\Result;

include './Models/Db.php';
class User
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $phone;

    public function __construct($id, $name, $surname, $email, $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
    }
    public static function find($id)
    {
        $db = new Db();
        $stmt = $db->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['phone']);
        }
        $db->conn->close();
        return $user;
    }

    public static function all()
    {
        $users = [];
        $db = new DB();
        $sql = "SELECT * FROM `users`";
        $result = $db->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $users[] = new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["phone"]);
        }
        $db->conn->close();
        return $users;
    }
    
    public static function create()
    {
        $db = new DB();
        $stmt = $db->conn->prepare("INSERT INTO users (name, surname, email, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["phone"]);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }
    public static function update()
    {
        $db = new DB();
        $stmt = $db->conn->prepare("UPDATE users SET name = ?, surname = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["phone"], $_POST["id"]);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }   
    public static function destroy()
    {
        $db = new DB();
        $stmt = $db->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }   
}
