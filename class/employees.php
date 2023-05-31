<?php
class Employee
{

    private $conn;

    private $NameTable = "Employee";
    // tên cột
    public $id;
    public $name;
    public $email;
    public $age;
    public $designation;
    public $created;
    //Kết Nối DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // GET ALL
    public function getEmployees()
    {
        $query = "SELECT id, name, email, age, designation, created FROM " . $this->NameTable . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Thêm Nhân Sự
    public function createEmployee()
    {
        $query = "INSERT INTO
                        " . $this->NameTable . "
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created";

        $stmt = $this->conn->prepare($query);

        // lấy data từ Request
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->created = htmlspecialchars(strip_tags($this->created));

        // bind data vào câu truy vấn
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Tìm Nhân Sự
    public function findEmployee()
    {
        $query = "SELECT
                        id, 
                        name, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        " . $this->NameTable . "
                    WHERE 
                       id = ?
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name'];
        $this->email = $dataRow['email'];
        $this->age = $dataRow['age'];
        $this->designation = $dataRow['designation'];
        $this->created = $dataRow['created'];
    }
    // Cập nhật Nhân Sự
    public function updateEmployee()
    {
        $query = "UPDATE
                        " . $this->NameTable . "
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Xóa Nhân Sự Bằng id
    function deleteEmployee()
    {
        $query = "DELETE FROM " . $this->NameTable . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
