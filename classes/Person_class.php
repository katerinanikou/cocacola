<?php

include('includes/token.php');


getToken();
  
class Person {
    protected $personId; //Haralds $personId heter $uid, vår person_id är Haralds id
    private $userInfo;




    public function getUserInfoFromDB() {
        global $pdo;
        $sql= "SELECT * FROM person WHERE person_id = :person_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':person_id', $this->personId);
        $stmt->execute();

        $this->userInfo = $stmt->fetchAll();
        $this->userInfo = $this->userInfo[0];
    }

    public function getUserInfo($element) {        
        return $this->userInfo[$element];
                    
    }

    public function logIn($email, $password){
        
        global $pdo;
        
     
        $sql = "SELECT person_id FROM person WHERE email = :email AND password = :password AND active = 1 ";
        
        //TRIMMA BORT WHITESPACES OCH HASHA PASSWORD
        $password = trim($_POST['input_password']);
        $password = hash('sha256', $password);

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        
        if (checkToken($_POST['token'])) {
            
        $stmt->execute();

        $result = $stmt->fetch();
        
        
        if($result){
            $this->personId = $result['person_id'];
            $this->getUserInfoFromDB();
            $_SESSION['personId'] = $this->personId;

        }  
    } 
}
    
    public function logOut(){
        $this->personId = null;
        unset($_SESSION['personId']);
//        echo"<p>Du är utloggad</p>";
    }
    
    public function isLoggedIn(){
        if(isset($_SESSION['personId'])) {
            $this->setId($_SESSION['personId']);
             //echo $this->personId." är inloggad";
            
        }

        return $this->personId !==null;
    }
    
    public function isAdmin(){
        if ($this->isLoggedIn()){
            global $pdo;
            $sql = "SELECT level FROM person WHERE person_id = :person_Id;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':person_Id', $this->personId);
            $stmt->execute();
            
            $userlevel = $stmt->fetchColumn();
            return $userlevel === "2";

         }
        
    }
    
    public function getId(){
        return $this->personId;
        
    }
    
    public function setId($setThisId){ //Haralds $personId heter $userID
        global $pdo;
        $sql = 'SELECT level FROM person WHERE person_id = :person_Id;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':person_Id', $setThisId);
        $stmt->execute();

        $result = $stmt->fetchColumn();
        if($result) {
            $this->personId = $setThisId; 
        }

    }
    
    public function getLogInForm(){
        if($this->isLoggedIn()){
            $returnData = '<a href="?logout">'."Logga ut".'</a>';
        } else { 
            $returnData = file_get_contents('templates/parts/login_tpl.php');
        }
        return $returnData; 
    }// End getLogInForm 

    public function changePassword($newPassword) {
        global $pdo;
        
        $sql = "UPDATE granza.person SET password = :password WHERE person.person_id = :id";
        
       
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':id', $this->personId);
        if (checkToken($_POST['token'])) {  
        $stmt->execute();

                if($stmt->rowCount() > 0 ) {


                } 
            getToken();
        } else {
            getToken();
        }

    }

} // End class Person