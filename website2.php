<?php

class Service {
    public $id;
    public $name;
    public $description;
    public $available;
    
    public function __construct($id, $name, $description, $available) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->available = $available;
    }

    public function registerService($customerName, $customerPhone, $customerVehicle, $serviceDate) {
        if ($this->available) {
            $this->available = false;
            return "Service registered successfully for customer $customerName on $serviceDate.";
        }
        return "Service is not available.";
    }

    public function checkAvailability() {
        return $this->available;
    }
}


class Customer {
    public $id;
    public $name;
    public $phone;
    public $vehicle;
    
    public function __construct($id, $name, $phone, $vehicle) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->vehicle = $vehicle;
    }
}


$service1 = new Service(1, "Service Bulanan", "Servis motor bulanan", true);
$service2 = new Service(2, "Ganti Oli", "Ganti oli mesin", true);


$customer1 = new Customer(1, "Customer A", "123456789", "Motor A");
$customer2 = new Customer(2, "Customer B", "987654321", "Motor B");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bengkel Rafi</title>
    <style>
        body {
            color: white; 
            font-size: 30px; 
        }
    </style>
</head>
<body background="bengkel2.png">

    <h1>Bengkel Rafi</h1>
    <p>Selamat datang di Bengkel Rafi</p>
    <h2>Layanan Tersedia</h2>
    <?php
    
    echo "ID: {$service1->id}, Name: {$service1->name}, Description: {$service1->description}, Available: " . ($service1->available ? 'Yes' : 'No') . "<br>";
    echo "ID: {$service2->id}, Name: {$service2->name}, Description: {$service2->description}, Available: " . ($service2->available ? 'Yes' : 'No') . "<br>";
    ?>

    <h2>Daftar Layanan</h2>
    <form method="post" action="">
        <label for="service_id">Pilih Layanan:</label>
        <select id="service_id" name="service_id">
            <option value="1">Service Bulanan</option>
            <option value="2">Ganti Oli</option>
        </select><br>
        <label for="customer_name">Nama Pelanggan:</label>
        <input type="text" id="customer_name" name="customer_name"><br>
        <label for="customer_phone">Nomor Telepon:</label>
        <input type="text" id="customer_phone" name="customer_phone"><br>
        <label for="customer_vehicle">Jenis Motor:</label>
        <input type="text" id="customer_vehicle" name="customer_vehicle"><br>
        <label for="service_date">Tanggal Layanan:</label>
        <input type="date" id="service_date" name="service_date"><br>
        <button type="submit" name="register">Daftar</button>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
        
        $service_id = intval($_POST["service_id"]);
        $serviceToRegister = $service_id == 1 ? $service1 : $service2;
        $customer_name = $_POST["customer_name"];
        $customer_phone = $_POST["customer_phone"];
        $customer_vehicle = $_POST["customer_vehicle"];
        $service_date = $_POST["service_date"];
        echo $serviceToRegister->registerService($customer_name, $customer_phone, $customer_vehicle, $service_date);
    }
    ?>
</body>
</html>
