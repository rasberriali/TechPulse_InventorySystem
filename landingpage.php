<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/landingpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body class="body">
    <div class="header">
        <div class="right">
            <div class="logo-name" onclick="navigateTo('index.html')">TechPulse</div>
        </div>
        <div class="left">
            <div class="home" onclick="navigateTo('index.html')">Home</div>
            <div class="login" onclick="navigateTo('login.html')">Login</div>
        </div>
    </div>
    <div class="top-text">
        <div class="top-title">TechPulse Inventory</div>
        <div class="bottom-buttons">
            <button class="add-new-item" onclick="navigateTo('newitem.html')">
                <i style="font-size:20px" class="fa">&#xf055;</i>
                Add New Item
            </button>
            <button class="logout" onclick="confirmLogout()">
            <i style="font-size:20px" class="fa">&#xf08b;</i>     
            Logout
            </button>
            <br>
        </div>
        <div class="products">
            Products
        </div>
        <table id="inventorytable" class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product ID</th>
                    <th>Stock</th>
                    <th>Prices ($)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include "php/db_connection.php";

                $sql = 'SELECT * FROM inventory';
                $result = $connection ->query($sql);

                if(!$result) {
                    die("Invalid Query" . $connection -> error);
                }

                while($row = $result -> fetch_assoc()) {
                    echo "<tr>
                            <td>" .$row['ProdName']. "</td>
                            <td>" .$row['ProdID']. "</td>
                            <td>" .$row['Stock']. "</td>
                            <td>" .$row['Price ($)']. "</td>
                            <td>
                            <a class='btn btn-primary btn-sm update' href='updateitem.php?id=".$row['ProdID']."'>Edit</a>
                            <a class='btn btn-primary btn-sm delete' href='php/delete.php?id=".$row['ProdID']."' onclick='return confirmDelete()'>Delete</a>
                        </td>                        
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="footers">
        <div class="text-footer" onclick="navigateTo('index.html')">© TechPulse 2024</div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <script>

        function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = 'login.html'; // Redirect to logout page if confirmed
        }
        }
    
        function confirmDelete() {
        return confirm("Are you sure you want to delete this item?");       
        }
        $(document).ready(function() {
            $('#inventorytable').DataTable({
                "columnDefs": [{ 
                    "orderable": false, "targets": -1 } 
            ]});
        });
        
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
