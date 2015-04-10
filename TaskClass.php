   <?php

/*
 * Task Class is used for create new table 'test', fill datas on the table and retrieve datas from table
 */
   
class TaskClass{
    /**
     *
     * @var object $db PDO database object
     */
    private $db;
    function __construct(){
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";

        // Create connection
        $this->db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=UTF-8', $username, $password);
        
        $this->create();
        //$this->fill();
    }
    /**
     * function create() is for create new table 'test'
     * @return NULL
     */
    private function create(){
        // sql to create table
        $sql = "CREATE TABLE IF NOT EXISTS `test` (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        script_name VARCHAR(25) NOT NULL,
        start_time INT(10),
        end_time INT(10),
        result enum('normal','illegal','failed','success')
        )";
        
        $this->db->exec($sql);

    }
    
    /**
     * function fill() is for fill datas to the table 'test'
     * @return NULL
     */
    private function fill(){
        $num = 10;
        // sql to create table
        $sql = 'INSERT INTO `test` (`script_name`, `start_time`, `end_time`, `result`) VALUES ';
        for ($i = 1; $i <= $num; $i++) {
          $testValuegenerate = $this->generate_test_values($i);
          $mysql = $sql.$testValuegenerate;
          $this->db->exec($mysql);
        }
    }
    
    /**
     * function get() is to get all available datas from the table 'test'
     * @param $result $result parameter have 'normal' or 'success' , used for filter datas from the table
     * @return $rows Fetch all the datas with the $result parameter
     */
    public function get($result){
        $stmt   = $this->db->prepare("SELECT * FROM test WHERE result = ?");
        $stmt->execute(array($result));
        $rows   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
        
    }
    
    /**
     * function generate_test_values() is used for generate the random values for inserting datas to the table 'test'
     * @param $i $i parameter is for auto incremeting value
     * @return $genValues returns random values for inserting datas to the table
     */
    private function generate_test_values($i){
        $scriptname = $i.'_'.$this->generateRandomString(10);
        $starttime  = mt_rand(1262055681,1262055681);
        $endtime    = mt_rand(1262055681,1262055681);
        $resultArray= array("normal"=>"normal","illegal"=>"illegal","failed"=>"failed","success"=>"success");
        $result     = array_rand($resultArray,1);
        $genValues  = "('".$scriptname."','".$starttime."','".$endtime."','".$result."')";
        return $genValues;
    }
    
    /**
     * function generateRandomString() is used for generate random string
     * @param $length is the length of the string
     * @return $randomString returns the random string
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    /**
     * function createTables() is used for create three tables data, link, info
     */
    public function createTables(){
        $sql1 = "CREATE TABLE IF NOT EXISTS `data` (
         `id` int (11) NOT NULL auto_increment,
         `date` date default NULL,
         `value` INT (11) default NULL,
         PRIMARY KEY (`id`)
        ) ENGINE = MyISAM DEFAULT CHARSET = cp1251;";
        $this->db->exec($sql1);
        
        $sql2 = "CREATE TABLE IF NOT EXISTS `link` (
         `data_id` int (11) NOT NULL,
         `info_id` int (11) NOT NULL 
         FOREIGN KEY (data_id) REFERENCES data(id)
        ) ENGINE = MyISAM DEFAULT CHARSET = cp1251;";
        $this->db->exec($sql2);
        
        $sql3 = "CREATE TABLE IF NOT EXISTS `info` (
         `id` int (11) NOT NULL auto_increment,
         `name` varchar (255) default NULL,
         `desc` text default NULL,
         PRIMARY KEY (`id`)
         FOREIGN KEY (id) REFERENCES link(info_id)
        ) ENGINE = MyISAM DEFAULT CHARSET = cp1251;";
        $this->db->exec($sql3);
        
    }
    
    
    /**
     * function getResults() is used for get the datas from the three tables with JOIN
     */
    public function getResults(){
        $stmt   = $this->db->prepare("select data.*,
                                             link.*,
                                             info.* 
                                      FROM data 
                                      INNER JOIN link ON (link.data_id = data.id)
                                      INNER JOIN info ON (info.id = link.info_id)");
    }
}
?>
