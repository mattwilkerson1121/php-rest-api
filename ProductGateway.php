<?php

class ProductGateway
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getAll(): array
    {
        $sql = "SELECT * FROM details";
                
        $stmt = $this->conn->query($sql);
        
        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            $row["is_available"] = (bool) $row["is_available"];
            
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function create(array $data): string
    {
        $sql = "INSERT INTO details (sort_order,color,fabric,name,description,image,is_eco,eco_order,cleancode,attributes,is_available) VALUES (:sort_order, :color, :fabric, :name, :description, :image, :is_eco, :eco_order, :cleancode, :attributes, :is_available)";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":sort_order", $data["sort_order"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":fabric", $data["fabric"], PDO::PARAM_STR);
        $stmt->bindValue(":color", $data["color"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindValue(":image", $data["image"], PDO::PARAM_STR);
        $stmt->bindValue(":is_eco", $data["is_eco"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":eco_order", $data["is_eco"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":cleancode", $data["cleancode"], PDO::PARAM_STR);
        $stmt->bindValue(":attributes", $data["attributes"], PDO::PARAM_STR);
        $stmt->bindValue(":is_available", (bool) ($data["is_available"] ?? false), PDO::PARAM_BOOL);
        
        $stmt->execute();
        
        return $this->conn->lastInsertId();
    }
    
    public function get(string $id): array | false
    {
        $sql = "SELECT * FROM details WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data !== false) {
            $data["is_available"] = (bool) $data["is_available"];
        }
        
        return $data;
    }
    
    public function update(array $current, array $new): int
    {
        $sql = "UPDATE details SET sort_order = :sort_order, color = :color, fabric = : fabric, name = :name, description = :description, image = :image, is_eco = :is_eco, eco_order = :eco_order, cleancode = :cleancode, attributes = :attributes, is_available = :is_available WHERE id = :id";
        
        /* sort_order,color,fabric,name,description,image,is_eco,eco_order,cleancode,attributes,is_available */

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":sort_order", $new["sort_order"] ?? $current["sort_order"], PDO::PARAM_INT);
        $stmt->bindValue(":color", $new["color"] ?? $current["color"], PDO::PARAM_STR);
        $stmt->bindValue(":fabric", $new["fabric"] ?? $current["fabric"], PDO::PARAM_STR);
        $stmt->bindValue(":name", $new["name"] ?? $current["name"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $new["description"] ?? $current["description"], PDO::PARAM_STR);
        $stmt->bindValue(":image", $new["image"] ?? $current["image"], PDO::PARAM_STR);
        $stmt->bindValue(":is_eco", $new["is_eco"] ?? $current["is_eco"], PDO::PARAM_INT);
        $stmt->bindValue(":eco_order", $new["eco_order"] ?? $current["eco_order"], PDO::PARAM_INT);
        $stmt->bindValue(":cleancode", $new["cleancode"] ?? $current["cleancode"], PDO::PARAM_STR);
        $stmt->bindValue(":attributes", $new["attributes"] ?? $current["attributes"], PDO::PARAM_STR);
        $stmt->bindValue(":is_available", $new["is_available"] ?? $current["is_available"], PDO::PARAM_BOOL);
        
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    public function delete(string $id): int
    {
        $sql = "DELETE FROM details WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}
?>