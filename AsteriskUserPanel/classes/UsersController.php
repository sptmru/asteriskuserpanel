<?php

include_once('config.php');
include "../phpagi/phpagi.php";

class UsersController {

    private $mysqli = '';

    public function __construct() {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
        $this->mysqli->set_charset('utf8');
    }

    private function userParams($id) {
        $result = $this->mysqli->query("SELECT * FROM users WHERE id=$id");
        while ($userData = $result->fetch_array(MYSQLI_ASSOC)) {
            return $userData;
        }
    }

    private function createRegisterString($number, $password) {
        $registerString = "register=>" .NUMBER_PREFIX.$number . ":" . $password . "@" . TRUNK_HOST . "/" . $number;
        return $registerString;
    }
    
    private function checkUserStatus($user) {
        $manager = new AGI_AsteriskManager();
	$manager->connect(AMI_HOST,AMI_USER,AMI_PASSWORD);
	$userStatus = $manager->command("sip show registry");
        $user = $user." 105 Registered";
        $userStatus[data] = preg_replace('/ {2,}/',' ',$userStatus['data']);
	if(strripos($userStatus['data'],$user)) $result = 1;
	else $result=0;
	return $result;
    }

    public function addUser($number, $name, $password, $prefix) {
        $registerString = $this->createRegisterString($number, $password);
        $this->mysqli->query("INSERT INTO users(name,number,password,prefix,register,activeness) VALUES('$name','$number','$password','$prefix','$registerString','1')");
        header('Location: /index.php');
    }

    public function deleteUsers($numbers) {
        $this->mysqli->query("DELETE FROM users WHERE number IN (" . $numbers . ")");
    }

    public function editUser($id) {
        $params = $this->userParams($id);
        if ($params['activeness'] == 1) {
            $button = "btn-success";
        } else {
            $button = "btn-warning";
        }
        $value = "active". $params['activeness'];
        echo "<h5>User " . $params['name'] . "</h5>";
        echo "<div class='input-group'>";
        echo "<span class='input-group-addon'>Number:</span>";
        echo "<input type='text' class='form-control number' value='" . $params['number'] . "'>";
        echo "<span class='input-group-addon'>Username:</span>";
        echo "<input type='text' class='form-control name' value='" . $params['name'] . "'>";
        echo "<span class='input-group-addon'>Password:</span>";
        echo "<input type='password' class='form-control password' value='" . $params['password'] . "'>";
        echo "<span class='input-group-addon'>Prefix:</span>";
        echo "<input type='text' class='form-control prefix' value='" . $params['prefix'] . "'>";
        echo "</div>";
        echo "<br>";
        echo "<div class='input-group'>";
        echo "<button type='button' onclick='changeActiveness(" . $id . ",\"" . $value . "\")' class='buttons btn " . $button . "'>Change Activeness</button>";
        echo "<span class='input-group-btn'>";
        echo "<button class='btn btn-primary' type='button' onclick='saveUser(".$id.")'>Save Changes</button>";
        echo "</span>";
        echo "</div>";
    }

    public function saveUser($id, $number, $name, $password, $prefix) {
        $registerString = $this->createRegisterString($number, $password);
        $this->mysqli->query("UPDATE users SET number='$number',name='$name',password='$password',prefix='$prefix',register='$registerString' WHERE id='$id'");
    }
    
    public function changeActiveness($id, $value) {
        $this->mysqli->query("UPDATE users SET activeness='$value' WHERE id='$id'");
    }

    public function showUsers($number = '', $name = '') {
        echo "<br>";
        echo "<table class='table table-striped' id='usersTable'>
             <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Prefix</th>
                    <th>Activeness</th>
                    <th>Registered</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tbody>";
        if ($number == '') {
            $result = $this->mysqli->query("SELECT * FROM users");
        } else
            $result = $this->mysqli->query("SELECT * FROM users WHERE number LIKE '%$number%'");
        while ($user = $result->fetch_array(MYSQLI_ASSOC)) {
            $number = $user['number'];
            $name = $user['name'];
            $prefix = $user['prefix'];
            $activeness = $user['activeness'];
            $value = "active" . $activeness;
            $registeredArray = array();
            $registeredArray[0] = "<font color='red'>Not Registered</font>";
            $registeredArray[1] = "<font color='green'>Registered</font>";
            $ifRegistered = $this->checkUserStatus($number);
            $activenessArray = array();
            $activenessArray[0] = "<font color='red'>Inactive</font>";
            $activenessArray[1] = "<font color='green'>Active</font>";
            $id = $user['id'];
            echo "<tr onclick='editUser(" . $id . ")'>";
            echo "<td>$number</td>";
            echo "<td>$name</td>";
            echo "<td>$prefix</td>";
            echo "<td>$activenessArray[$activeness]</td>";
            echo "<td>$registeredArray[$ifRegistered]</td>";
            echo "<td><input type='checkbox' name='" . $number . "'></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    
    function CSVImport($file) {
        $handle = fopen($file,"r");
	while($data=fgetcsv($handle,1000,",")) {
		$number = $data[0];
		$name = $data[1];
		$password = $data[2];
                $prefix = $data[3];
		$activeness = $data[4];
		$registerString = $this->createRegisterString($number, $password);
                $this->mysqli->query("INSERT INTO users(name,number,password,prefix,register,activeness) VALUES('$name','$number','$password','$prefix','$registerString','$activeness')") or die(mysqli_error($this->mysqli));
	}
	fclose ($handle);
        header("Location: /index.php");
    }

    public function asteriskReload() {
        $manager = new AGI_AsteriskManager();
	$manager->connect(AMI_HOST,AMI_USER,AMI_PASSWORD);
	$manager->command("sip reload");
    }
    

    public function applyChanges() {
        $result = $this->mysqli->query("SELECT register FROM users WHERE activeness=1");
        $fileContent = '';
        while($register = $result->fetch_array(MYSQLI_ASSOC)) {
            $fileContent = $fileContent.$register['register']."\n";
        }
        $file = fopen(TRUNK_FILE, 'w+');
        fwrite($file,$fileContent);
	fclose($file);
        $this->asteriskReload();
        header("Location: /index.php");
    }
}
