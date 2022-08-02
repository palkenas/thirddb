<?php
include './Models/User.php';
class UserController {

    public static function index() {
        $users = User::all();
        return $users;
    }

    public static function show(){
        $user = User::find($_POST['id']);
        return $user;
    }

    public static function update()
    {
        User:: update();
    }

    public static function destroy()
    {
        User::destroy();
    }


    public static function store()
    {
        // patikrinimas validacija

        session_start();
        $hasErrors = false;
        if(empty($_POST['name'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas vardas";
        }
        if(empty($_POST['surname'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalinga pavardė";
        }   
        if(empty($_POST['email'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas el. paštas";
        }
        if(empty($_POST['phone'])){
            $hasErrors = true;
            $_SESSION['errors'][] = "Reikalingas telefono numeris";
        }
        if(strlen($_POST['phone']) != 9){
            $hasErrors = true;
            $_SESSION['errors'][] = "Telefono numeris turi būti 9 skaitmenų";
        }
        if(strlen($_POST['name']) > 20){
            $_SESSION['errors'][] = "Vardas negali būti ilgesnis nei 20 simbolių";
            $hasErrors = true;
        }
        if(strlen($_POST['surname']) > 30){
            $_SESSION['errors'][] = "Pavardė negali būti ilgesnis nei 20 simbolių";
            $hasErrors = true;
        }
        if(strlen($_POST['email']) > 50){
            $_SESSION['errors'][] = "El. paštas negali būti ilgesnis nei 50 simbolių";
            $hasErrors = true;
        }
        // if(strlen($_POST['name'])>15) { // if data provided in input is bad, like bad email or so on...
        // session_start();
        // $_SESSION['errors'][] = "Per ilgas vardas";
        // return true;
        // } 
        if($hasErrors){
            return true;
        } else {
        User::create();
        return false;
        }
    }
}
